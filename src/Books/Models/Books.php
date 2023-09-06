<?php

namespace Core\Models;

use App\Traits\HasUUID;
use Core\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Books extends Model
{
    use  HasFactory, Notifiable, HasUUID, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'title',
        'author',
        'edition',
        'subject',
        'condition',
        'description',
        'class',
        'status',
        'added_at'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function booksPictues(): HasMany
    {
        return $this->hasMany(BooksPictures::class);
    }
}
