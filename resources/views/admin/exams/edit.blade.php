@extends('layouts.app')

@section('content')
    <x-toast/>
    <x-breadcrumb :items="$breadcrumb"/>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center justify-end p-4 flex-col-sm">
            <a href="{{ route('admin.questions.create') }}" type="button"
               class="my-2 text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Create question
            </a>
        </div>
        {{ session()->put('exam_id', $exam->id) }}
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    Question
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @if(\App\Models\Question::where('exam_id', $exam->id)->count())
                @foreach(\App\Models\Question::where('exam_id', $exam->id)->get() as $question)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th
                            class="flex items-center pl-4 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="pl-3">
                                <div
                                    class="text-base font-semibold">{{ $loop->iteration }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            <div
                                class="w-96 font-normal text-gray-500 truncate overflow-ellipsis">{{ $question->question }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.questions.edit', compact('question')) }}"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">Edit
                                question</a>
                            <a class="font-medium text-red-600 dark:text-red-500 hover:underline ml-2 cursor-pointer"
                               onclick="document.getElementById('delete-question-{{ $question->id }}').submit()">Delete question</a>
                            <form action="{{ route('admin.questions.destroy', $question) }}" method="POST"
                                  id="delete-question-{{ $question->id }}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center">
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
                                <span class="font-medium">No question found! Please add first question</span>
                            </div>
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
