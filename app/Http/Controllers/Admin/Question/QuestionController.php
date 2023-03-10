<?php

namespace App\Http\Controllers\Admin\Question;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Questions\StoreQuestionRequest;
use App\Http\Requests\Admin\Questions\UpdateQuestionRequest;
use App\Models\Question;
use App\Services\Admin\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Exams', 'route' => route('admin.exams.index')],
            ['name' => 'Create'],
        ];

        return view('admin.questions.create', compact('breadcrumb'));
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
            return redirect(route('admin.exams.edit', $examId))->with('success', 'Created successfully.');
        else
            return redirect()->back()->withErrors('Unable to create question...!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $question = Question::findOrFail($id);

        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Exams', 'route' => route('admin.exams.index')],
            ['name' => 'Edit'],
        ];

        return view('admin.questions.edit', compact(['question', 'breadcrumb']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, string $id, QuestionService $questionService)
    {
        $question = Question::findOrFail($id);

        foreach ($request->all() as $key => $value) {
            if ($key !== '_token' && $key !== '_method') {
                $validData[$key] = $value;
            }
        }
        $status = $questionService->updateQuestion($validData, $question);

        if ($status)
            return redirect(route('admin.exams.edit', $question->exam_id))->with('success', 'Edited successfully.');
        else
            return redirect()->back()->withErrors('Unable to edit question...!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, QuestionService $questionService)
    {
        $question = Question::findOrFail($id);
        $status = $questionService->deleteQuestion($question);

        if ($status)
            return redirect(route('admin.exams.edit', $question->exam_id))->with('success', 'Deleted successfully.');
        else
            return redirect()->back()->withErrors('Unable to delete question...!');
    }
}
