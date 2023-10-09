<?php

namespace App\Http\Controllers;

use App\Models\EmailConfiguration;
use App\Models\KotaKabupaten;
use App\Models\Pangkat;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\PendidikanKepolisian;
use App\Models\Pengajuan;
use App\Models\Provinsi;
use App\Models\Satker;
use App\Models\Skema;
use App\Models\StatusPeserta;
use App\Models\Survey;
use App\Models\Tuk;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'jumlah_pendaftar' => Pengajuan::where('is_disetujui', '!=', 'disetujui')->where('is_disetujui', '!=', 'tidak_disetujui')->distinct('id_users')->count('id_users'),
            'peserta_aktif' => StatusPeserta::where('status', 'diterima')->distinct('id_users')->count('id_users'),
            'peserta_lulus' => StatusPeserta::where('status', 'lulus')->distinct('id_users')->count('id_users'),
            'pengajuans' => Pengajuan::all(),
        ]);
    }

    public function indexPeserta()
    {
        return view('admin.peserta.index', [
            'users' => User::where('role', 'peserta')->get(),
        ]);
    }

    public function showPeserta(Request $request, $id_users)
    {
        $sertifikat_pesertas = StatusPeserta::where('id_users', $id_users)->where('status', 'lulus')->get();

        $sertifikat = '';
        if (count($sertifikat_pesertas) > 0) {
            foreach ($sertifikat_pesertas as $key => $value) {
                $sertifikat .= $value->skema->nama.',';
            }
            substr_replace($sertifikat, '', -1);
        } else {
            $sertifikat = 'Belum pernah lulus dari skema apapun';
        }

        return view('admin.peserta.show', [
            'user' => User::where('role', 'peserta')->where('id_users', $id_users)->get()[0],
            'skema_diempuh' => $sertifikat,
        ]);
    }

    public function editPeserta(Request $request, $id_users)
    {
        return view('admin.peserta.edit', [
            'user' => User::where('role', 'peserta')->where('id_users', $id_users)->get()[0],
            'satkers' => Satker::orderBy('nama', 'ASC')->get(),
            'pangkats' => Pangkat::orderBy('nama', 'ASC')->get(),
            'pendidikan_kepolisians' => PendidikanKepolisian::orderBy('nama', 'ASC')->get(),
            'provinsis' => Provinsi::orderBy('nama_provinsi', 'ASC')->get(),
            'kota_kabupatens' => KotaKabupaten::orderBy('nama_kota_kabupaten', 'ASC')->get(),
            'pendidikans' => Pendidikan::orderBy('nama_pendidikan', 'ASC')->get(),
            'pekerjaans' => Pekerjaan::orderBy('nama_pekerjaan', 'ASC')->get(),
        ]);
    }

    public function updatePeserta(Request $request, $id_users)
    {
        $user = User::where('id_users', $id_users)->get()[0];

        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'no_telpon' => 'required|numeric',
            'photo' => 'image|mimes:jpeg,png,jpg',
        ];

        if (isset($request->password)) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('photo')) {
            if ($user->photo !== 'nopp.jpg') {
                Storage::delete($user->photo);
            }

            $validatedData['photo'] = str_replace('public/profile/', '', $request->file('photo')->store('public/profile'));
        }
        if (isset($request->password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        if (isset($request->jenis_kelamin)) {
            $validatedData['jenis_kelamin'] = $request->jenis_kelamin;
        }
        if (isset($request->nip)) {
            $validatedData['nip'] = $request->nip;
        }
        if (isset($request->nik)) {
            $validatedData['nik'] = $request->nik;
        }
        if (isset($request->jabatan)) {
            $validatedData['jabatan'] = $request->jabatan;
        }
        if (isset($request->tempat_lahir)) {
            $validatedData['tempat_lahir'] = $request->tempat_lahir;
        }
        if (isset($request->tanggal_lahir)) {
            $validatedData['tanggal_lahir'] = $request->tanggal_lahir;
        }
        if (isset($request->alamat)) {
            $validatedData['alamat'] = $request->alamat;
        }
        if (isset($request->kode_kota_kabupaten)) {
            $validatedData['kode_kota_kabupaten'] = $request->kode_kota_kabupaten;
        }
        if (isset($request->kode_provinsi)) {
            $validatedData['kode_provinsi'] = $request->kode_provinsi;
        }
        if (isset($request->kode_pendidikan)) {
            $validatedData['kode_pendidikan'] = $request->kode_pendidikan;
        }
        if (isset($request->kode_pekerjaan)) {
            $validatedData['kode_pekerjaan'] = $request->kode_pekerjaan;
        }
        if (isset($request->dikbangspes)) {
            $validatedData['dikbangspes'] = $request->dikbangspes;
        }
        if (isset($request->pelatihan_diikuti)) {
            $validatedData['pelatihan_diikuti'] = $request->pelatihan_diikuti;
        }
        if (isset($request->keterampilan_khusus)) {
            $validatedData['keterampilan_khusus'] = $request->keterampilan_khusus;
        }
        if (isset($request->id_satker)) {
            $validatedData['id_satker'] = $request->id_satker;
        }
        if (isset($request->id_pangkat)) {
            $validatedData['id_pangkat'] = $request->id_pangkat;
        }
        if (isset($request->id_pendidikan_kepolisian)) {
            $validatedData['id_pendidikan_kepolisian'] = $request->id_pendidikan_kepolisian;
        }

        User::where('id_users', $user->id_users)->update($validatedData);

        // dd($request, $rules);
        return redirect()->route('admin.peserta.index')->with('success', 'Data Peserta Has Been Updated Successful!');
    }

    public function destroyPeserta(Request $request, $id_users)
    {
        User::destroy($id_users);

        return redirect()->route('admin.peserta.index')->with('success', 'Data Peserta Has Been Deleted Successful!');
    }

    public function createPeserta()
    {
        return view('admin.peserta.create', [
            'satkers' => Satker::orderBy('nama', 'ASC')->get(),
            'pangkats' => Pangkat::orderBy('nama', 'ASC')->get(),
            'pendidikan_kepolisians' => PendidikanKepolisian::orderBy('nama', 'ASC')->get(),
            'provinsis' => Provinsi::orderBy('nama_provinsi', 'ASC')->get(),
            'kota_kabupatens' => KotaKabupaten::orderBy('nama_kota_kabupaten', 'ASC')->get(),
            'pendidikans' => Pendidikan::orderBy('nama_pendidikan', 'ASC')->get(),
            'pekerjaans' => Pekerjaan::orderBy('nama_pekerjaan', 'ASC')->get(),
        ]);
    }

    public function storePeserta(Request $request)
    {

        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_telpon' => 'required|numeric',
            'photo' => 'image|mimes:jpeg,png,jpg',
        ];
        $validatedData = $request->validate($rules);

        // Simpan data pengguna (users)
        $user = new User();

        if ($request->file('photo')) {
            $validatedData['photo'] = str_replace('public/profile/', '', $request->file('photo')->store('public/profile'));
        } else {
            $validatedData['photo'] = 'nopp.jpg';
        }

        $user->nama_lengkap = $validatedData['nama_lengkap'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->no_telpon = $validatedData['no_telpon'];

        if (isset($request->jenis_kelamin)) {
            $user->jenis_kelamin = $request->jenis_kelamin;
        }
        if (isset($request->nip)) {
            $user->nip = $request->nip;
        }
        if (isset($request->nik)) {
            $user->nik = $request->nik;
        }
        if (isset($request->jabatan)) {
            $user->jabatan = $request->jabatan;
        }
        if (isset($request->tempat_lahir)) {
            $user->tempat_lahir = $request->tempat_lahir;
        }
        if (isset($request->tanggal_lahir)) {
            $user->tanggal_lahir = $request->tanggal_lahir;
        }
        if (isset($request->alamat)) {
            $user->alamat = $request->alamat;
        }
        if (isset($request->kode_kota_kabupaten)) {
            $user->kode_kota_kabupaten = $request->kode_kota_kabupaten;
        }
        if (isset($request->kode_provinsi)) {
            $user->kode_provinsi = $request->kode_provinsi;
        }
        if (isset($request->kode_pendidikan)) {
            $user->kode_pendidikan = $request->kode_pendidikan;
        }
        if (isset($request->kode_pekerjaan)) {
            $user->kode_pekerjaan = $request->kode_pekerjaan;
        }
        if (isset($request->dikbangspes)) {
            $user->dikbangspes = $request->dikbangspes;
        }
        if (isset($request->pelatihan_diikuti)) {
            $user->pelatihan_diikuti = $request->pelatihan_diikuti;
        }
        if (isset($request->keterampilan_khusus)) {
            $user->keterampilan_khusus = $request->keterampilan_khusus;
        }
        if (isset($request->id_satker)) {
            $user->id_satker = $request->id_satker;
        }
        if (isset($request->id_pangkat)) {
            $user->id_pangkat = $request->id_pangkat;
        }
        if (isset($request->id_pendidikan_kepolisian)) {
            $user->id_pendidikan_kepolisian = $request->id_pendidikan_kepolisian;
        }

        $user->save();

        return redirect()->route('admin.peserta.index')->with('success', 'A Peserta Has Been Created Successful!');
    }

    public function indexOperator()
    {
        return view('admin.operator.index', [
            'users' => User::where('role', 'admin')->get(),
        ]);
    }

    public function createOperator()
    {
        return view('admin.operator.create');
    }

    public function storeOperator(Request $request)
    {
        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'no_telpon' => 'numeric',
        ];

        $validatedData = $request->validate($rules);

        // Simpan data pengguna (users)
        $user = new User();
        $user->nama_lengkap = $validatedData['nama_lengkap'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->no_telpon = $validatedData['no_telpon'];
        $user->role = 'admin';

        $user->save();

        return redirect()->route('admin.operator.index')->with('success', 'Data Operator Has Been Added Successful!');
    }

    public function editOperator(Request $request, $id_users)
    {
        return view('admin.operator.edit', [
            'user' => User::where('role', 'admin')->where('id_users', $id_users)->get()[0],
        ]);
    }

    public function updateOperator(Request $request, $id_users)
    {
        $user = User::where('role', 'admin')->where('id_users', $id_users)->get()[0];

        $rules = [
            'nama_lengkap' => 'required|string|max:255',
            'no_telpon' => 'numeric',
        ];

        if (isset($request->password)) {
            $rules['password'] = 'string|min:8|confirmed';
        }

        if ($request->email != $user->email) {
            $rules['email'] = 'required|string|email|max:255|unique:users';
        }

        $validatedData = $request->validate($rules);

        if ($request->email != $user->email) {
            if (isset($request->password)) {
                User::where('id_users', $id_users)->update([
                    'nama_lengkap' => $validatedData['nama_lengkap'],
                    'email' => $validatedData['email'],
                    'password' => Hash::make($validatedData['password']),
                    'no_telpon' => $validatedData['no_telpon'],
                ]);
            } else {
                User::where('id_users', $id_users)->update([
                    'nama_lengkap' => $validatedData['nama_lengkap'],
                    'email' => $validatedData['email'],
                    'no_telpon' => $validatedData['no_telpon'],
                ]);
            }
        } else {
            if (isset($request->password)) {
                User::where('id_users', $id_users)->update([
                    'nama_lengkap' => $validatedData['nama_lengkap'],
                    'password' => Hash::make($validatedData['password']),
                    'no_telpon' => $validatedData['no_telpon'],
                ]);
            } else {
                User::where('id_users', $id_users)->update([
                    'nama_lengkap' => $validatedData['nama_lengkap'],
                    'no_telpon' => $validatedData['no_telpon'],
                ]);
            }

        }

        return redirect()->route('admin.operator.index')->with('success', 'Data Operator Has Been Edited Successful!');
    }

    public function destroyOperator(Request $request, $id_users)
    {
        User::destroy($id_users);

        return redirect()->route('admin.operator.index')->with('success', 'Data Operator Has Been Deleted Successful!');
    }

    public function indexSurvey()
    {
        return view('admin.survey.index', [
            'surveys' => Survey::all(),
        ]);
    }

    public function lulusBelumBersertifikat(Request $request)
    {
        $status_peserta = StatusPeserta::where('status', 'lulus')->where('file_sertifikat', null)->get();
        if ($request->input('id_skema')) {
            if ($request->input('id_skema') === 'all') {
                $status_peserta = StatusPeserta::where('status', 'lulus')->where('file_sertifikat', null)->get();
            } else {
                $status_peserta = StatusPeserta::where('status', 'lulus')->where('file_sertifikat', null)->where('id_skema', $request->input('id_skema'))->get();
            }
        }

        return view('admin.peserta.lulus-belum-bersertifikat', [
            'status_pesertas' => $status_peserta,
            'skemas' => Skema::all(),
        ]);
    }

    public function diterimaBelumLulus(Request $request)
    {
        $status_peserta = Pengajuan::whereIn('is_disetujui', ['menunggu_pending', 'pending', 'revisi', 'disetujui'])
            ->where(function ($query) use ($request) {
                $query->whereIn('jenis_pengajuan', ['perpanjang'])
                    ->orWhere(function ($subquery) use ($request) {
                        $subquery->where('jenis_pengajuan', 'baru')
                                ->whereNotExists(function ($notExists) use ($request) {
                                    $notExists->select(DB::raw(1))
                                                ->from('pengajuan as p2')
                                                ->whereRaw('pengajuan.id_users = p2.id_users')
                                                ->whereRaw('pengajuan.id_skema = p2.id_skema')
                                                ->where('jenis_pengajuan', 'perpanjang');
                                });
                    });
            });

        if ($request->input('id_skema') && $request->input('id_skema') !== 'all') {
            $status_peserta->where('id_skema', $request->input('id_skema'));
        }

        if ($request->input('id_tuk') && $request->input('id_tuk') !== 'all') {
            $status_peserta->where('id_tuk', $request->input('id_tuk'));
        }

        if ($request->input('status') && $request->input('status') !== 'all') {
            $status_peserta->where('jenis_pengajuan', $request->input('status'));
        }

        $status_peserta = $status_peserta->distinct(['id_users', 'id_skema'])
            ->get(['id_users', 'id_skema', 'jenis_pengajuan', 'is_disetujui']);

        $result = [];

        foreach ($status_peserta as $st) {
            if($st->is_disetujui === 'disetujui'){
                $pengajuans_diterima = Skema::find($st->id_skema)->status_peserta()->where('status', 'diterima')->where('id_users', $st->id_users)->get();

                if(count($pengajuans_diterima) > 0){
                    $result[] = $pengajuans_diterima[0];
                }
            }
            else{
                $result[] = $st;
            }
        }

        return view('admin.peserta.diterima-belum-lulus', [
            'status_pesertas' => $result,
            'skemas' => Skema::orderBy('nama', 'ASC')->get(),
            'tuks' => Tuk::orderBy('nama', 'ASC')->get(),
        ]);
    }

    public function emailConfigurationShow()
    {
        return view('admin.email_configuration.show', [
            'email_configuration' => EmailConfiguration::all()[0],
        ]);
    }

    public function emailConfigurationUpdate(Request $request)
    {
        $rules = [
            'protocol' => 'required|string',
            'host' => 'required|string',
            'port' => 'required|string',
            'timeout' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ];

        $validatedData = $request->validate($rules);

        EmailConfiguration::where('id_email_configuration', 1)->update($validatedData);

        return redirect()->route('admin.emailConfigurationShow')->with('success', 'A Email Configuration Has Been Updated Successful!');

    }
}
