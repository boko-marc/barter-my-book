<?php

namespace Core\Users\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasUUID;
use Core\Books\Models\Books;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Core\Schools\Models\School;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'verification_code',
        'class',
        "register_number",
        'password',
        'is_activated'
    ];

    protected $keyType = 'string';


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_code'
    ];


    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
    public function books(): HasMany
    {
        return $this->hasMany(Books::class);
    }

    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
