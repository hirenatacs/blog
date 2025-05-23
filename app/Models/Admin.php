<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
 
    protected $guard_name = 'admin';
 
    protected $fillable = ['name', 'email', 'password'];
 
    protected $hidden = ['password', 'remember_token'];
}
