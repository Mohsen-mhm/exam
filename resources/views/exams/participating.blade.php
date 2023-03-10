@extends('layouts.app')

@section('content')
    <div class="w-full flex justify-center">
        <x-toast/>
        <div
            class="w-3/4 p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">{{ $exam->name }}</h5>
            <!-- List -->
            <ul role="list" class="space-y-5 my-7">
                <li class="flex space-x-3 my-2">
                    <!-- Icon -->
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-600 dark:text-green-500"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check
                            icon</title>
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span
                        class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $exam->description }}</span>
                </li>
                <li class="flex space-x-3 my-2">
                    <!-- Icon -->
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-600 dark:text-green-500"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check
                            icon</title>
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span
                        class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400 truncate">{{ url(route('participating', $exam->link)) }}</span>
                    <button id="copy-button" data-popover-target="popover-default"
                            data-copy-text="{{ url(route('participating', $exam->link)) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                             class="bi bi-clipboard text-yellow-300" viewBox="0 0 16 16">
                            <path
                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                            <path
                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                        </svg>
                    </button>
                    <div data-popover id="popover-default" role="tooltip"
                         class="absolute z-10 invisible inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-auto dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 id="popover-text"
                                class="font-semibold text-yellow-300 dark:text-yellow-300 text-center">Copy link</h3>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </li>
                <li class="flex space-x-3 my-2">
                    <!-- Icon -->
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-600 dark:text-green-500"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check
                            icon</title>
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"></path>
                    </svg>
                    @php
                        $user = \App\Models\User::find($exam->user_id);
                    @endphp
                    <span
                        class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">By: {{ $user->name }}</span>
                </li>
                <li class="flex space-x-3 my-2">
                    <!-- Icon -->
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-600 dark:text-green-500"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check
                            icon</title>
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <span style="width: 220px"
                              class="p-1 text-center bg-green-100 text-green-800 text-xs font-medium rounded dark:bg-gray-700 dark:text-green-400 border border-green-400">{{ \Carbon\Carbon::parse($exam->start_at)->format('l, d F Y , H:i') }}</span>

                    </div>
                </li>
                <li class="flex space-x-3 my-2">
                    <!-- Icon -->
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-600 dark:text-green-500"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check
                            icon</title>
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <span style="width: 220px"
                              class="p-1 mt-1 text-center bg-red-100 text-red-800 text-xs font-medium rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">{{ \Carbon\Carbon::parse($exam->finish_at)->format('l, d F Y , H:i') }}</span>
                    </div>
                </li>

                <li class="flex space-x-3 my-2">
                    <!-- Icon -->
                    <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-green-600 dark:text-green-500"
                         fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Check
                            icon</title>
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span
                        class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $exam->time }} minutes</span>
                </li>
            </ul>
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button"
                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">
                participation
            </button>
        </div>
    </div>

    <div id="popup-modal" tabindex="-1"
         class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6 text-center">
                    <svg aria-hidden="true"
                         class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you
                        sure you want to participate in {{ $exam->name }}?</h3>
                    <a href="{{ route('exam', $exam->link) }}" data-modal-hide="popup-modal" type="button"
                       class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Yes, I'm sure
                    </a>
                    <button data-modal-hide="popup-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var copyButton = document.getElementById('copy-button');
        var popoverText = document.getElementById('popover-text');

        copyButton.addEventListener('click', function () {
            var textToCopy = this.getAttribute('data-copy-text');
            navigator.clipboard.writeText(textToCopy).then(function () {
                popoverText.innerHTML = 'Copied !';
                setTimeout(function () {
                    popoverText.innerHTML = 'Copy link';
                }, 1500)
            }, function (err) {
                console.error('Could not copy text: ', err);
            });
        });
    </script>
@endsection
