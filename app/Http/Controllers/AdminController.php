<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Jumlah user
        $jumlahUser = DB::table('pengguna')->count();


        if (session('pengguna')->level == 'Employer') {

            // Jumlah loker
            $jumlahLoker = DB::table('loker')
                ->where('idemployer', session('pengguna')->id)
                ->count();

            // Jumlah pelamar
            $jumlahPelamar = DB::table('pelamar')
                ->join('loker', 'pelamar.idloker', '=', 'loker.idloker')
                ->where('loker.idemployer', session('pengguna')->id)
                ->count();

            // Jumlah pelamar
            $jumlahPelamarDiproses = DB::table('pelamar')
                ->join('loker', 'pelamar.idloker', '=', 'loker.idloker')
                ->where('loker.idemployer', session('pengguna')->id)
                ->where('pelamar.status', 'Diproses')
                ->count();
        } else {
            // Jumlah loker
            $jumlahLoker = DB::table('loker')
                ->count();

            // Jumlah pelamar
            $jumlahPelamar = DB::table('pelamar')
                ->join('loker', 'pelamar.idloker', '=', 'loker.idloker')
                ->count();

            // Jumlah pelamar
            $jumlahPelamarDiproses = DB::table('pelamar')
                ->join('loker', 'pelamar.idloker', '=', 'loker.idloker')
                ->where('pelamar.status', 'Diproses')
                ->count();
        }

        return view('admin.dashboard', [
            'jumlahUser' => $jumlahUser,
            'jumlahLoker' => $jumlahLoker,
            'jumlahPelamar' => $jumlahPelamar,
            'jumlahPelamarDiproses' => $jumlahPelamarDiproses,
        ]);
    }

    public function profile()
    {
        $data['profile'] = DB::table('pengguna')->where('id', session('pengguna')->id)->first();
        return view('admin.profile', $data);
    }

    public function updateprofile(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pengguna,email,' . $id . ',id',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required|string',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'jekel' => 'required|string',
            'deskripsiketerampilan' => 'nullable|string',
            'alamat' => 'required|string',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'tgl_lahir' => $request->tgl_lahir,
            'tempat_lahir' => $request->tempat_lahir,
            'jekel' => $request->jekel,
            'deskripsiketerampilan' => $request->deskripsiketerampilan,
            'alamat' => $request->alamat,
        ];
        if (!empty($request->password)) {
            $data['password'] = $request->password;
        }

        DB::table('pengguna')->where('id', $id)->update($data);

        return back()->with('success', 'Berhasil mengubah data!');
    }

    public function kategori()
    {
        $data['kategori'] = DB::table('kategori')->get();
        return view('admin.kategori', $data);
    }

    public function tambahkategori()
    {

        return view('admin.tambahkategori');
    }

    public function simpankategori(Request $request)
    {
        $request->validate([
            'kategori' => 'required|unique:kategori,namakategori',
        ]);

        $data = [
            'namakategori' => $request->kategori,
        ];

        KategoriModel::create($data);
        session()->flash('success', 'Berhasil menambahkan data!');
        return redirect('admin/kategori');
    }

    public function ubahkategori($id)
    {
        $data['kategori'] = KategoriModel::where('idkategori', $id)->first();
        return view('admin.ubahkategori', $data);
    }

    public function updatekategori(Request $request, $id)
    {
        $data = [
            'namakategori' => $request->kategori
        ];
        KategoriModel::where('idkategori', $id)->update($data);
        session()->flash('success', 'Berhasil mengubah data!');
        return redirect('admin/kategori');
    }

    public function hapuskategori($id)
    {
        KategoriModel::where('idkategori', $id)->delete();
        session()->flash('success', 'Berhasil menghapus data!');
        return redirect('admin/kategori');
    }

    public function loker()
    {
        if (session('pengguna')->level == 'Admin') {
            $loker = DB::table('loker')
                ->leftJoin('kategori', 'loker.idkategori', '=', 'kategori.idkategori')
                ->leftJoin('pengguna', 'loker.idemployer', '=', 'pengguna.id')
                ->orderBy('idloker', 'DESC')
                ->get();
        } else {
            $loker = DB::table('loker')
                ->leftJoin('kategori', 'loker.idkategori', '=', 'kategori.idkategori')
                ->leftJoin('pengguna', 'loker.idemployer', '=', 'pengguna.id')
                ->where('idemployer', session('pengguna')->id)
                ->orderBy('idloker', 'DESC')
                ->get();
        }
        $data['loker'] = $loker;
        return view('admin.loker', $data);
    }

    public function tambahloker()
    {
        $data['kategori'] = DB::table('kategori')->get();
        $data['employer'] = DB::table('pengguna')->where('level', 'Employer')->get();

        return view('admin.tambahloker', $data);
    }

    public function simpanloker(Request $request)
    {
        $namafoto = $request->file('foto')->getClientOriginalName();
        $request->file('foto')->move(public_path('foto'), $namafoto);

        if (session('pengguna')->level == 'Employer') {
            DB::table('loker')->insert([
                'namapekerjaan' => $request->input('namapekerjaan'),
                'idkategori' => $request->input('idkategori'),
                'lokasi' => $request->input('lokasi'),
                'tipe' => $request->input('tipe'),
                'foto' => $namafoto,
                'deskripsi' => $request->input('deskripsi'),
                'kontak' => $request->input('kontak'),
                'rentanggajiawal' => $request->input('rentanggajiawal'),
                'rentanggajiakhir' => $request->input('rentanggajiakhir'),
                'tanggal' => date('Y-m-d'),
                'idemployer' => session('pengguna')->id
            ]);
        } else {
            DB::table('loker')->insert([
                'namapekerjaan' => $request->input('namapekerjaan'),
                'idkategori' => $request->input('idkategori'),
                'lokasi' => $request->input('lokasi'),
                'tipe' => $request->input('tipe'),
                'foto' => $namafoto,
                'deskripsi' => $request->input('deskripsi'),
                'kontak' => $request->input('kontak'),
                'rentanggajiawal' => $request->input('rentanggajiawal'),
                'rentanggajiakhir' => $request->input('rentanggajiakhir'),
                'tanggal' => date('Y-m-d'),
                'idemployer' => $request->input('idemployer'),
            ]);
        }
        session()->flash('success', 'Berhasil menambah data!');

        return redirect('admin/loker');
    }

    public function ubahloker($id)
    {
        $data['loker'] = DB::table('loker')->where('idloker', $id)->first();
        $data['kategori'] = DB::table('kategori')->get();
        return view('admin.ubahloker', $data);
    }

    public function updateloker(Request $request, $id)
    {
        $data = [
            'namapekerjaan' => $request->input('namapekerjaan'),
            'idkategori' => $request->input('idkategori'),
            'lokasi' => $request->input('lokasi'),
            'tipe' => $request->input('tipe'),
            'deskripsi' => $request->input('deskripsi'),
            'kontak' => $request->input('kontak'),
            'rentanggajiawal' => $request->input('rentanggajiawal'),
            'rentanggajiakhir' => $request->input('rentanggajiakhir'),
            'tanggal' => date('Y-m-d'),
        ];
        $loker = DB::table('loker')->where('idloker', $id)->first();
        $fotoPath = public_path('foto/' . $loker->foto);
        if ($request->hasFile('foto')) {
            $namafoto = $request->file('foto')->getClientOriginalName();
            $request->file('foto')->move(public_path('foto'), $namafoto);
            $data['foto'] = $namafoto;
        }
        DB::table('loker')->where('idloker', $id)->update($data);
        session()->flash('success', 'Berhasil mengubah data!');
        return redirect('admin/loker');
    }

    public function hapusloker($id)
    {
        DB::table('loker')->where('idloker', $id)->delete();
        session()->flash('success', 'Berhasil menghapus data!');
        return redirect('admin/loker');
    }

    public function pengguna()
    {
        $pengguna = DB::table('pengguna')->where('level', 'Pelamar')->get();

        $data = [
            'pengguna' => $pengguna,
        ];

        return view('admin.pengguna', $data);
    }

    public function employer()
    {
        $employer = DB::table('pengguna')->where('level', 'Employer')->get();

        $data = [
            'employer' => $employer,
        ];

        return view('admin.employer', $data);
    }

    public function tambahemployer()
    {
        return view('admin.tambahemployer');
    }

    public function simpanemployer(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:3',
            'telepon' => 'required|numeric',
            'alamat' => 'required|string',
            'fotoprofil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tgl_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'jekel' => 'required|string|in:Laki-laki,Perempuan',
        ]);

        // Upload file foto jika ada
        if ($request->hasFile('fotoprofil')) {
            $file = $request->file('fotoprofil');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto'), $filename);
        } else {
            $filename = null; // Jika tidak ada foto yang diupload
        }

        // Simpan data ke tabel pengguna dengan level Employer
        DB::table('pengguna')->insert([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'telepon' => $request->input('telepon'),
            'alamat' => $request->input('alamat'),
            'fotoprofil' => $filename,
            'tgl_lahir' => $request->input('tgl_lahir'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'jekel' => $request->input('jekel'),
            'level' => 'Employer',
        ]);

        // berikan response sukses 
        return redirect('admin/employer')->with('success', 'Employer berhasil ditambahkan');
    }

    public function hapusemployer($id)
    {
        DB::table('pengguna')->where('id', $id)->delete();

        return redirect('admin/employer')->with('success', 'Employer berhasil dihapus');
    }

    public function logout()
    {
        session()->flush();
        return redirect('home')->with('success', 'Anda Telah Logout');
    }

    public function pelamar()
    {
        if (session('pengguna')->level == 'Employer') {
            $pelamar = DB::table('pelamar')
                ->join('pengguna as yanglamar', 'yanglamar.id', '=', 'pelamar.idpengguna')
                ->join('loker', 'pelamar.idloker', '=', 'loker.idloker')  // Memperbaiki join untuk loker
                ->join('pengguna as employer', 'employer.id', '=', 'loker.idemployer')  // Menghubungkan employer dengan pengguna
                ->where('loker.idemployer', session('pengguna')->id)  // Memastikan employer sesuai dengan pengguna yang login
                ->orderBy('pelamar.idpelamar', 'desc')
                ->get();
        } elseif (session('pengguna')->level == 'Admin') {
            $pelamar = DB::table('pelamar')
                ->select('*', 'employer.nama as namaemployer')
                ->join('pengguna as yanglamar', 'yanglamar.id', '=', 'pelamar.idpengguna')
                ->join('loker', 'pelamar.idloker', '=', 'loker.idloker')  // Memperbaiki join untuk loker
                ->join('pengguna as employer', 'employer.id', '=', 'loker.idemployer')  // Menghubungkan employer dengan pengguna
                ->orderBy('pelamar.idpelamar', 'desc')
                ->get();
        }

        $data = [
            'pelamar' => $pelamar,
        ];
        return view('admin.pelamar', $data);
    }

    public function detailpelamar($id)
    {
        $pelamar = DB::table('pelamar')
            ->join('pengguna as yanglamar', 'yanglamar.id', '=', 'pelamar.idpengguna')
            ->join('loker', 'pelamar.idloker', '=', 'loker.idloker')  // Memperbaiki join untuk loker
            ->join('pengguna as employer', 'employer.id', '=', 'loker.idemployer')  // Menghubungkan employer dengan pengguna
            ->where('pelamar.idpelamar', $id)  // Memastikan employer sesuai dengan pengguna yang login
            ->orderBy('pelamar.idpelamar', 'desc')
            ->first();

        $data = [
            'pelamar' => $pelamar
        ];

        return view('admin.detailpelamar', $data);
    }

    public function updatestatus(Request $request, $id)
    {
        DB::table('pelamar')->where('idpelamar', $id)->update([
            'status' => $request->status,
            'catatan' => $request->catatan
        ]);

        return redirect('admin/pelamar')->with('success', 'Status berhasil diubah');
    }

    public function hapuspelamar($id)
    {
        DB::table('pelamar')->where('idpelamar', $id)->delete();
        return redirect('admin/pelamar')->with('success', 'Pelamar berhasil dihapus');
    }

}
