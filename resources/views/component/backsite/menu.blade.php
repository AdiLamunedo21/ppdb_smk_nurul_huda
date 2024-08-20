<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background-color: white">
    <div class="app-brand demo mb-3 mt-3">
    <a href="index.html" class="app-brand-link">
        <img class="img" src="{{ asset('/assets/admin/img/backgrounds/smk-nurulhuda.png')}}" style="max-width: 100%;" height="50" width="50" alt="smk-nurulhuda">
        <div class="brand-identity" style="margin-left: 15px">
            <h6 class="" style="margin-bottom: 0px; font-weight: bolder;">PPDB | SMK Nurul Huda</h6>
        </div>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
    </div>

    <div class="menu-inner-shadow"></div>
    <!-- Menu Item -->
    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @if (auth()->user()->hasRole('superadmin') || auth()->user()->hasRole('admin'))
            <li class="menu-item {{ request()->segment(1) == 'peserta' ? 'active' : '' }}">
                <a href="/peserta" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-book-bookmark"></i>
                    <div data-i18n="Data Settings">Daftar Peserta</div>
                </a>
            </li>
            <li class="menu-item">
                <a class="menu-link menu-toggle" href="javascript:void(0)"><i class="menu-icon bx bx-dock-top"></i>
                    <div>
                        Status Berkas
                    </div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->segment(1) == 'status-ijazah' ? 'active' : '' }}">
                        <a href="/status-ijazah" class="menu-link">
                            <div data-i18n="Account Settings"> Ijazah </div>
                        </a>
                    </li>
                </ul>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->segment(1) == 'status-sk-lulus' ? 'active' : '' }}">
                        <a href="/status-sk-lulus" class="menu-link">
                            <div data-i18n="Account Settings"> SK Lulus </div>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item {{ request()->segment(1) == 'peserta-sudah-daftar-ulang' ? 'active' : '' }}">
                <a href="/peserta-sudah-daftar-ulang" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                <div data-i18n="Account Settings">Sudah Daftar Ulang</div>
            </a>
            </li>
            <li class="menu-item {{ request()->segment(1) == 'peserta-lulus' ? 'active' : '' }}">
                <a href="/peserta-lulus" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                <div data-i18n="Account Settings">Daftar Peserta Lulus</div>
            </a>
            </li>
            <li class="menu-item {{ request()->segment(1) == 'peserta-batal-sekolah' ? 'active' : '' }}">
                <a href="/peserta-batal-sekolah" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Account Settings">Peserta Batal Sekolah</div>
            </a>
            </li>
            <li class="menu-item {{ request()->segment(1) == 'siswa' ? 'active' : '' }}">
                    <a href="/siswa" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Account Settings">Data Resmi Siswa</div>
                </a>
            </li>
        @else
        <li class="menu-item {{ request()->segment(1) == 'biodata' ? 'active' : '' }}">
                <a href="/biodata" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-account"></i>
                <div data-i18n="Account Settings">Biodata</div>
            </a>
        </li>
        <li class="menu-item {{ request()->segment(1) == 'bukti-berkas' ? 'active' : '' }}">
                <a href="/bukti-berkas" class="menu-link">
                <i class="menu-icon tf-icons bx bx-upload"></i>
                <div data-i18n="Account Settings">Upload Berkas</div>
            </a>
        </li>
        <li class="menu-item {{ request()->segment(1) == 'daftar-ulang-peserta' ? 'active' : '' }}">
                        <a href="/daftar-ulang-peserta" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-reset"></i>
                        <div data-i18n="Account Settings">Daftar Ulang</div>
                    </a>
                </li>

                    @if (isset($peserta))
                        @if ($peserta->sudah_lulus == 'lulus' || $peserta->sudah_lulus == 'proses')
                            <li class="menu-item {{ request()->segment(1) == 'status' ? 'active' : '' }}">
                                <a href="/cetak-formulir-daftar" class="menu-link" target="blank">
                                    <i class="menu-icon tf-icons bx bx-download"></i>
                                    <div data-i18n="Account Settings">Unduh Formulir Daftar</div>
                                </a>
                            </li>
                        @endif
                    @endif
                <li class="menu-item {{ request()->segment(1) == 'kontak' ? 'active' : '' }}">
                    <a href="/kontak" class="menu-link">
                        <i class="menu-icon tf-icons bx bxs-phone-call"></i>
                        <div data-i18n="Account Settings">Kontak</div>
                    </a>
                </li>
    @endif
        <!-- Misc -->
    </ul>
</aside>
<!-- / Menu -->
