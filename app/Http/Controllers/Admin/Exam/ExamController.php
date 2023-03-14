<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests\Exams\StoreExamRequest;
use App\Models\Exam;
use App\Models\Question;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $exams = Exam::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->orWhere('id', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('name')
            ->paginate(10);

        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Exams', 'route' => route('admin.exams.index')],
        ];

        // Count not started exams
        $notStarted = 0;
        foreach (Exam::all() as $exam) {
            if (!\Carbon\Carbon::now()->gte($exam->start_at)) {
                $notStarted++;
            }
        }

        // Count finished exams
        $finished = 0;
        foreach (Exam::all() as $exam) {
            if (\Carbon\Carbon::now()->gte($exam->finish_at)) {
                $finished++;
            }
        }

        // Count on performing exams
        $onPerforming = 0;
        foreach (Exam::all() as $exam) {
            if (\Carbon\Carbon::now()->between($exam->start_at, $exam->finish_at)) {
                $onPerforming++;
            }
        }

        return view('admin.exams.index', compact(['exams', 'breadcrumb', 'notStarted', 'finished', 'onPerforming']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Exams', 'route' => route('admin.exams.index')],
            ['name' => 'Create', 'route' => route('admin.exams.create')],
        ];

        return view('admin.exams.create', compact('breadcrumb'));
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
            return redirect(route('admin.exams.index'))->with('success', 'Created successfully.');
        else
            return redirect()->back()->withErrors('Unable to create exam...!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $exam = Exam::findOrFail($id);
        $search = $request->input('search');

        $questions = Question::when($search, function ($query, $search) {
            return $query->where('id', 'LIKE', '%' . $search . '%')
                ->orWhere('question', 'LIKE', '%' . $search . '%');
        })->where('exam_id', $exam->id)->paginate(10);

        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Exams', 'route' => route('admin.exams.index')],
            ['name' => 'Edit'],
        ];

        return view('admin.exams.edit', compact(['exam', 'breadcrumb', 'questions']));
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id, ExamService $examService)
    {
        $exam = Exam::findOrFail($id);

        foreach ($request->all() as $key => $value) {
            if ($key !== '_token' && $key !== '_method') {
                $validData[$key] = $value;
            }
        }

        $status = $examService->updateExam($validData, $exam);

        if ($status)
            return redirect(route('admin.exams.edit', $exam))->with('success', 'Updated successfully.');
        else
            return redirect()->back()->withErrors('Unable to update exam...!');
    }
}
