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
                &nbsp;All results:&nbsp;&nbsp;<p
                    class="text-blue-400 font-bold">{{ \App\Models\Result::count() }}</p>
            </li>
        </ul>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex items-center justify-between p-4 flex-col-sm">
            <label for="table-search" class="sr-only">Search</label>
            <form action="" method="GET">
                <div class="flex">
                    <button type="submit"
                            class="inset-y-0 left-0 flex items-center dark:bg-gray-800 border dark:border-gray-600 border-r-0 rounded-lg rounded-br-none rounded-tr-none px-2 cursor-pointer z-50">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 cursor-pointer" aria-hidden="true"
                             fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    @php
                        $search = \Illuminate\Support\Facades\Request::input('search');
                    @endphp
                    <input type="search" id="table-search-users" name="search"
                           class="block p-2 text-sm text-gray-900 border border-gray-300 rounded-lg rounded-tl-none rounded-bl-none bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Search for results" value="{{ $search }}">
                </div>
            </form>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    id
                </th>
                <th scope="col" class="px-6 py-3">
                    user
                </th>
                <th scope="col" class="px-6 py-3">
                    exam
                </th>
                <th scope="col" class="px-6 py-3">
                    score
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            @if(\App\Models\Result::count())
                @foreach($results as $result)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <div class="pl-3">
                                <div class="text-base font-semibold">{{ $loop->iteration }}</div>
                            </div>
                        </th>
                        <td class="px-6 py-4">
                            @php
                                $user = \App\Models\User::find($result->user_id);
                            @endphp
                            <a href="{{ route('admin.users.index', 'search='.$user->email) }}"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">{{ $user->name }}</a>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $exam = \App\Models\Exam::find($result->exam_id);
                            @endphp
                            <a href="{{ route('admin.exams.index', 'search='.$exam->id) }}"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">{{ $exam->name }}</a>
                        </td>
                        <td class="px-6 py-4">
                            <p
                                class="font-medium text-base dark:text-base mr-2">{{ $result->score }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.results.show', $result->id) }}"
                               class="font-medium text-blue-600 dark:text-blue-500 hover:underline mr-2">Show responses</a>
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
                                <span class="font-medium">No result found!</span>
                            </div>
                        </div>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="flex justify-center">
        {{ $results->links() }}
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

