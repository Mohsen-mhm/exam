<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'exam_id',
        'o1',
        'o2',
        'o3',
        'o4',
        'answer',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public static function updateQuestion($data, $question)
    {
        return $question->update($data);
    }

    public static function storeQuestion($data)
    {
        return self::create($data);
    }

    public function deleteQuestion($question)
    {
        return $question->delete();
    }

    public static function findQuestion($id)
    {
        return self::findOrFail($id);
    }

    public function isCorrect($userAnswer)
    {
        return $this->answer == $userAnswer;
    }
}
