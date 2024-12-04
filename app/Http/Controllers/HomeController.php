<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $loker = DB::table('loker')->Join('kategori', 'loker.idkategori', '=', 'kategori.idkategori')->orderBy('idloker', 'desc')->limit(6)->get();
        $data = [
            'loker' => $loker,
        ];

        return view('home/index', $data);
    }

    public function deletenotification($id)
    {
        DB::table('notifikasi')->where('idnotifikasi', $id)->delete();
        return back();
    }

    public function bersihkannotifikasi()
    {
        $iduser = session('pengguna')->id;
        DB::table('notifikasi')->where('id', $iduser)->delete();
        return back();
    }

    public function lokerdaftar()
    {
        $loker = DB::table('loker')->leftJoin('kategori', 'loker.idkategori', '=', 'kategori.idkategori')->inRandomOrder()->paginate(6);
        $data = [
            'loker' => $loker,
        ];
        return view('home/loker', $data);
    }


    public function lokerfilter(Request $request)
    {
        $query = DB::table('loker')
            ->leftJoin('kategori', 'loker.idkategori', '=', 'kategori.idkategori')
            ->select('loker.*', 'kategori.namakategori');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('loker.nama', 'like', '%' . $search . '%')
                ->orWhere('kategori.namakategori', 'like', '%' . $search . '%');
        }

        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
    
            if ($sortBy == 'name_asc') {
                $query->orderBy('loker.nama', 'asc');
            } elseif ($sortBy == 'name_desc') {
                $query->orderBy('loker.nama', 'desc');
            } else {
                $query->orderBy('loker.idloker', 'desc');
            }
        } else {
            $query->orderBy('loker.idloker', 'desc');
        }

        $loker = $query->paginate(6);

        $data = [
            'loker' => $loker,
        ];
        return view('home/loker', $data);
    }

    public function kategori()
    {
        $kategori = DB::table('kategori')->paginate(8);

        $data = [
            'kategori' => $kategori,
        ];

        return view('home.kategori', $data);
    }

    public function kategoriloker($id)
    {
        $data['loker'] = DB::table('loker')->leftJoin('kategori', 'loker.idkategori', '=', 'kategori.idkategori')->where('loker.idkategori', $id)->orderBy('idloker', 'desc')->paginate(6);

        return view('home.kategoriloker', $data);
    }

    public function kategorifilter(Request $request)
    {
        $query = DB::table('loker')
            ->leftJoin('kategori', 'loker.idkategori', '=', 'kategori.idkategori')
            ->select('loker.*', 'kategori.namakategori');


        // Category filtering
        if ($request->has('category_id') && $request->input('category_id') != '') {
            $categoryId = $request->input('category_id');
            $query->where('loker.idkategori', $categoryId);
        }

        // Sorting functionality
        if ($request->has('sort_by')) {
            $sortBy = $request->input('sort_by');
    
            if ($sortBy == 'name_asc') {
                $query->orderBy('loker.nama', 'asc');
            } elseif ($sortBy == 'name_desc') {
                $query->orderBy('loker.nama', 'desc');
            } else {
                $query->orderBy('loker.idloker', 'desc');
            }
        } else {
            $query->orderBy('loker.idloker', 'desc');
        }

        $loker = $query->paginate(6);
        $allCategories = DB::table('kategori')->get();

        $data = [
            'loker' => $loker,
            'allCategories' => $allCategories,
        ];

        return view('home.kategori', $data);
    }



    public function detail($id)
    {
        $loker = DB::table('loker')->leftJoin('kategori', 'loker.idkategori', '=', 'kategori.idkategori')->where('idloker', $id)->first();

        $lokerLainnya = DB::table('loker')
            ->where('idkategori', $loker->idkategori)
            ->where('idloker', '!=', $id)
            ->take(3)
            ->get();
        $data = [
            'loker' => $loker,
            'lokerLainnya' => $lokerLainnya,
        ];
        return view('home.detail', $data);
    }

    public function daftar()
    {
        return view('home.daftar');
    }

    public function dodaftar(Request $request)
    {
        $nama = $request->input('nama');
        $email = $request->input('email');
        $password = $request->input('password');
        $alamat = $request->input('alamat');
        $telepon = $request->input('telepon');
        $jekel = $request->input('jekel');
        $tgl_lahir = $request->input('tgl_lahir');
        $tempat_lahir = $request->input('tempat_lahir');
        $existingUser = DB::table('pengguna')->where('email', $email)->count();

        if ($existingUser == 1) {
            return redirect()->back()->with('error', 'Pendaftaran Gagal, email sudah ada');
        } else {
            DB::table('pengguna')->insert([
                'nama' => $nama,
                'email' => $email,
                'password' => $password,
                'alamat' => $alamat,
                'telepon' => $telepon,
                'jekel' => $jekel,
                'tgl_lahir' => $tgl_lahir,
                'tempat_lahir' => $tempat_lahir,
                'fotoprofil' => 'Untitled.png',
                'level' => 'Pelamar'
            ]);

            return redirect('home/login')->with('success', 'Pendaftaran Berhasil');
        }
    }

    public function daftaremployer()
    {
        return view('home.daftaremployer');
    }

    public function dodaftaremployer(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email,' . session('pengguna')->id . ',id',
            'password' => 'required|confirmed',
            'telepon' => 'required|numeric',
            'jekel' => 'required|in:Laki-laki,Perempuan',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        // Menyimpan data pengguna baru
        DB::table('pengguna')->where('id', session('pengguna')->id)->update([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'telepon' => $validatedData['telepon'],
            'jekel' => $validatedData['jekel'],
            'tgl_lahir' => $validatedData['tgl_lahir'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'alamat' => $validatedData['alamat'],
            'fotoprofil' => 'Untitled.png',
            'level' => 'Employer',
        ]);

        return redirect('home/login')->with('success', 'Pendaftaran Berhasil');
    }

    public function login()
    {
        return view('home.login');
    }

    public function dologin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $akun = DB::table('pengguna')
            ->where('email', $email)
            ->where('password', $password)
            ->first();

        if ($akun) {
            if ($akun->level == "Pelamar") {
                session(['pengguna' => $akun]);
                return redirect('home')->with('success', 'Anda sukses login');
            } elseif ($akun->level == "Admin") {
                session(['pengguna' => $akun]);
                return redirect('admin')->with('success', 'Anda sukses login');
            } elseif ($akun->level == "Employer") {
                session(['pengguna' => $akun]);
                return redirect('home')->with('success', 'Anda sukses login');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau Password anda salah');
        }
    }

    public function logout()
    {
        session()->flush();
        return redirect('home')->with('success', 'Anda Telah Logout');
    }

    public function akun()
    {
        if (!session('pengguna')) {

            session()->flash('error', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }

        $idpengguna = session('pengguna')->id;
        $pengguna = DB::table('pengguna')->where('id', $idpengguna)->first();

        $data = [
            'pengguna' => $pengguna,
        ];
        return view('home.akun', $data);
    }

    public function ubahakun(Request $request, $id)
    {
        $password = $request->input('password');
        if (empty($password)) {
            $password = $request->input('passwordlama');
        }
        DB::table('pengguna')
            ->where('id', $id)
            ->update([
                'password' => $password,
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'telepon' => $request->input('telepon'),
                'alamat' => $request->input('alamat'),
                'jekel' => $request->input('jekel'),
                'tgl_lahir' => $request->input('tgl_lahir'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'deskripsiketerampilan' => $request->input('deskripsiketerampilan'),
            ]);

        return redirect('home/akun')->with('success', 'Data Berhasil Diubah');
    }

    public function lamar(Request $request)
    {
        if (!session('pengguna')) {
            session()->flash('error', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }

        $idloker = $request->input('idloker');
        $file = '';

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file'), $fileName);
            $file = $fileName;
        } else {
            $file = '';
        }

        DB::table('pelamar')->insert([
            'idpengguna' => session('pengguna')->id,
            'idloker' => $idloker,
            'file' => $file,
            'namalengkap' => $request->input('namalengkap'),
            'email' => $request->input('email'),
            'keterangan' => $request->input('keterangan'),
            'nohp' => $request->input('nohp'),
            'status' => 'Diproses',
            'tanggal' => date('Y-m-d'),
        ]);

        session()->flash('success', 'Berhasil Apply Lamaran');
        return redirect('home/riwayat');
    }


    public function riwayat()
    {
        if (!session('pengguna')) {

            session()->flash('error', 'Anda belum login. Silakan login terlebih dahulu.');
            return redirect('home/login');
        }
        $data['idpengguna'] = session('pengguna')->id;
        $data['pelamar'] = DB::table('pelamar')
            ->join('pengguna', 'pelamar.idpengguna', '=', 'pengguna.id')
            ->join('loker', 'pelamar.idloker', '=', 'loker.idloker')
            ->where('idpengguna', $data['idpengguna'])
            ->paginate(6);

        return view('home.riwayat', $data);
    }
}
