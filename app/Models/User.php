<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function lecturer(): HasOne
    {
        return $this->hasOne(\App\Models\Lecturer::class);
    }

    public function canImpersonate()
    {
        return is_null($this->lecturer);
    }

    public function canBeImpersonated()
    {
        if (!is_null($this->lecturer)) {
            if ($this->email === 'hernaputrikusuma46@gmail.com') {
                return false;
            }

            return true;
        }

        return false;
    }
}