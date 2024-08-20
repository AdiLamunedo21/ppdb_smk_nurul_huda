@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<section class="bg-gray-50 dark:bg-gray-900 mt-10 md:mt-5">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Login PPDB
                </h1>
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="space-y-4 md:space-y-6" action="/auth" method="post">
                    @csrf
                    <div>
                        <label for="no_pendaftaran" class="block mb=2 text-sm font-medium text-gray-900 dark:text-white">Nomer Pendaftaran</label>
                        <input type="text" name="no_pendaftaran" id="no_pendaftaran" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukan Nomer Pendaftaran" value="{{ old('no_pendaftaran') }}" required oninvalid="this.setCustomValidity('Username Perlu Di Isi')">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required oninvalid="this.setCustomValidity('Password Perlu Di Isi')">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 focus:outline-none" onclick="togglePassword()">
                                <svg id="eye-open-icon" class="h-5 w-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">

                                    <path class=" hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle class=" hs-password-active:block" cx="12" cy="12" r="3"></circle>
                                    <path class=" hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle class=" hs-password-active:block" cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg id="eye-closed-icon" class="flex-shrink-0 size-3.5 text-gray-400 dark:text-neutral-600" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path class="hs-password-active:hidden" d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                                    <path class="hs-password-active:hidden" d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                                    <path class="hs-password-active:hidden" d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                                    <line class="hs-password-active:hidden" x1="2" x2="22" y1="2" y2="22"></line>
                                    <path class="hidden hs-password-active:block" d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                    <circle class="hidden hs-password-active:block" cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Lupa password?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        LOGIN
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Belum Punya akun? <a href="/" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Daftar</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    function togglePassword() {
        var passwordField = document.getElementById('password');
        var eyeOpenIcon = document.getElementById('eye-open-icon');
        var eyeClosedIcon = document.getElementById('eye-closed-icon');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            eyeOpenIcon.style.display = 'block';
            eyeClosedIcon.style.display = 'none';
        } else {
            passwordField.type = 'password';
            eyeOpenIcon.style.display = 'none';
            eyeClosedIcon.style.display = 'block';
        }
    }
</script>

@endsection
