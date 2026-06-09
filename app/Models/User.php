<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// 🌟 ១. ត្រូវប្រាកដថាមានជួរកូដ Import មួយនេះ (Sanctum)
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // 🌟 ២. ត្រូវបញ្ចូល HasApiTokens ទៅក្នុងជួរ use ខាងក្រោមនេះដាច់ខាត
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',  // ត្រូវប្រាកដថាមាន role ប្រសិនបើអ្នកប្រើប្រាស់វា
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
