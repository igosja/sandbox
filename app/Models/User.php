<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 * @package App\Models
 *
 * @property int id
 * @property string created_at
 * @property string login
 * @property string password
 * @property string remember_token
 * @property string updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var string[] $casts
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * @var string $dateFormat
     */
    protected $dateFormat = 'U';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'login',
        'password',
        'role',
    ];

    /**
     * @var string[] $hidden
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
