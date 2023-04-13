<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Questions\StoreQuestionRequest;
use App\Models\Exam;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    public function store(StoreQuestionRequest $request, QuestionService $questionService)
    {
        try {
            $examId = $request->input('exam_id');
            $exam = Exam::find($examId);
            if (!$exam) {
                return $this->response(false, 'This exam is not exists.', [], Response::HTTP_NOT_FOUND);
            }

            foreach ($request->all() as $key => $value) {
                $validData[$key] = $value;
            }

            $question = $questionService->storeQuestion($validData);

            if ($question) {
                return $this->response(true, 'Created successfully.', [
                    'question' => $question,
                ], Response::HTTP_OK);

            } else {
                return $this->response(false, 'Unable to create question...!', [], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (\Exception $exception) {
            return $this->response(false, $exception->getMessage(), [], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
