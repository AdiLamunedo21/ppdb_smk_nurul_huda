@extends('layouts.default')

@section('title', 'Konfirmasi Pendaftaran')

@section('content')
<section id="banner-section" class="py-8 bg-gray-100">
    <section class="w-full max-w-xl mx-auto p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 lg:max-w-screen-md">
        <div class="px-4 mx-auto max-w-2xl">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Konfirmasi Data Pendaftaran</h2>
            <form action="/daftar" method="POST" id="finalSubmitForm">
                @csrf
                <!-- Mulai dari sini elemen disembunyikan -->
                <div style="display: none;">
                    @foreach($data as $key => $value)
                        @if(is_array($value))  {{-- Pastikan $value adalah array --}}
                            @foreach($value as $field => $fieldValue)
                                <div class="mb-4">
                                    <label for="{{ $field }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', $field)) }}</label>
                                    <input type="text" id="{{ $field }}" name="{{ $field }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $fieldValue }}" readonly>
                                </div>
                            @endforeach
                        @else
                            <div class="mb-4">
                                <label for="{{ $key }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                                <input type="text" id="{{ $key }}" name="{{ $key }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ $value }}" readonly>
                            </div>
                        @endif
                    @endforeach

                    <input type="hidden" name="jurusan_id" id="jurusan_id" value="{{ old('jurusan_id', Session::get('selected_jurusan')) }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    <input type="hidden" name="jenis_pendaftaran" id="jenis_pendaftaran" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('jenis_pendaftaran', 'tes') }}" required>
                    <input type="hidden" name="progres" id="progres" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="{{ old('progres', 'sudah_buat_akun') }}" required>
                </div>
                <!-- Selesai elemen disembunyikan -->
                <div id="informasiPribadi">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 sm:gap-6 mt-4">
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</p>
                            </div>
                            <div>
                                <p id="namaLengkapInfo" class="text-sm text-gray-700 dark:text-gray-300">{{ $data['nama_lengkap'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">NISN</p>
                            </div>
                            <div>
                                <p id="nisnInfo" class="text-sm text-gray-700 dark:text-gray-300">{{ $data['nisn'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">NIS</p>
                            </div>
                            <div>
                                <p id="nisInfo" class="text-sm text-gray-700 dark:text-gray-300">{{ $data['nis'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Asal Sekolah</p>
                            </div>
                            <div>
                                <p id="sekolahInfo" class="text-sm text-gray-700 dark:text-gray-300">{{ $data['asal_sekolah'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Agama</p>
                            </div>
                            <div>
                                <p id="agamaInfo" class="text-sm text-gray-700 dark:text-gray-300">{{ $data['agama'] }}</p>
                            </div>
                        </div>
                        <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 sm:gap-6 mt-4">
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</p>
                            </div>
                            <div>
                                <p id="tanggalLahirInfo" class="text-sm text-gray-700 dark:text-gray-300">{{ $data['tanggal_lahir'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">No Handphone</p>
                            </div>
                            <div>
                                <p id="handphoneInfo" class="text-sm text-gray-700 dark:text-gray-300">{{ $data['no_hp'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Email</p>
                            </div>
                            <div>
                                <p id="emailInfo" class="text-sm text-gray-700 dark:text-gray-300">{{ $data['email'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</p>
                            </div>
                            <div>
                                <p id="jenisKelaminInfo" class="text-sm text-gray-700 dark:text-gray-300">{{ $data['jenis_kelamin'] }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Alamat Lengkap</p>
                            </div>
                            <div>
                                <p id="alamatInfo" class="text-sm text-gray-700 dark:text-gray-300">{{ $data['alamat_lengkap'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="konfirmasi" class=" mt-10">
                    <div class="grid grid-flow-row grid-cols-1 gap-y-4 md:grid-cols-3 md:gap-x-5 mt-10">
                        <div class="col-span-2 row-span-2">
                            <div class="flex items-center">
                                <input id="agree" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" required>
                                <label for="agree" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Saya menyetujui bahwa data yang telah dimasukkan adalah benar dan dapat dipertanggungjawabkan.</label>
                            </div>
                        </div>
                        <div class="grid gap-y-4">
                            <div class="flex justify-end space-x-4">
                                <button type="button" id="ubahButton" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-600 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-700">
                                    Ubah
                                </button>
                                <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-green-600 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-700">
                                    SUBMIT
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</section>
<script>
    document.getElementById('ubahButton').addEventListener('click', function() {
        const data = @json($data);
        const queryParams = new URLSearchParams(data).toString();
        window.location.href = `/isi-formulir?${queryParams}`;
    });
</script>
@endsection
