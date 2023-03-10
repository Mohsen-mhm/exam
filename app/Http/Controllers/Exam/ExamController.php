<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\StoreExamRequest;
use App\Http\Requests\Exams\UpdateExamRequest;
use App\Models\Exam;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamRequest $request, ExamService $examService)
    {
        foreach ($request->all() as $key => $value) {
            if ($key !== '_token') {
                $validData[$key] = $value;
            }
        }
        $validData['user_id'] = auth()->user()->id;
        $validData['link'] = strtolower(Str::random(10));

        $status = $examService->storeExam($validData);

        if ($status)
            return redirect(route('profile'))->with('success', 'Created successfully.');
        else
            return redirect()->back()->withErrors('Unable to create exam...!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exam = Exam::findOrFail($id);

        return view('dashboard.exams.edit', compact(['exam']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamRequest $request, string $id, ExamService $examService)
    {
        $exam = Exam::findOrFail($id);

        foreach ($request->all() as $key => $value) {
            if ($key !== '_token' && $key !== '_method') {
                $validData[$key] = $value;
            }
        }

        $status = $examService->updateExam($validData, $exam);

        if ($status)
            return redirect(route('exams.edit', $exam))->with('success', 'Updated successfully.');
        else
            return redirect()->back()->withErrors('Unable to update exam...!');
    }
}
