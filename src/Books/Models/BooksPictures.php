<?php

namespace Core\Books\Models;

use App\Traits\HasUUID;
use Core\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class BooksPictures extends Model
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'image',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Books::class);
    }

    
}
