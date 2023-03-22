@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        @php
            $user = \App\Models\User::getUser(request()->user);
        @endphp
        <div
            class="flex flex-col justify-center items-center w-4/5 p-4 min-h-0 max-h-96 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8 dark:bg-gray-800/70 dark:border-gray-700">
        <x-toast/>
            <div class="w-auto flex justify-center mb-5">
                <div id="toast-simple"
                     class="flex items-center w-full p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 mt-5"
                     role="alert">
                    <svg aria-hidden="true" class="w-5 h-5 text-blue-600 dark:text-blue-500" focusable="false"
                         data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 512 512">
                        <path fill="currentColor"
                              d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path>
                    </svg>
                    <div class="flex flex-col">
                        <div class="pl-4 text-sm font-normal flex">SMS sent successfully to:&nbsp; <p
                                id="phone">{{ "+" . $user->country_code . $user->phone }}</p>.
                        </div>
                    </div>
                </div>
            </div>
            <h5 class="text-xl mb-2 font-medium text-gray-900 dark:text-white">Authenticate two factor</h5>

            <form method="POST" action="{{ route('authenticate.two.factor', ['user' => $user]) }}" class="w-full">
                @csrf
                <div class="relative z-0 w-full mb-6 group">
                    <input type="number" name="code" id="code"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           placeholder=" " value="{{ old('code') }}" required/>
                    <label for="code"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Code</label>
                    @error('code')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Login
                </button>
            </form>
        </div>
    </div>
@endsection
