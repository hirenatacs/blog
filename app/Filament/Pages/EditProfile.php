<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;

class EditProfile extends Page
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.edit-profile';

    protected static ?string $title = 'Edit Profile';

    protected static ?string $navigationGroup = null;
    
    protected static ?string $navigationLabel = null;
    
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];
 
    public function mount(): void
    {
        $user = auth()->user();
 
        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
 
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
 
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(255),
 
                Forms\Components\TextInput::make('current_password')
                    ->label('Current Password')
                    ->password()
                    ->required()
                    ->visible(fn () => request()->isMethod('post')),
 
                Forms\Components\TextInput::make('new_password')
                    ->label('New Password')
                    ->password()
                    ->minLength(8)
                    ->maxLength(255)
                    ->confirmed(),
 
                Forms\Components\TextInput::make('new_password_confirmation')
                    ->label('Confirm New Password')
                    ->password(),
 
                Forms\Components\Placeholder::make('role')
                    ->label('Role')
                    ->content(fn () => auth()->user()->getRoleNames()->join(', ')),
            ])
            ->statePath('data')
            ->columns(1);
    }
 
    public function save(): void
    {
        $user = auth()->user();
        $data = $this->form->getState();
 
        // Validate current password if new password is set
        if (!empty($data['new_password'])) {
            if (!Hash::check($data['current_password'], $user->password)) {
                Notification::make()
                    ->title('Current password is incorrect')
                    ->danger()
                    ->send();
 
                return;
            }
 
            $user->password = Hash::make($data['new_password']);
        }
 
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
 
        Notification::make()
            ->title('Profile updated successfully!')
            ->success()
            ->send();
    }
}
