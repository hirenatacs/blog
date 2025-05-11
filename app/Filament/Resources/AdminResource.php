<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\Admin;
use App\Traits\Filament\HasPanelPermission;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdminResource extends Resource
{
    use HasPanelPermission;

    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                Toggle::make('change_password')
                    ->label('Change Password')
                    ->reactive()
                    ->visible(fn (string $context) => $context === 'edit'),
                TextInput::make('password')
                    ->label('New Password')
                    ->password()
                    ->maxLength(255)
                    ->visible(fn (callable $get, string $context) =>
                        $context === 'create' || $get('change_password'))
                    ->required(fn (string $context) => $context === 'create')
                    ->dehydrated(fn (callable $get, string $context) =>
                        $context === 'create' || $get('change_password'))
                    ->dehydrateStateUsing(fn ($state) => !empty($state) ? bcrypt($state) : null),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple(false)
                    ->preload()
                    ->label('Roles'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->sortable()
                    ->searchable()
                    ->label('Role'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return static::userCan('manage admins');
    }
}
