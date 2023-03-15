<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Questions\StoreQuestionRequest;
use App\Http\Requests\Questions\UpdateQuestionRequest;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request, QuestionService $questionService)
    {
        $examId = $request->input('exam_id');
        foreach ($request->all() as $key => $value) {
            if ($key !== '_token') {
                $validData[$key] = $value;
            }
        }
        $status = $questionService->storeQuestion($validData);

        if ($status)
            return redirect(route('exams.edit', $examId))->with('success', 'Created successfully.');
        else
            return redirect()->back()->withErrors('Unable to create question...!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::findOrFail($id);

        // Check ownership
        if ($question->exam->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        return view('dashboard.questions.edit', compact(['question']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, string $id, QuestionService $questionService)
    {
        $question = Question::findOrFail($id);

        // Check ownership
        if ($question->exam->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        foreach ($request->all() as $key => $value) {
            if ($key !== '_token' && $key !== '_method') {
                $validData[$key] = $value;
            }
        }
        $status = $questionService->updateQuestion($validData, $question);

        if ($status)
            return redirect(route('exams.edit', $question->exam_id))->with('success', 'Edited successfully.');
        else
            return redirect()->back()->withErrors('Unable to edit question...!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, QuestionService $questionService)
    {
        $question = Question::findOrFail($id);

        // Check ownership
        if ($question->exam->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        $status = $questionService->deleteQuestion($question);

        if ($status)
            return redirect(route('exams.edit', $question->exam_id))->with('success', 'Deleted successfully.');
        else
            return redirect()->back()->withErrors('Unable to delete question...!');
    }
}
