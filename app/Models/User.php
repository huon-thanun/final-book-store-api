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
    protected $fillable = ['name', 'email', 'password', 'role_id'];  // 🌟 ដូរទៅ role_id

    // 🌟 បង្កើតទំនាក់ទំនងទាញរកឈ្មោះ Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin(): bool
    {
        return $this->role && $this->role->name === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role && $this->role->name === 'staff';
    }

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
