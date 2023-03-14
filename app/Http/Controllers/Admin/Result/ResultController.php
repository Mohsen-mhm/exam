<?php

namespace App\Http\Controllers\Admin\Result;

use App\Http\Controllers\Controller;
use App\Models\Response;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $results = Result::when($search, function ($query, $search) {
            return $query->where('score', 'LIKE', '%' . $search . '%');
        })
            ->paginate(10);

        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Results', 'route' => route('admin.results.index')],
        ];

        return view('admin.results.index', compact('results', 'breadcrumb'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $result = Result::find($id);
        $responses = Response::getResponses($result->user_id, $result->exam_id);

        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Results', 'route' => route('admin.results.index')],
            ['name' => 'Responses'],
        ];

        return view('admin.results.show', compact('responses', 'breadcrumb'));
    }
}
