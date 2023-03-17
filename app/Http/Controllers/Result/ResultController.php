<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Response;
use App\Models\Result;
use Illuminate\Http\Request;
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

        return view('dashboard.results.index', compact('results'));
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

        return view('dashboard.results.show', compact(['result','responses']));
    }
}
