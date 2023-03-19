<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Response;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $examID = \Illuminate\Support\Facades\Request::input('exam');
        $exam = Exam::find($examID);

        // Check ownership
        if ($exam->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        $results = Result::where('exam_id', $examID)
            ->paginate(10);
        if ($results->count()) {
            foreach ($results as $result)
                $labels[] = $result->user->name;
        } else {
            $labels = [];
        }
        $data = $results->pluck('score');
        $chartData = [
            'labels' => collect($labels),
            'datasets' => [
                [
                    'label' => 'Exam Results',
                    'backgroundColor' => '#3490dc',
                    'data' => $data
                ]
            ]
        ];

        $questionCount = $exam->questions->count();

        return view('dashboard.results.index', compact(['results', 'chartData', 'questionCount']));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Result::find($id);

        // Check ownership
        if ($result->exam->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        $responses = Response::getResponses($result->user_id, $result->exam_id);

        return view('dashboard.results.show', compact(['result', 'responses']));
    }
}
