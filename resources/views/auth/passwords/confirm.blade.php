@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div
            class="flex justify-center flex-col items-center w-4/5 p-4 min-h-0 max-h-56 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8 dark:bg-gray-800/70 dark:border-gray-700">
            <h5 class="text-xl mb-2 font-medium text-gray-900 dark:text-white">Confirm password</h5>
            <h4 class="text-lg font-medium text-gray-900 dark:text-white">Please confirm your password before
                continuing.</h4>

            <form method="POST" action="{{ route('password.confirm') }}" class="w-full">
                @csrf
                <div class="relative z-0 w-full mb-6 group">
                    <input type="password" name="password" id="password"
                           class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                           placeholder=" " required/>
                    <label for="password"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                        address</label>
                    @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Confirm password
                </button>
                @if (Route::has('password.request'))
                    <div class="relative z-0 w-full mt-5 group">
                        <a href="{{ route('password.request') }}"
                           class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
