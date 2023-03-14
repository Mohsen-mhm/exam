<?php

namespace App\Http\Controllers\Response;

use App\Http\Controllers\Controller;
use App\Http\Requests\Response\ResponseRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Services\Response\ResponseService;
use App\Services\Result\ResultService;

class ResponsesController extends Controller
{
    public function examCheck($link, ResponseRequest $request, ResponseService $responseService, ResultService $resultService)
    {
        $exam = Exam::findByLink($link);
        $score = 0;
        foreach ($request->validated() as $key => $value) {
            if (strpos($key, 'q_') === 0) {
                $questionId = intval(substr($key, 2));

                $responseData = [
                    'user_id' => auth()->user()->id,
                    'exam_id' => $exam->id,
                    'question_id' => $questionId,
                    'answer' => $value,
                ];
                $response = $responseService->storeResponse($responseData);
            }

            $question = Question::findQuestion($questionId);

            if ($question->isCorrect($response->answer)) {
                $score++;
            }
        }

        $resultData = [
            'user_id' => auth()->user()->id,
            'exam_id' => $exam->id,
            'score' => $score,
        ];

        $result = $resultService->storeResult($resultData);
        $score = $result->score;

        return view('exams.result', compact(['exam','score']));
    }
}
