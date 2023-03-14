@extends('layouts.app')

@section('content')
    <x-toast/>
    <div class="flex justify-center">
        <div id="marketing-banner" tabindex="-1"
             class="w-3/4 fixed z-40 flex flex-col md:flex-row justify-between p-4 -translate-x-1/2 bg-white border border-gray-100 rounded-lg shadow-sm left-1/2 top-20 dark:bg-gray-700 dark:border-gray-600">
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
    <form action="{{ route('exam.check', $exam->link) }}" method="POST">
        @csrf
        <fieldset class="mt-20">
            <legend class="sr-only">Questions</legend>
            @foreach($exam->questions as $question)
                <div class="py-4 border-b border-dashed border-gray-500">
                    <p class="flex items-center text-sm font-bold text-gray-500 dark:text-gray-300 mb-2">{{ $question->question }}</p>
                    <div class="flex items-center mb-4">
                        <input id="q-{{ $question->id }}" type="radio" name="q_{{ $question->id }}" value="1"
                               class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="q-{{ $question->id }}"
                               class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ $question->o1 }}
                        </label>
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="q-{{ $question->id }}" type="radio" name="q_{{ $question->id }}" value="2"
                               class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="q-{{ $question->id }}"
                               class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ $question->o2 }}
                        </label>
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="q-{{ $question->id }}" type="radio" name="q_{{ $question->id }}" value="3"
                               class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="q-{{ $question->id }}"
                               class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ $question->o3 }}
                        </label>
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="q-{{ $question->id }}" type="radio" name="q_{{ $question->id }}" value="4"
                               class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring:blue-300 dark:focus-ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="q-{{ $question->id }}"
                               class="block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            {{ $question->o4 }}
                        </label>
                    </div>
                </div>
            @endforeach
        </fieldset>
        <button type="submit"
                class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Send answers
        </button>
    </form>
@endsection

@section('script')
    <script>
        const examEndEl = document.getElementById('exam');
        const examEnd = new Date(examEndEl.dataset.date);
        const examEndTime = examEndEl.dataset.endTime;
        const examTime = {{ $exam->time }};
        let duration;

        function startTimer() {
            const timer = setInterval(() => {
                const currentTime = new Date().getTime();
                const sessionKey = "endTime_{{ $exam->id }}";
                const endTimeStr = sessionStorage.getItem(sessionKey);
                const endTime = new Date(endTimeStr).getTime();
                const timeLeft = endTime - currentTime;
                const minutesLeft = Math.floor((timeLeft % (1000 * 60 * examTime)) / (1000 * 60));
                const secondsLeft = Math.floor((timeLeft % (1000 * 60)) / 1000);

                // Update the HTML with the remaining time
                document.getElementById("timer").innerHTML = minutesLeft + "m " + secondsLeft + "s ";

                // Update the stored endTime in session to reflect the new target time
                const newEndTime = new Date(currentTime + timeLeft);
                const newEndTimeStr = newEndTime.toISOString();
                sessionStorage.setItem(sessionKey, newEndTimeStr);

                // Check if the time has run out
                if (timeLeft < 0 || examEnd < currentTime) {
                    clearInterval(timer);
                    document.getElementById("timer").innerHTML = "Time's up!";
                    setTimeout(() => {
                        window.location.href = "{{ route('home') }}";
                    }, 1000);

                    // Remove the endTime from session
                    sessionStorage.removeItem(sessionKey);
                }
            }, 500);
        }

        if (sessionStorage.getItem("endTime_{{ $exam->id }}")) {
            startTimer();
        } else {
            if (examEndTime < examTime) {
                duration = examEndTime * 60 * 1000; // Remaining time in milliseconds
            } else {
                duration = examTime * 60 * 1000; // Full exam time in milliseconds
            }

            // Store the endTime in session
            const endTime = new Date(new Date().getTime() + duration);
            const endTimeStr = endTime.toISOString();
            const sessionKey = "endTime_{{ $exam->id }}";
            sessionStorage.setItem(sessionKey, endTimeStr);

            startTimer();
        }
        window.onload = startTimer;

        // disable context menu (right click)
        document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
@endsection
