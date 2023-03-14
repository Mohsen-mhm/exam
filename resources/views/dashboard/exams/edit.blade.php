@extends('layouts.app')

@section('content')
    <x-toast/>
    <div class="flex justify-center mb-5">
        <div
            class="flex flex-col justify-center items-center w-4/5 p-4 min-h-96 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8 dark:bg-gray-800/70 dark:border-gray-700">
            <h5 class="text-xl mb-3 font-medium text-gray-900 dark:text-white">Create exam</h5>

            <form method="POST" action="{{ route('exams.update', $exam) }}" class="w-full" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="grid md:grid-cols-2 md:gap-6 items-end">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="name" id="name"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " value="{{ old('name', $exam->name) }}" required/>
                        <label for="name"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Name</label>
                        @error('name')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <textarea name="description" id="description"
                                  class="block px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                  placeholder=" " style="padding-top: 2rem;"
                                  required>{{ old('description', $exam->description) }}</textarea>
                        <label for="description"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-8 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75">Description</label>
                        @error('description')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6 mb-4 items-end">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="start_at" id="start_at"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " value="{{ old('start_at', $exam->start_at) }}" required/>
                        <label for="start_at"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Start
                            at</label>
                        @error('start_at')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="finish_at" id="finish_at"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " value="{{ old('finish_at', $exam->finish_at) }}" required/>
                        <label for="finish_at"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Finish
                            at</label>
                        @error('finish_at')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Edit
                </button>
            </form>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center justify-end p-4 flex-col-sm">
            <a href="{{ route('questions.create') }}" type="button"
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
                            <a href="{{ route('questions.edit', compact('question')) }}"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">Edit
                                question</a>
                            <a class="font-medium text-red-600 dark:text-red-500 hover:underline ml-2 cursor-pointer"
                               onclick="document.getElementById('delete-question-{{ $question->id }}').submit()">Delete
                                question</a>
                            <form action="{{ route('questions.destroy', $question) }}" method="POST"
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

@section('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/themes/dark.css">
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#start_at", {
            theme: "dark",
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            timezone: "Asia/Tehran",
        });
        flatpickr("#finish_at", {
            theme: "dark",
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            timezone: "Asia/Tehran",
        });
    </script>
@endsection
