<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Exams\StoreExamRequest;
use App\Models\Exam;
use App\Services\ExamService;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ExamController extends Controller
{
    public function getExam($examId)
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

    public function getExams()
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

    public function store(StoreExamRequest $request, ExamService $examService)
    {
        try {

            foreach ($request->all() as $key => $value) {
                $validData[$key] = $value;
            }

            $validData['user_id'] = auth()->user()->id;
            $validData['link'] = strtolower(Str::random(10));

            $exam = $examService->storeExam($validData);

            if ($exam) {
                return $this->response(true, 'Created successfully.', [
                    'exam' => $exam,
                ], Response::HTTP_OK);
            } else {
                return $this->response(false, 'Unable to create exam...!', [], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
