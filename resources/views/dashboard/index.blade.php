@extends('layouts.app')

@section('content')
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <x-toast/>
        <ul class="flex flex-wrap justify-center text-sm font-medium text-center text-gray-500 border-b border-gray-200 rounded-t-lg bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-800"
            id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
            <li class="mr-2">
                <button id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings"
                        aria-selected="true"
                        class="inline-block p-4 text-blue-600 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-blue-500">
                    Setting
                </button>
            </li>
            <li class="mr-2">
                <button id="exams-tab" data-tabs-target="#exams" type="button" role="tab" aria-controls="exams"
                        aria-selected="false"
                        class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                    Exams
                </button>
            </li>
            <li class="mr-2">
                <button id="statistics-tab" data-tabs-target="#statistics" type="button" role="tab"
                        aria-controls="statistics" aria-selected="false"
                        class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">
                    Facts
                </button>
            </li>
        </ul>
        <div id="defaultTabContent">
            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="settings" role="tabpanel"
                 aria-labelledby="settings-tab">
                <div class="flex justify-center mb-4 z-0">
                    <div class="relative w-32 h-32 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        @if($user->avatar)
                            <img class="w-32 h-32 rounded-full"
                                 src="/storage/images/{{ $user->avatar }}" alt="Rounded avatar">
                        @else
                            <svg class="absolute w-32 h-32 text-gray-400 bottom-1" fill="currentColor"
                                 viewBox="0 0 20 20"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="pt-4">
                    @csrf
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group flex" style="align-items: center">
                            <input type="text" name="name" id="name"
                                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                   placeholder=" " value="{{ $user->name }}" required/>
                            <label for="name"
                                   class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-5 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Your
                                name</label>
                        </div>
                        <div class="relative z-0 w-full mb-6 group">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                   for="avatar">Upload photo</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="avatar_help" id="avatar" type="file" name="avatar"
                                accept="image/jpeg,image/png,image/jpg">
                        </div>
                    </div>
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Change
                    </button>
                </form>

                <div class="flex justify-center items-center my-10">
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

                <h5 class="text-xl mb-3 font-medium text-gray-900 dark:text-white text-center">Change password</h5>
                <form method="POST" action="{{ route('profile.update.password') }}" class="pt-4">
                    @csrf
                    <div class="relative z-0 w-full mb-6 group flex" style="align-items: center">
                        <input type="password" name="current_password" id="current_password"
                               class="block py-4 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " required/>
                        <label for="current_password"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-5 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Current
                            password</label>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-6 group flex" style="align-items: center">
                            <input type="password" name="password" id="password"
                                   class="block py-4 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                   placeholder=" " required/>
                            <label for="password"
                                   class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-5 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">New
                                password</label>
                        </div>
                        <div class="relative z-0 w-full mb-6 group flex" style="align-items: center">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                   class="block py-4 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                   placeholder=" " required/>
                            <label for="password_confirmation"
                                   class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-5 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm
                                new password</label>
                        </div>
                    </div>

                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Change password
                    </button>
                </form>
            </div>
            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="exams" role="tabpanel"
                 aria-labelledby="exams-tab">
                {{----}}
            </div>
            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="statistics" role="tabpanel"
                 aria-labelledby="statistics-tab">
                <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-6 dark:text-white sm:p-8">
                    <div class="flex flex-col">
                        <dt class="mb-2 text-3xl font-extrabold">73M+</dt>
                        <dd class="font-light text-gray-500 dark:text-gray-400">Developers</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-2 text-3xl font-extrabold">100M+</dt>
                        <dd class="font-light text-gray-500 dark:text-gray-400">Public repositories</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-2 text-3xl font-extrabold">1000s</dt>
                        <dd class="font-light text-gray-500 dark:text-gray-400">Open source projects</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
@endsection
