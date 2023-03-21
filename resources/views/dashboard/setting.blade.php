@extends('layouts.app')

@section('content')
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <x-toast/>
        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="mr-2">
                    <a href="{{ route('profile') }}"
                       class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                        <svg aria-hidden="true"
                             class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
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
                                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Exams
                    </a>
                </li>
                <li class="mr-2">
                    <a href="{{ route('setting') }}"
                       class="inline-flex p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group"
                       aria-current="page">
                        <svg aria-hidden="true"
                             class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-500"
                             fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path>
                        </svg>
                        Settings
                    </a>
                </li>
            </ul>
        </div>
        <div class="m-7">
            <div class="flex justify-center z-0">
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

            <h5 class="text-xl mb-3 font-medium text-gray-900 dark:text-white text-center">Two factor
                authentication</h5>
            <form method="POST" action="{{ route('profile.2fa') }}" class="pt-4" id="two-factor-auth">
                @csrf
                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-6 group flex items-center justify-center">
                        <label class="relative inline-flex items-center mb-4 cursor-pointer">
                            <input type="checkbox" value="1" class="sr-only peer"
                                   name="two_fa" {{ $user->two_fa ? 'checked' : '' }}>
                            <div
                                class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Two factor</span>
                        </label>
                    </div>
                    <input type="hidden" id="country" name="country">
                    <input type="hidden" id="country_code" name="country_code">
                    <input type="hidden" id="hidden-code" name="code">
                    <div class="relative z-0 w-full mb-6 group flex items-center justify-center">
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " required/>
                        <label for="phone"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-8 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-7">Phone
                            number</label>
                    </div>
                </div>

                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Send SMS
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
    </div>
    <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
            class="hidden block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button" id="code-modal">
        Toggle modal
    </button>
    <div id="authentication-modal" tabindex="-1" aria-hidden="true"
         class="fixed hidden top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="authentication-modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="flex justify-center">
                    <div id="toast-simple"
                         class="flex items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800 mt-5"
                         role="alert">
                        <svg aria-hidden="true" class="w-5 h-5 text-blue-600 dark:text-blue-500" focusable="false"
                             data-prefix="fas" data-icon="paper-plane" role="img" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 512 512">
                            <path fill="currentColor"
                                  d="M511.6 36.86l-64 415.1c-1.5 9.734-7.375 18.22-15.97 23.05c-4.844 2.719-10.27 4.097-15.68 4.097c-4.188 0-8.319-.8154-12.29-2.472l-122.6-51.1l-50.86 76.29C226.3 508.5 219.8 512 212.8 512C201.3 512 192 502.7 192 491.2v-96.18c0-7.115 2.372-14.03 6.742-19.64L416 96l-293.7 264.3L19.69 317.5C8.438 312.8 .8125 302.2 .0625 289.1s5.469-23.72 16.06-29.77l448-255.1c10.69-6.109 23.88-5.547 34 1.406S513.5 24.72 511.6 36.86z"></path>
                        </svg>
                        <div class="flex flex-col">
                            <div class="pl-4 text-sm font-normal">SMS sent successfully.</div>
                            <div class="pl-4 text-sm font-bold text-yellow-300 flex">Expired:&nbsp; <p id="sms-timer">
                                    10:00</p></div>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Enter one-time code send to your
                        phone</h3>
                    <form class="space-y-6" action="#" id="enter-code">
                        <div class="relative z-0 w-full mb-6 group flex" style="align-items: center">
                            <input type="text" name="code" id="code"
                                   class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                   placeholder=" " required/>
                            <label for="code"
                                   class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-5 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Your
                                code</label>
                        </div>
                        <button type="submit"
                                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Submit
                        </button>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-300 flex justify-center">
                            <a id="resend-sms" class="text-blue-700 hover:underline dark:text-blue-500 cursor-pointer">Resend
                                code</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <style>
        .intl-tel-input {
            background-color: #333;
        }

        .iti__selected-flag {
            border-color: #ddd;
        }

        .iti__country-list {
            background: #1F2937;
            border-color: #2d3748;
        }

        .iti__country:hover {
            background: #1a202c;
        }

        .iti__country-name {
            color: #fff;
        }

        .iti__selected-dial-code {
            color: #fff;
        }

        .iti__input {
            color: #fff;
        }
    </style>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            preferredCountries: ["{{ $user->country ? : 'ir' }}"],
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        var twoFactorAuthForm = document.querySelector("#two-factor-auth")
        var enterCodeForm = document.querySelector("#enter-code")

        twoFactorAuthForm.addEventListener("submit", function (event) {
            event.preventDefault();
            document.querySelector("#country_code").value = iti.getSelectedCountryData().dialCode;
            document.querySelector("#country").value = iti.getSelectedCountryData().iso2;
            var phoneNumber = "+" + iti.getSelectedCountryData().dialCode + document.querySelector("#phone").value;

            sendSms(phoneNumber, true);
        });

        enterCodeForm.addEventListener("submit", function (event) {
            event.preventDefault();
            document.querySelector("#hidden-code").value = document.querySelector("#code").value;
            twoFactorAuthForm.submit();
        })

        function sendSms(phoneNumber, showModal) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/send-sms');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-CSRF-Token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhr.onload = function () {
                if (xhr.status === 200) {
                    // SMS sent successfully
                    if (showModal) {
                        document.querySelector("#code-modal").click();
                        timer();
                        resendTimer();
                    }
                    document.querySelector("#resend-sms").removeEventListener("click", handleResendClick)
                } else {
                    // Error sending SMS
                    console.log('Error sending SMS.');
                }
            };
            xhr.send('phone=' + encodeURIComponent(phoneNumber));
        }

        var smsSent = false;

        function handleResendClick() {
            var phoneNumber = "+" + document.querySelector("#country_code").value + document.querySelector("#phone").value;
            smsSent = true;
            sendSms(phoneNumber, false);
            document.querySelector("#resend-sms").innerHTML = "Send successfully";
        }

        function resendTimer() {
            var expiredTime = new Date();
            expiredTime.setMinutes(expiredTime.getMinutes() + 2);


            var intervalId = setInterval(function () {
                let now = new Date().getTime();
                let t = expiredTime - now;
                let resendEl = document.querySelector("#resend-sms");

                if (t >= 0) {
                    let minute = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                    let sec = Math.floor((t % (1000 * 60)) / 1000);

                    resendEl.innerHTML = "Resend in: " + minute + ":" + sec;
                    if (minute < 10) {
                        resendEl.innerHTML = "Resend in: " + "0" + minute + ":" + sec;
                    }
                    if (sec < 10) {
                        resendEl.innerHTML = "Resend in: " + "0" + minute + ":" + "0" + sec;
                    }
                } else {
                    clearInterval(intervalId);
                    resendEl.innerHTML = "Resend code";
                    if (!smsSent) {
                        resendEl.addEventListener("click", handleResendClick);
                    }
                }
            }, 500);
        }

        function timer() {
            var expiredTime = new Date();
            expiredTime.setMinutes(expiredTime.getMinutes() + 10);

            setInterval(function () {
                let now = new Date().getTime();
                let t = expiredTime - now;
                expiredTimerEl = document.querySelector("#sms-timer");

                if (t >= 0) {
                    let minute = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                    let sec = Math.floor((t % (1000 * 60)) / 1000);

                    expiredTimerEl.innerHTML = minute + ":" + sec;
                    if (minute < 10) {
                        expiredTimerEl.innerHTML = "0" + minute + ":" + sec;
                    }
                    if (sec < 10) {
                        expiredTimerEl.innerHTML = "0" + minute + ":" + "0" + sec;
                    }
                } else {
                    expiredTimerEl.innerHTML = "The countdown is over!";
                }
            }, 500);
        }
    </script>
@endsection
