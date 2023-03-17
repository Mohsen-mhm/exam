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
        <div class="flex justify-start items-center px-4 flex-col-sm p-4">
            <p class="font-medium text-base dark:text-white mr-5">Export responses:</p>
            <a href="{{ route('responses.export.pdf', ['result' => $result->id]) }}"
               class="flex flex-col justify-center items-center text-red-400">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                     class="bi bi-file-earmark-pdf text-red-400" viewBox="0 0 16 16">
                    <path
                        d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                    <path
                        d="M4.603 14.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.697 19.697 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.188-.012.396-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.066.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.712 5.712 0 0 1-.911-.95 11.651 11.651 0 0 0-1.997.406 11.307 11.307 0 0 1-1.02 1.51c-.292.35-.609.656-.927.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.266.266 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.71 12.71 0 0 1 1.01-.193 11.744 11.744 0 0 1-.51-.858 20.801 20.801 0 0 1-.5 1.05zm2.446.45c.15.163.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.876 3.876 0 0 0-.612-.053zM8.078 7.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                </svg>PDF
            </a>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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

