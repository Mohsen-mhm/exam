@extends('layouts.app')

@section('content')
    <x-toast/>
    <div
        class="w-auto p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold text-gray-900 dark:text-white">Exam: {{ $exam->name }}</h5>
        <p class="mb-5 text-lg text-gray-500 sm:text-lg dark:text-gray-400">You scored {{ $score }} out
            of {{ $exam->questions->count() }}.</p>
        <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
            <a href="{{ route('home') }}"
               class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <div class="text-left">
                    <p class="-mt-1 font-sans text-sm font-semibold transition">Back to home !</p>
                </div>
            </a>
        </div>
    </div>
@endsection
