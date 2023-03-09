<?php

namespace App\Services\Admin;

use App\Models\Exam;

class ExamService
{
    public function storeExam($data)
    {
        return Exam::storeExam($data);
    }

    public function updateExam($data, $exam)
    {
        return Exam::updateExam($data, $exam);
    }
}
