<?php
 
namespace App\Traits\Filament;
 
trait HasPanelPermission
{
    public static function userCan(string $permission): bool
    {
        return auth()->check() && auth()->user()->can($permission);
    }
}