<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Result;
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
        $pdf = PDF::loadView('export.pdf', $data);
        return $pdf->download($exam->name . '-' . 'results.pdf');
    }
}
