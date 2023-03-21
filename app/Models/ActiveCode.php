<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ActiveCode extends Model
{
    use HasFactory;

    public static $expiredTime = 10;

    protected $fillable = [
        'user_id',
        'code',
        'expired_at',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function storeCode($code)
    {
        return self::create([
            'user_id' => Auth::id(),
            'code' => $code,
            'expired_at' => Carbon::now()->addMinutes(self::$expiredTime)
        ]);
    }

    public static function checkCodeIsTrue($enteredCode, $user)
    {
        $code = self::getCode($user);

        if ($enteredCode == $code->code)
            return true;
        return false;
    }

    public static function checkExpirationIsValid($user)
    {
        $code = self::getCode($user);

        if (Carbon::now() < $code->expired_at)
            return true;
        return false;
    }

    public static function getCode($user)
    {
        return self::where('user_id', $user->id)->latest('expired_at')->first();
    }

    public static function deleteCode($user)
    {
        $code = self::getCode($user);
        return $code->delete();
    }
}
