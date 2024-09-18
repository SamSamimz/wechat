<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getMessages($id)
    {
        return self::query()
        ->where(function ($query) use ($id) {
            $query->where('sender_id',Auth::id())
                ->where('receiver_id', $id);
        })
        ->orWhere(function ($query) use ($id) {
            $query->where('sender_id', $id)
                ->where('receiver_id', Auth::id());
        })
        ->with(['sender', 'receiver'])
        ->orderBy('id', 'asc')
        ->select('id', 'sender_id', 'receiver_id', 'message', 'created_at')
        ->get();
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class,'receiver_id');
    }

    public function getCreatedAtAttribute($value)
    {
       return Carbon::parse($value)->diffForHumans();
    }

}