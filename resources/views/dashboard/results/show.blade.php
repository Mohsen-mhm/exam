@extends('layouts.app')

@section('content')
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <x-toast/>
        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="mr-2">
                    <a href="{{ route('profile') }}"
                       class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                        <svg aria-hidden="true"
                             class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('profile.exams') }}"
                       class="inline-flex p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group"
                       aria-current="page">
                        <svg aria-hidden="true" class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-500"
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Exams
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('setting') }}"
                       class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                        <svg aria-hidden="true"
                             class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path>
                        </svg>
                        Settings
                    </a>
                </li>
            </ul>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        user
                    </th>
                    <th scope="col" class="px-6 py-3">
                        exam
                    </th>
                    <th scope="col" class="px-6 py-3">
                        question
                    </th>
                    <th scope="col" class="px-6 py-3">
                        answer
                    </th>
                </tr>
                </thead>
                <tbody>
                @if($responses->count())
                    @foreach($responses as $response)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                @php
                                    $user = \App\Models\User::find($response->user_id);
                                @endphp
                                <p
                                    class="font-medium text-base dark:text-base mr-2">{{ $user->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $exam = \App\Models\Exam::find($response->exam_id);
                                @endphp
                                <a href="{{ route('profile', 'search='.$exam->id) }}"
                                   class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">{{ $exam->name }}</a>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $question = \App\Models\Question::find($response->question_id);
                                @endphp
                                <a href="{{ route('exams.edit', ['exam'=>$exam, 'search='.$question->id]) }}"
                                   class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">ID: {{ $question->id }}</a>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($response->answer == $question->answer)
                                        <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                                        {{ $response->answer }}
                                    @else
                                        <div class="h-2.5 w-2.5 rounded-full bg-red-500 mr-2"></div>
                                        {{ $response->answer }}
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            <div
                                class="flex justify-center m-7 p-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300 dark:border-yellow-800"
                                role="alert">
                                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor"
                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                <span class="sr-only">Info</span>
                                <div>
                                    <span class="font-medium">No response found!</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
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

