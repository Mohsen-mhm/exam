@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-4">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-white">Exams</h2>
            <p class="mt-2 text-sm text-gray-400">All available Exams</p>
        </div>
    </div>

    
    <div class="flex justify-center items-center my-1">
        <div class="border-t border-gray-300 w-1/3"></div>
        <div class="px-2">
            <svg aria-hidden="true" class="w-8 h-8 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
        </div>
        <div class="border-t border-gray-300 w-1/3"></div>
    </div>
    <div class="flex flex-wrap justify-center -mx-4">
        @foreach($exams as $exam)
            <div
                class="m-2 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor"
                         class="text-gray-400"
                         viewBox="0 0 16 16" id="IconChangeColor">
                        <path
                            d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"
                            id="mainIconPathAttribute" stroke="#5c5c5c" stroke-width="0"></path>
                    </svg>
                </div>
                <a href="#">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $exam->name }}</h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 truncate overflow-ellipsis">{{ $exam->description }}</p>
                <p class="mb-3 font-normal text-gray-500 dark:text-yellow-400">Start
                    at: {{ \Carbon\Carbon::parse($exam->start_at)->format('l, d F Y , H:i') }}</p>
                <p class="mb-3 font-normal text-gray-500 dark:text-yellow-400">Finish
                    at: {{ \Carbon\Carbon::parse($exam->finish_at)->format('l, d F Y , H:i') }}</p>
                <p class="mb-3 font-bold text-gray-500 dark:text-gray-400">Time: {{ $exam->time }} minutes</p>
                <div class="flex justify-center">
                    @guest
                        <a href="{{ route('login') }}" type="button"
                           class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mt-2">
                            Login first
                        </a>
                    @elseif(\Carbon\Carbon::now()->between($exam->start_at, $exam->finish_at))
                        <a href="{{ route('participating', $exam->link) }}" type="button"
                           class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            Participating in test
                        </a>
                    @else
                        @if(! \Carbon\Carbon::now()->gte($exam->start_at))
                            <a type="button"
                               class="cursor-pointer text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 shadow-lg shadow-lime-500/50 dark:shadow-lg dark:shadow-lime-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                Not start yet
                            </a>
                        @elseif(\Carbon\Carbon::now()->gte($exam->finish_at))
                            <a type="button"
                               class="cursor-pointer text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 shadow-lg shadow-purple-500/50 dark:shadow-lg dark:shadow-purple-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                Finished
                            </a>
                        @endif
                    @endguest
                </div>
            </div>
        @endforeach
    </div>
@endsection
