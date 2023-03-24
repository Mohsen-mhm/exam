@extends('layouts.app')

@section('content')
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <x-toast/>
        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="mr-2">
                    <a href="{{ route('profile') }}"
                       class="inline-flex p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group"
                       aria-current="page">
                        <svg aria-hidden="true" class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-500"
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('profile.exams') }}"
                       class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                        <svg aria-hidden="true"
                             class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path>
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
        <div class="flex flex-wrap justify-center -mx-4">

            <div id="toast-simple" type="button"
                 class="cursor-pointer flex items-center w-4/5 max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow-lg border border-gray-700 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 m-2"
                 role="alert">
                <svg width="50" height="50" stroke-width="1.5" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg" class="text-red-400">
                    <path
                        d="M2 15V9C2 5.68629 4.68629 3 8 3H16C19.3137 3 22 5.68629 22 9V15C22 18.3137 19.3137 21 16 21H8C4.68629 21 2 18.3137 2 15Z"
                        stroke="currentColor"/>
                    <path d="M12 9V15" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 9V15" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.9999 12H14.5C15.3284 12 16 11.3284 16 10.5V10.5C16 9.67157 15.3284 9 14.5 9L12 9"
                          stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <div class="pl-4 font-bold inline-flex text-sm">IP:&nbsp;&nbsp;<p
                        class="font-medium text-red-400">{{ request()->ip() }}</p></div>
            </div>

            <div id="toast-simple" type="button"
                 class="cursor-pointer flex items-center w-4/5 max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow-lg border border-gray-700 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 m-2"
                 role="alert">
                <svg width="50" height="50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                     class="text-yellow-300">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m15 12-4-4m4 4-4 4m4-4H5m5 9a9 9 0 1 0 0-18"/>
                </svg>
                @php
                    $lastVisit = \Illuminate\Support\Facades\DB::table('visitors')->where('user_id', \Illuminate\Support\Facades\Auth::id())->latest('visited_at')->first();
                @endphp
                <div class="pl-4 font-bold inline-flex text-sm">Last login:&nbsp;&nbsp;<p
                        class="font-medium text-yellow-300">{{ \Carbon\Carbon::parse($lastVisit->visited_at)->diffForHumans() }}</p>
                </div>
            </div>

            <div id="toast-simple" type="button"
                 class="cursor-pointer flex items-center w-4/5 max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow-lg border border-gray-700 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 m-2"
                 role="alert">
                @php
                    $nowVisit = \Illuminate\Support\Facades\DB::table('visitors')->where('user_id', \Illuminate\Support\Facades\Auth::id())->latest('visited_at')->first();
                    $agent = new \Jenssegers\Agent\Agent();
                    $agent->setUserAgent($nowVisit->user_agent);
                @endphp
                @if($agent->isDesktop())
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                         class="bi bi-laptop text-blue-600" viewBox="0 0 16 16">
                        <path
                            d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5h11zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2h-11zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5z"/>
                    </svg>
                @elseif($agent->isMobile())
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                         class="bi bi-phone text-blue-600" viewBox="0 0 16 16">
                        <path
                            d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                        <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                @elseif($agent->isTablet())
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                         class="bi bi-tablet text-blue-600" viewBox="0 0 16 16">
                        <path
                            d="M12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                        <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                    </svg>
                @endif
                <div class="pl-4 font-bold inline-flex text-sm">Device:&nbsp;&nbsp;<p
                        class="font-medium text-blue-600">{{ $agent->platform() }}</p>
                </div>
            </div>

        </div>
    </div>
@endsection
