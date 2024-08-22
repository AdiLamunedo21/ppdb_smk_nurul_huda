<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Pendamping;

use App\Notifications\LupaPasswordVerifikasi;


class LoginController extends Controller
{
        public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'no_pendaftaran' => 'required',
            'password' => 'required'
        ]);

        $user = User::with('roles')->where('no_pendaftaran', $request->no_pendaftaran)->orWhere('email', $request->no_pendaftaran)->first();

        if ( empty($user->peserta_id) )
        {

            // Login Admin dan keuangan
            if (Auth::attempt([
                'email' => $request->no_pendaftaran,
                'password' => $request->password]))
            {
                $request->session()->regenerate();

                return redirect()->intended('dashboard');
            }
        }
        else
        {
            if (Auth::attempt($credentials)) {

                $request->session()->regenerate();

                return redirect()->intended('dashboard');
            }
        }

        return redirect()->back()->withErrors([
        'no_pendaftaran' => 'NO Pendaftaran atau password salah.',
        ])->withInput($request->only('no_pendaftaran'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function lupaPassword()
    {
        return view('lupa_password');
    }

    public function kirimEmailLupaPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (! $user) return back()->with([
            'error' => 'Akun tidak ditemukan',
        ]);

        $kode_verifikasi = Str::random(16);
        $user->lupa_password = $kode_verifikasi;
        $user->lupa_password_expired = Carbon::now()->addHour(3);

        if ($user->save()) {
            $user->notify(new LupaPasswordVerifikasi($user));

            return redirect()->route('lupa-password-terkirim');
        } else {
            return back()->with([
                'error' => 'Gagal mengirimkan Link ke Email',
            ]);
        }
    }

    public function kirimEmailLupaPasswordTerkirim()
    {
        return view('lupa_password_terkirim');
    }

    public function buatPassword()
    {
        $uid = request()->get('uid');
        if (! $uid) redirect()->route('login');

        $user = User::where('lupa_password', $uid)->first();
        if (! $user) {
            return redirect()->route('lupa-password')->with(['error' => 'Link tidak berlaku']);
        }

        $sekarang = Carbon::now();
        if ($sekarang->gt($user->lupa_password_expired)) {
            $user->lupa_password = null;
            $user->lupa_password_expired = null;
            $user->save();
            return redirect()->route('lupa-password')->with(['error' => 'Link sudah expired']);
        }

        return view('buat_password', ['kode_verifikasi' => $user->lupa_password]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'password_konfirmasi' => 'required|same:password',
            'kode_verifikasi' => 'required'
        ], [
            'password_konfirmasi.same' => "Konfirmasi Password harus sama"
        ]);

        $kode_verifikasi = $request->kode_verifikasi;
        $user = User::where('lupa_password', $kode_verifikasi)->first();
        if (!$user) {
            return back()->with([
                'error' => 'User tidak ditemukan',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->lupa_password = null;
        $user->lupa_password_expired = null;
        $simpan = $user->save();

        if ($simpan) {
            return redirect()->route('login')->with(['success' => 'Password Baru berhasil dibuat. Silahkan login menggunakan password baru']);
        } else {
            return back()->with([
                'error' => 'gagal Ubah Password',
            ]);
        }
    }


}
