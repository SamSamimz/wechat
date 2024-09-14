<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public static function getBuddies()
    {
        return User::where('id', '!=', Auth::id())
                    ->select('id', 'name','last_active_at')
                    ->get();
    }

    public function getLastActiveAtAttribute($value)
    {
        $lastActive = Carbon::parse($value);
        $now        = Carbon::now();
        $diff       = $lastActive->diffInSeconds($now, false);

        if ($diff < 60) {
            return 'Active '. $diff . ' seconds ago';
        } elseif ($diff < 3600) {
            return 'Active '. round($diff / 60) . ' minutes ago';
        } elseif ($diff < 86400) {
            return 'Active '. round($diff / 3600) . ' hours ago';
        } elseif($diff < 604800) {
            return 'Active '.round($diff / 86400) . ' days ago';
        }else {
            $diff = $lastActive->diffForHumans();
            return $diff;
        }

    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_active_at',
        'image'
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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}