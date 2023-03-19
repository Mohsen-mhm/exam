<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ActiveCode extends Model
{
    use HasFactory;

    public static $expiredTime = 15;

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

}
