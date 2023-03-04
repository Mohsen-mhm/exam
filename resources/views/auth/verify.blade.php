@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div
            class="flex justify-center flex-col items-center w-4/5 p-4 min-h-0 max-h-56 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8 dark:bg-gray-800/70 dark:border-gray-700">
            <h5 class="text-xl mb-2 font-medium text-gray-900 dark:text-white">Verify Your Email Address</h5>

            @if (session('resent'))
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
                    <div class="ml-3 text-sm font-normal">A fresh verification link has been sent to your email
                        address.
                    </div>
                </div>
            @endif
            <h4 class="text-lg font-medium text-gray-900 dark:text-white">Before proceeding, please check your email for
                a verification link.</h4>
            <h4 class="text-lg font-medium text-gray-900 dark:text-white">If you did not receive the email</h4>
            <form method="POST" action="{{ route('verification.resend') }}" class="w-full inline">
                @csrf
                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    click here to request another
                </button>
            </form>
        </div>
    </div>
@endsection
