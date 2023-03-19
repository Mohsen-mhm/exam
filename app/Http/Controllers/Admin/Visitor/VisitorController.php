<?php

namespace App\Http\Controllers\Admin\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    public function index()
    {
        $breadcrumb = [
            ['name' => 'Dashboard', 'route' => route('admin.home')],
            ['name' => 'Visitors', 'route' => route('admin.visitors.index')],
        ];

        $visits = DB::table('visitors')->select('visited_at')
            ->where('visited_at', '>=', Carbon::now()->subDays(30))
            ->orderBy('visited_at')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->visited_at)->format('Y-m-d');
            });

        $maxVisits = DB::table('visitors')->selectRaw('COUNT(*) as visits')
            ->where('visited_at', '>=', Carbon::now()->subDays(30))
            ->groupBy(DB::raw('date(visited_at)'))
            ->orderByRaw('visits DESC')
            ->limit(1)
            ->get()[0]->visits;
        $maxVisits = intval(ceil($maxVisits / 10) * 10) + 2;

        $labels = [];
        $data = [];

        $startDate = Carbon::now()->subDays(30);

        for ($date = $startDate; $date <= Carbon::now(); $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            $labels[] = $formattedDate;
            $data[] = isset($visits[$formattedDate]) ? count($visits[$formattedDate]) : 0;
        }

        $chartData = [
            'labels' => collect($labels),
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'fill' => false,
                    'backgroundColor' => 'rgb(227, 160, 8, 0.5)',
                    'borderColor' => 'rgb(227, 160, 8)',
                    'pointStyle' => 'circle',
                    'pointRadius' => 7,
                    'pointHoverRadius' => 10,
                    'data' => $data
                ]
            ]
        ];

        return view('admin.visitors.index', compact(['breadcrumb', 'chartData', 'maxVisits']));
    }
}
