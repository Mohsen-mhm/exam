@extends('layouts.app')

@section('content')
    <div
        class="flex justify-center flex-col items-center w-4/5 p-4 min-h-0 max-h-96 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8 dark:bg-gray-800/70 dark:border-gray-700">
        <h5 class="text-xl mb-2 font-medium text-gray-900 dark:text-white">Reset password</h5>
        @if(session('status'))
            <div id="toast-success"
                 class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-900 mb-16"
                 role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ml-3 text-sm font-normal">{{ session('status') }}</div>
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" class="w-full">
            @csrf
            <div class="relative z-0 w-full mb-6 group">
                <input type="email" name="email" id="email"
                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                       placeholder=" " value="{{ old('email') }}" required/>
                <label for="email"
                       class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                    address</label>
                @error('email')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                        class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Send password reset link
            </button>
        </form>
    </div>
@endsection
