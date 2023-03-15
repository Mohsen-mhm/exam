<?php

namespace App\Http\Controllers\Result;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Response;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Result::where('exam_id', \Illuminate\Support\Facades\Request::input('exam'))
            ->paginate(10);

        return view('dashboard.results.index', compact('results'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Result::find($id);
        $responses = Response::getResponses($result->user_id, $result->exam_id);

        return view('dashboard.results.show', compact(['responses']));
    }
}
