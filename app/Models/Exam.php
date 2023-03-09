<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'link',
        'user_id',
        'start_at',
        'finish_at',
        'time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public static function storeExam($data)
    {
        return self::create($data);
    }

    public static function updateExam($data, $exam)
    {
        return $exam->update($data);
    }
}
