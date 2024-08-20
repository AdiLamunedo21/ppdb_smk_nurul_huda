@extends('layouts.default')

@section('title', 'Formulir-Pendaftaran')

@section('content')

<section id="banner-section" class="py-8 bg-gray-100">
    <section class="w-full max-w-xl mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 lg:max-w-screen-md">
    <div class="px-4 mx-auto max-w-2xl">
    {{---Card---}}
        <div class="flex items-center p-4 mb-4 text-sm text-blue-700 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M8 7V2.221a2 2 0 0 0-.5.365L3.586 6.5a2 2 0 0 0-.365.5H8Zm2 0V2h7a2 2 0 0 1 2 2v.126a5.087 5.087 0 0 0-4.74 1.368v.001l-6.642 6.642a3 3 0 0 0-.82 1.532l-.74 3.692a3 3 0 0 0 3.53 3.53l3.694-.738a3 3 0 0 0 1.532-.82L19 15.149V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M17.447 8.08a1.087 1.087 0 0 1 1.187.238l.002.001a1.088 1.088 0 0 1 0 1.539l-.377.377-1.54-1.542.373-.374.002-.001c.1-.102.22-.182.353-.237Zm-2.143 2.027-4.644 4.644-.385 1.924 1.925-.385 4.644-4.642-1.54-1.54Zm2.56-4.11a3.087 3.087 0 0 0-2.187.909l-6.645 6.645a1 1 0 0 0-.274.51l-.739 3.693a1 1 0 0 0 1.177 1.176l3.693-.738a1 1 0 0 0 .51-.274l6.65-6.646a3.088 3.088 0 0 0-2.185-5.275Z" clip-rule="evenodd"/>
            </svg>
            <div class="flex-1 min-w-0 ms-4">
                <p class="font-medium">
                    Kamu Memilih Kompetensi keahlian
                </p>
                @if(session()->has('selected_jurusan'))
                <p class="font-bold">
                {{ App\Models\Jurusan::find(session('selected_jurusan'))->nama }}
                </p>
                @endif
            </div>
            <a href="#" class="text-sm font-medium text-blue-800 dark:text-blue-500 ">
                Ubah
            </a>
        </div>
        {{---Form---}}
        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Silahkan Lengkapi Datamu</h2>
        <form action="{{ route('konfirmasi') }}" method="POST" id="daftarForm">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <input type="hidden" name="jurusan_id" id="jurusan_id" value="{{ old('jurusan_id', Session::get('selected_jurusan')) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"/>
                <input type="hidden" name="jenis_pendaftaran" id="jenis_pendaftaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ old('jenis_pendaftaran', 'tes') }}" required="">

                <div class="sm:col-span-2">
                    <label for="nama_lengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Ketik Nama Lengkapmu" required="" oninvalid="this.setCustomValidity('Nama Lengkap Perlu Di Isi')" value="{{ old('nama_lengkap', request()->query('nama_lengkap', '')) }}">
                    @error('nama_lengkap')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh !</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full sm:col-span-1">
                    <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NISN</label>
                    <input type="text" name="nisn" id="nisn" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Isi NISN" required="" oninvalid="this.setCustomValidity('NISN Perlu Di Isi')" value="{{ old('nisn', request()->query('nisn', '')) }}">
                    @error('nisn')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh !</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full sm:col-span-1">
                    <label for="nis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIS</label>
                    <input type="number" name="nis" id="nis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Isi Nis" required="" oninvalid="this.setCustomValidity('NIS Perlu Di Isi')" value="{{ old('nis', request()->query('nis', '')) }}">
                    @error('nis')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh !</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full sm:col-span-1">
                    <label for="asal_sekolah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asal Sekolah</label>
                    <input type="text" name="asal_sekolah" id="asal-sekolah" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Isi Asal Sekolah" required oninvalid="this.setCustomValidity('Asal Sekolah Perlu Di Isi')" value="{{ old('asal_sekolah', request()->query('asal_sekolah', '')) }}">
                    @error('asal_sekolah')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh !</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full sm:col-span-1">
                    <label for="agama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agama</label>
                    <select id="agama" name="agama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required oninvalid="this.setCustomValidity('AGAMA Perlu Di Isi')">
                        <option selected disabled hidden>Pilih Agama</option>
                        <option value="islam" {{ old('agama', request()->query('agama', '')) == 'islam' ? 'selected' : '' }}>Islam</option>
                    </select>
                    @error('agama')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh !</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full sm:col-span-1">
                    <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required oninvalid="this.setCustomValidity('Tanggal Lahir Perlu Di Isi')" value="{{ old('tanggal_lahir', request()->query('tanggal_lahir', '')) }}">
                    @error('tanggal_lahir')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh !</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full sm:col-span-1">
                    <label for="no_hp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No HP</label>
                    <input type="text" name="no_hp" id="no_hp" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Isi No HP Anda" required oninvalid="this.setCustomValidity('NO HP Perlu Di Isi')" value="{{ old('no_hp', request()->query('no_hp', '')) }}">
                    @error('no_hp')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh !</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full sm:col-span-1">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="nama@gmail.com" required oninvalid="this.setCustomValidity('Email Perlu Di Isi')" value="{{ old('email', request()->query('email', '')) }}">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh !</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full sm:col-span-1">
                    <label for="jenis_kelamin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required oninvalid="this.setCustomValidity('Jenis Kelamin Perlu Di Isi')">
                        <option selected disabled hidden>Pilih Jenis Kelamin</option>
                        <option value="laki-laki" {{ old('jenis_kelamin', request()->query('jenis_kelamin', '')) == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('jenis_kelamin', request()->query('jenis_kelamin', '')) == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh !</span> {{ $message }}</p>
                    @enderror
                </div>

                <div class="w-full sm:col-span-2">
                    <label for="alamat_lengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" id="alamat_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Isi Alamat Lengkap Anda" required oninvalid="this.setCustomValidity('Alamat Lengkap Perlu Di Isi')">{{ old('alamat_lengkap', request()->query('alamat_lengkap', '')) }}</textarea>
                    @error('alamat_lengkap')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh !</span> {{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" id="daftarButton" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                Daftar
            </button>
        </form>
</section>


@endsection
