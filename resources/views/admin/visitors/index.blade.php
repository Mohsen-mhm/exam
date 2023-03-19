@extends('layouts.app')

@section('content')
    <x-toast/>
    <div class="flex justify-between px-4 flex-col-sm border-b-2 pb-4">
        <x-breadcrumb :items="$breadcrumb"/>
        <ul class="max-w-md space-y-1 text-gray-500 list-inside dark:text-gray-400">
            <li class="flex items-center font-normal">
                <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
                &nbsp;Today:&nbsp;&nbsp;<p
                    class="text-yellow-400 font-bold">{{ \Illuminate\Support\Facades\DB::table('visitors')->whereDate('visited_at',\Carbon\Carbon::today())->count() }}</p>
            </li>
            <li class="flex items-center font-normal">
                <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
                &nbsp;Yesterday:&nbsp;&nbsp;<p
                    class="text-yellow-400 font-bold">{{ \Illuminate\Support\Facades\DB::table('visitors')->whereDate('visited_at',\Carbon\Carbon::yesterday())->count() }}</p>
            </li>
            <li class="flex items-center font-normal">
                <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
                &nbsp;Last month:&nbsp;&nbsp;<p
                    class="text-yellow-400 font-bold">{{ \Illuminate\Support\Facades\DB::table('visitors')->whereBetween('visited_at' ,[\Carbon\Carbon::now()->subMonth()->startOfMonth(), \Carbon\Carbon::now()])->count() }}</p>
            </li>
            <li class="flex items-center font-normal">
                <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                          clip-rule="evenodd"></path>
                </svg>
                &nbsp;All:&nbsp;&nbsp;<p
                    class="text-yellow-400 font-bold">{{ \Illuminate\Support\Facades\DB::table('visitors')->count() }}</p>
            </li>
        </ul>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex justify-center mt-7">
            <canvas id="visitors-chart"></canvas>
        </div>
    </div>
@endsection

@section('style')
    <style>
        @media (max-width: 768px) {
            .flex-col-sm {
                flex-direction: column;
            }
        }
    </style>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('visitors-chart').getContext('2d');
        var chartData = @php echo json_encode($chartData); @endphp;
        var myChart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: {{ $maxVisits }},
                        }
                    }]
                }
            }
        });
    </script>
@endsection

