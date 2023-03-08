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
}
