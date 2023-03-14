<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'question_id',
        'answer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function result()
    {
        return $this->belongsTo(Result::class);
    }

    public static function storeResponse($data)
    {
        return self::create($data);
    }

    public static function getResponses($userId, $examId)
    {
        return self::where([
            'user_id' => $userId,
            'exam_id' => $examId
        ])->get();
    }
}
