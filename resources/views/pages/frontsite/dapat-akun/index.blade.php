@extends('layouts.default')

@section('title', 'Dapat Akun')

@section('content')

<section id="banner-section" class="py-8 bg-gray-100">
    <section class="w-full max-w-xl mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 lg:max-w-screen-md">
        <div class="bg-white shadow-md rounded-md mb-4">
            <div class="px-4 py-2">
                <h2 class="text-xl font-bold">Informasi Pendaftaran</h2>
                <div class="grid grid-cols-2 gap-4">
                <div class="text-gray-700">ID Pendaftar:</div>
                <div class="font-bold">{{$iddaftar}}</div>
                <div class="text-gray-700">Password:</div>
                <div class="font-bold">{{$password}}</div>
                </div>
            </div>
        </div>
        @unless(request()->is('login'))
            <a href="/login" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">LOGIN</a>
        @endunless
    </section>
</section>

@endsection
