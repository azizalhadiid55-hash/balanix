<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = "users";
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'google_id',
        'google_token',
        'google_refresh_token',
        'remember_token',
        'role',
        'trial_expired_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function bootcamps()
    {
        return $this->hasMany(Bootcamp::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function hutangPiutang()
    {
        return $this->hasMany(HutangPiutang::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->email,
        ], false));

        $this->notify(new CustomResetPasswordNotification($url));
    }

    public function getLatestActiveSubscription()
    {
        return $this->hasMany(Berlangganan::class)
            ->where('expired_at', '>', now())
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function isOnTrial()
    {
        return $this->trial_expired_at && $this->trial_expired_at > now();
    }
}
