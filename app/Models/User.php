<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'two_fa',
        'country',
        'country_code',
        'password',
        'avatar',
        'superuser',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function active_code()
    {
        return $this->belongsTo(ActiveCode::class);
    }

    public function updateProfile($data, $user)
    {
        return $user->update($data);
    }

    public function deleteUser($user)
    {
        return $user->delete();
    }

    public static function storeUser($data)
    {
        return self::create($data);
    }

    public static function updateUser($data, $user)
    {
        return $user->update($data);
    }

    public static function getUser($id)
    {
        return self::whereId($id)->first();
    }
}
