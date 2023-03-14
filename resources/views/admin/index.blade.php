@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap justify-center -mx-4">
        <a href="{{ route('admin.users.index') }}" id="toast-simple" type="button"
           class="cursor-pointer flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow-lg border border-gray-700 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 m-2"
           role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="text-blue-400">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <div class="pl-4 font-bold inline-flex">Users:&nbsp;&nbsp;<p
                    class="text-blue-400">{{ \App\Models\User::count() }}</p></div>
        </a>

        <a href="{{ route('admin.exams.index') }}" id="toast-simple" type="button"
           class="cursor-pointer flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow-lg border border-gray-700 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 m-2"
           role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                 class="text-green-400"
                 viewBox="0 0 16 16" id="IconChangeColor">
                <path
                    d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"
                    id="mainIconPathAttribute" stroke="#5c5c5c" stroke-width="0"></path>
            </svg>
            <div class="pl-4 font-bold inline-flex">Exams:&nbsp;&nbsp;<p
                    class="text-green-400">{{ \App\Models\Exam::count() }}</p></div>
        </a>

        <a href="{{ route('admin.results.index') }}" id="toast-simple" type="button"
           class="cursor-pointer flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow-lg border border-gray-700 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 m-2"
           role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-activity text-red-400"
                 viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                      d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/>
            </svg>
            <div class="pl-4 font-bold inline-flex">Results:&nbsp;&nbsp;<p
                    class="text-red-400">{{ \App\Models\Result::count() }}</p></div>
        </a>

        <div id="toast-simple" data-popover-target="popover-visitors" data-popover-placement="bottom" type="button"
             class="cursor-pointer flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow-lg border border-gray-700 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 m-2"
             role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="text-yellow-400"
                 viewBox="0 0 16 16">
                <path
                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
            </svg>
            <div class="pl-4 font-bold inline-flex">Visitors:&nbsp;&nbsp;<p
                    class="text-yellow-400">{{ \Illuminate\Support\Facades\DB::table('visitors')->count() }}</p></div>
        </div>
        <div data-popover id="popover-visitors" role="tooltip"
             class="absolute z-10 invisible inline-block w-64 text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
            <div
                class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">Visitors</h3>
            </div>
            <div class="px-3 py-2">
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
            <div data-popper-arrow></div>
        </div>
    </div>
    <div class="flex flex-wrap justify-center">
        {!! \App\Http\Controllers\Admin\HomeController::calendar() !!}
    </div>
@endsection
