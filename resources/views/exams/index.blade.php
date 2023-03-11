@extends('layouts.app')

@section('content')
    <x-toast/>
    <div class="flex justify-center">
        <div id="marketing-banner" tabindex="-1"
             class="w-3/4 fixed z-50 flex flex-col md:flex-row justify-between p-4 -translate-x-1/2 bg-white border border-gray-100 rounded-lg shadow-sm left-1/2 top-6 dark:bg-gray-700 dark:border-gray-600">
            <div class="flex flex-col items-start mr-4 md:items-center md:flex-row md:mb-0">
                <div>
                    <p class="flex items-center text-sm font-bold text-gray-500 dark:text-gray-300">Time left:</p>
                    <p id="timer" class="flex items-center text-sm font-bold text-yellow-300">0m 0s</p>
                </div>
                <div id="exam" class="hidden" data-date="{{ $exam->finish_at }}"
                     data-end-time="{{ \Illuminate\Support\Carbon::now()->diffInMinutes($exam->finish_at) }}"></div>
            </div>
        </div>
    </div>

    @php
        $endExamTime = \Illuminate\Support\Carbon::now()->diffInMinutes($exam->finish_at);
        $examDuration = $exam->time;
    @endphp

    <script>
        const examEndEl = document.getElementById('exam');
        const examEnd = new Date(examEndEl.dataset.date);
        const examEndTime = examEndEl.dataset.endTime;

        const currentTime = new Date().getTime();
        const examTime = {{ $exam->time }};

        if (examEndTime < examTime) {
            var duration = examEndTime * 60 * 1000; // Remaining time in milliseconds
        } else {
            var duration = examTime * 60 * 1000; // Full exam time in milliseconds
        }

        const endTime = currentTime + duration;
        const endDate = new Date(endTime);
        const endHour = endDate.getHours();
        const endMinute = endDate.getMinutes();
        const endSecond = endDate.getSeconds();

        const timer = setInterval(() => {
            const currentTime = new Date().getTime();
            const timeLeft = endTime - currentTime;
            const minutesLeft = Math.floor((timeLeft % (1000 * 60 * {!! $exam->time !!})) / (1000 * 60));
            const secondsLeft = Math.floor((timeLeft % (1000 * 60)) / 1000);

            // Update the HTML with the remaining time
            document.getElementById("timer").innerHTML = minutesLeft + "m " + secondsLeft + "s ";

            // Check if the time has run out
            if (timeLeft < 0 || examEnd < currentTime) {
                clearInterval(timer);
                document.getElementById("timer").innerHTML = "Time's up!";
                setTimeout(() => {
                    window.location.href = "{{ route('home') }}";
                }, 1000);
            }
        }, 500);
        // disable context menu (right click)
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
@endsection
