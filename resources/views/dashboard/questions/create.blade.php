@extends('layouts.app')

@section('content')
    <x-toast/>
    <div class="flex justify-center">
        <div
            class="flex flex-col justify-center items-center w-4/5 p-4 min-h-96 bg-white border border-gray-200 rounded-lg shadow-2xl sm:p-6 md:p-8 dark:bg-gray-800/70 dark:border-gray-700">
            <h5 class="text-xl mb-3 font-medium text-gray-900 dark:text-white">Create question</h5>

            <form method="POST" action="{{ route('questions.store') }}" class="w-full"
                  autocomplete="off">
                @csrf
                <input type="number" name="exam_id" hidden value="{{ session()->get('exam_id') }}"/>
                <div class="relative z-0 w-full group">
                        <textarea name="question" id="question"
                                  class="block px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                  placeholder=" " style="padding-top: 2rem; margin-bottom: 3rem;"
                                  required>{{ old('question') }}</textarea>
                    <label for="question"
                           class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-full scale-75 top-8 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-10">Question</label>
                    @error('question')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                            class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid md:grid-cols-2 md:gap-6 mb-3">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="o1" id="option1"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " value="{{ old('option1') }}" required/>
                        <label for="option1"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Option
                            1</label>
                        @error('option1')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="o2" id="option2"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " value="{{ old('option2') }}" required/>
                        <label for="option2"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Option
                            2</label>
                        @error('option2')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid md:grid-cols-2 md:gap-6 mb-3">
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="o3" id="option3"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " value="{{ old('option3') }}" required/>
                        <label for="option3"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Option
                            3</label>
                        @error('option3')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="relative z-0 w-full mb-6 group">
                        <input type="text" name="o4" id="option4"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " value="{{ old('option4') }}" required/>
                        <label for="option4"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Option
                            4</label>
                        @error('option4')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span
                                class="font-medium">Oops!&nbsp;</span>{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <label for="superuser"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer?</label>
                    <select id="superuser"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            name="answer">
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                    </select>
                </div>

                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Create
                </button>
            </form>
        </div>
    </div>
@endsection
