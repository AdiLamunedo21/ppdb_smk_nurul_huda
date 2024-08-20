@extends('layouts.default')

@section('title', 'PPDB')

@section('content')

<section class="bg-black dark:bg-gray-900 bg-cover bg-center relative" style="background-image: linear-gradient(to left, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('assets/images/bg-nurul-huda.jpg'); position: relative; z-index: 0;">
    <div class="py-12 px-4 mx-auto max-w-screen-xl text-center lg:px-12 pb-28">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none relative text-white md:text-5xl lg:text-6xl dark:text-white">PPDB | SMK NURUL-HUDA</h1>
        <a href="#" class="inline-flex justify-between items-center py-1 px-1 pr-4 mb-4 text-sm text-gray-700 bg-gray-100 rounded-full dark:bg-gray-800 dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700" role="alert" style="z-index: 1;">
            <span class="text-xs bg-primary-600 rounded-full text-white px-4 py-1.5 mr-3">{{ $gelombang->nama}}</span>{{ $gelombang ? $gelombang->tanggal_pendaftaran : "" }} <span class="text-sm font-medium"></span>
            <svg class="ml-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        </a>
    </div>
</section>

<section class="bg-gray-100">
    <div class="-mt-20 w-full max-w-xl mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 top-0 left-0 right-0 relative" style="z-index: 2;">
        <form action="/daftar-sekarang" method="post">
            @csrf
            <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                <div class="relative w-full">
                    <select id="jurusan_id" name="jurusan_id" class="block p-3 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected >Pilih Kompetensi Keahlian</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->jurusan_id }}">{{ $jurusan->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" name="submit" class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Selanjutnya</button>
                </div>
            </div>
        </form>
    </div>
</section>

<div class="w-full mx-auto min-h-screen bg-gray-100 md:px-24">
    <div class="container mx-auto pb-20 pt-6">
        <div class="grid grid-flow-row grid-cols-1 gap-y-4 md:grid-cols-3 md:gap-x-5">
        <div class="col-span-2 row-span-2 h-min rounded-lg bg-white p-8 shadow-lg">
            <h3 class="mb-8 text-xl font-semibold">Informasi Jurusan</h3>
            <div class="flex-warp mb-6 flex rounded-lg border border-gray-200 bg-gray-100 px-6 py-4">
            <div class="flex-auto">
                <div class="mb-2 text-xl font-bold">Akutansi Keuangan Lembaga</div>
                <p class="text-base text-gray-700">Temukan Minatmu di sini</p>
            </div>
            <div class="mt-4">
                <a href="/info-jurusan-akutansi" class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"> Detail </a>
            </div>
            </div>
            <div class="flex-warp mb-6 flex rounded-lg border border-gray-200 bg-gray-100 px-6 py-4">
            <div class="flex-auto">
                <div class="mb-2 text-xl font-bold">Otomatisasi Tata Kelola Perkantoran</div>
                <p class="text-base text-gray-700">Temukan Minatmu di sini</p>
            </div>
            <div class="mt-4">
                <a href="/info-jurusan-perkantoran" class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"> Detail </a>
            </div>
            </div>
            <div class="flex-warp mb-6 flex rounded-lg border border-gray-200 bg-gray-100 px-6 py-4">
            <div class="flex-auto">
                <div class="mb-2 text-xl font-bold">Multimedia</div>
                <p class="text-base text-gray-700">Temukan Minatmu di sini</p>
            </div>
            <div class="mt-4">
                <a href="/info-jurusan-multimedia" class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"> Detail </a>
            </div>
            </div>
        </div>
        <div class="grid gap-y-4">
            <div class="rounded-lg bg-white p-8 shadow-lg">
            <h3 class="mb-2 text-xl font-semibold">Brosur Dan Informasi Lainnya</h3>
            <p class="two-lines mb-4 text-gray-700 dark:text-gray-300">Lihat Informasi sekolah di SMK Nurul Huda Sukaraja</p>
            <div class="mt-4">
                <a href="https://smknurulhudasukaraja.sch.id/download/download" class="rounded bg-blue-500 px-4 py-2 font-bold text-white hover:bg-blue-700"> Lihat Detail</a>
            </div>
            </div>
            <div class="rounded-lg bg-white p-8 shadow-lg">
            <h3 class="mb-2 text-xl font-semibold">Persyaratan Pendaftaran</h3>
            <ol>
                <li>1. Bersedia bertempat tinggal di asrama</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
</div>




@endsection
