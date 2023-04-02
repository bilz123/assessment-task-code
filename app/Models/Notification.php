<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_SENT = 'sent';

    protected $fillable = [
        'uuid',
        'user_id',
        'title',
        'body',
        'type',
        'route',
        'status',
        'is_read',
    ];

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->uuid = !empty($query->uuid) ? $query->uuid : getUuid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeUserOrNull($q) 
    {
        return $q->where('user_id', auth()->user()->id)->orWhereNull('user_id');
    }
}
