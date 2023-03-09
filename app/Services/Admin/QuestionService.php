<?php

namespace App\Services\Admin;

use App\Models\Question;

class QuestionService
{
    public function updateQuestion($data, $question)
    {
        return Question::updateQuestion($data, $question);
    }

    public function storeQuestion($data)
    {
        return Question::storeQuestion($data);
    }

    public function deleteQuestion($question)
    {
        return $question->deleteQuestion($question);
    }
}
