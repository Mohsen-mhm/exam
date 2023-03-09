<?php

namespace App\Http\Controllers\Admin\Exam;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Exams\StoreExamRequest;
use App\Models\Exam;
use App\Services\Admin\ExamService;
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
                ->orWhere('description', 'LIKE', '%' . $search . '%');
        })
            ->orderBy('name')
            ->paginate(10);

        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Exams', 'route' => route('admin.exams.index')],
        ];

        return view('admin.exams.index', compact('exams', 'breadcrumb'));
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
    public function edit(string $id)
    {
        $exam = Exam::findOrFail($id);

        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Exams', 'route' => route('admin.exams.index')],
            ['name' => 'Edit'],
        ];

        return view('admin.exams.edit', compact(['exam', 'breadcrumb']));
    }

    /**
     * Update the specified resource in storage.
     */
    public
    function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        //
    }
}
