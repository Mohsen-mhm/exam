<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExamController extends Controller
{
    public function getExam(Request $request, $examId)
    {
        try {
            $exam = Exam::find($examId);
            if ($exam) {
                return $this->response(true, 'Exam data', [
                    'exam' => $exam,
                ], Response::HTTP_OK);

            } else {
                return $this->response(false, 'Exam not found.', [], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getExams(Request $request)
    {
        try {
            $exams = Exam::paginate(5);

            if ($exams->count()) {
                return $this->response(true, 'Exams data', [
                    'exams' => $exams,
                ], Response::HTTP_OK);

            } else {
                return $this->response(false, 'No exams found.', [], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
