<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Response;
use App\Models\Result;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function exportPdfExamResults(Request $request)
    {
        $results = Result::where('exam_id', $request->exam_id)->get();
        $exam = Exam::find($request->exam_id);

        $data = [
            'results' => $results,
            'exam' => $exam
        ];

        $pdf = PDF::loadView('export.results', $data);
        return $pdf->download($exam->name . '-' . 'results.pdf');
    }

    public function exportPdfExamResponses(Request $request)
    {
        $result = Result::find($request->result);

        $responses = Response::where([
            'user_id' => $result->user_id,
            'exam_id' => $result->exam_id
        ])->get();

        $data = [
            'result' => $result,
            'responses' => $responses
        ];

        $pdf = PDF::loadView('export.responses', $data);
        return $pdf->download($result->user->name . '-' . 'responses.pdf');
    }
}
