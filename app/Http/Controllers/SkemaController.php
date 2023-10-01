<?php

namespace App\Http\Controllers;

use App\Mail\NotifikasiSertifikatMail;
use App\Models\Notifikasi;
use App\Models\Skema;
use App\Models\StatusPeserta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SkemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skemas = Skema::orderBy('id_skema', 'desc')->get();

        return view('admin.skema.index', [
            'skemas' => $skemas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.skema.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'kode' => 'required|string',
            'nama' => 'required|string',
            'persyaratan' => 'required|string',
            'dokumen_persyaratan' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'photo' => 'image|mimes:jpeg,png,jpg',
        ];

        $fileSyarat = '';

        if (isset($request->file_syarat_ijazah_terakhir)) {
            $fileSyarat .= ',file_syarat_ijazah_terakhir';
        }
        if (isset($request->file_syarat_sertifikat_pelatihan)) {
            $fileSyarat .= ',file_syarat_sertifikat_pelatihan';
        }
        if (isset($request->file_syarat_sk_penempatan)) {
            $fileSyarat .= ',file_syarat_sk_penempatan';
        }
        if (isset($request->file_syarat_sk_bebas_narkoba)) {
            $fileSyarat .= ',file_syarat_sk_bebas_narkoba';
        }
        if (isset($request->file_syarat_sk_sehat)) {
            $fileSyarat .= ',file_syarat_sk_sehat';
        }
        if (isset($request->file_syarat_surat_rekomendasi_satker)) {
            $fileSyarat .= ',file_syarat_surat_rekomendasi_satker';
        }
        if (isset($request->file_syarat_nilai_e_rohani)) {
            $fileSyarat .= ',file_syarat_nilai_e_rohani';
        }
        if (isset($request->file_syarat_smk_skp_terakhir)) {
            $fileSyarat .= ',file_syarat_smk_skp_terakhir';
        }
        if (isset($request->file_syarat_cv)) {
            $fileSyarat .= ',file_syarat_cv';
        }
        if (isset($request->file_syarat_pas_photo)) {
            $fileSyarat .= ',file_syarat_pas_photo';
        }
        if (isset($request->file_syarat_sertifikat_keahlian_khusus)) {
            $fileSyarat .= ',file_syarat_sertifikat_keahlian_khusus';
        }
        if (isset($request->file_syarat_nilai_smk)) {
            $fileSyarat .= ',file_syarat_nilai_smk';
        }
        if (isset($request->file_syarat_keputusan_penyidik)) {
            $fileSyarat .= ',file_syarat_keputusan_penyidik';
        }
        if (isset($request->file_syarat_skhp)) {
            $fileSyarat .= ',file_syarat_skhp';
        }
        if (isset($request->file_syarat_dokumen_lainnya)) {
            $fileSyarat .= ',file_syarat_dokumen_lainnya';
        }
        if (isset($request->file_syarat_sk_pangkat)) {
            $fileSyarat .= ',file_syarat_sk_pangkat';
        }
        if (isset($request->file_syarat_identitas)) {
            $fileSyarat .= ',file_syarat_identitas';
        }
        if (isset($request->file_syarat_dikbangpes)) {
            $fileSyarat .= ',file_syarat_dikbangpes';
        }
        if (isset($request->file_syarat_kep_jabatan)) {
            $fileSyarat .= ',file_syarat_kep_jabatan';
        }
        if (isset($request->file_syarat_sprin_pelaksanaan_tugas)) {
            $fileSyarat .= ',file_syarat_sprin_pelaksanaan_tugas';
        }

        if ($fileSyarat !== '') {
            $fileSyarat = substr($fileSyarat, 1);
        }

        $validatedData = $request->validate($rules);

        if ($request->file('photo')) {
            $validatedData['photo'] = str_replace('public/skema/', '', $request->file('photo')->store('public/skema'));
        }

        if ($request->file('dokumen_persyaratan')) {
            $validatedData['dokumen_persyaratan'] = str_replace('public/skema/', '', $request->file('dokumen_persyaratan')->store('public/skema'));
        }

        $skema = new Skema();

        $skema->kode = $validatedData['kode'];
        $skema->nama = $validatedData['nama'];
        $skema->persyaratan = $validatedData['persyaratan'];
        $skema->file_syarat = $fileSyarat;

        if ($request->file('photo')) {
            $skema->photo = $validatedData['photo'];
        }

        if ($request->file('dokumen_persyaratan')) {
            $skema->dokumen_persyaratan = $validatedData['dokumen_persyaratan'];
        }

        $skema->save();

        return redirect()->route('skema.index')->with('success', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Skema $skema)
    {
        return view('admin.skema.show', [
            'skema' => $skema,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Skema $skema)
    {
        return view('admin.skema.edit', [
            'skema' => $skema,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skema $skema)
    {
        $rules = [
            'kode' => 'required|string',
            'nama' => 'required|string',
            'persyaratan' => 'required|string',
            'dokumen_persyaratan' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'photo' => 'image|mimes:jpeg,png,jpg',
            'status' => 'required',
        ];

        $fileSyarat = '';

        if (isset($request->file_syarat_ijazah_terakhir)) {
            $fileSyarat .= ',file_syarat_ijazah_terakhir';
        }
        if (isset($request->file_syarat_sertifikat_pelatihan)) {
            $fileSyarat .= ',file_syarat_sertifikat_pelatihan';
        }
        if (isset($request->file_syarat_sk_penempatan)) {
            $fileSyarat .= ',file_syarat_sk_penempatan';
        }
        if (isset($request->file_syarat_sk_bebas_narkoba)) {
            $fileSyarat .= ',file_syarat_sk_bebas_narkoba';
        }
        if (isset($request->file_syarat_sk_sehat)) {
            $fileSyarat .= ',file_syarat_sk_sehat';
        }
        if (isset($request->file_syarat_surat_rekomendasi_satker)) {
            $fileSyarat .= ',file_syarat_surat_rekomendasi_satker';
        }
        if (isset($request->file_syarat_nilai_e_rohani)) {
            $fileSyarat .= ',file_syarat_nilai_e_rohani';
        }
        if (isset($request->file_syarat_smk_skp_terakhir)) {
            $fileSyarat .= ',file_syarat_smk_skp_terakhir';
        }
        if (isset($request->file_syarat_cv)) {
            $fileSyarat .= ',file_syarat_cv';
        }
        if (isset($request->file_syarat_pas_photo)) {
            $fileSyarat .= ',file_syarat_pas_photo';
        }
        if (isset($request->file_syarat_sertifikat_keahlian_khusus)) {
            $fileSyarat .= ',file_syarat_sertifikat_keahlian_khusus';
        }
        if (isset($request->file_syarat_nilai_smk)) {
            $fileSyarat .= ',file_syarat_nilai_smk';
        }
        if (isset($request->file_syarat_keputusan_penyidik)) {
            $fileSyarat .= ',file_syarat_keputusan_penyidik';
        }
        if (isset($request->file_syarat_skhp)) {
            $fileSyarat .= ',file_syarat_skhp';
        }
        if (isset($request->file_syarat_dokumen_lainnya)) {
            $fileSyarat .= ',file_syarat_dokumen_lainnya';
        }
        if (isset($request->file_syarat_sk_pangkat)) {
            $fileSyarat .= ',file_syarat_sk_pangkat';
        }
        if (isset($request->file_syarat_identitas)) {
            $fileSyarat .= ',file_syarat_identitas';
        }
        if (isset($request->file_syarat_dikbangpes)) {
            $fileSyarat .= ',file_syarat_dikbangpes';
        }
        if (isset($request->file_syarat_kep_jabatan)) {
            $fileSyarat .= ',file_syarat_kep_jabatan';
        }
        if (isset($request->file_syarat_sprin_pelaksanaan_tugas)) {
            $fileSyarat .= ',file_syarat_sprin_pelaksanaan_tugas';
        }

        if ($fileSyarat !== '') {
            $fileSyarat = substr($fileSyarat, 1);
        }

        $validatedData = $request->validate($rules);

        if ($request->file('photo')) {
            if ($skema->photo !== 'noskema.jpg') {
                Storage::delete($skema->photo);
            }

            $validatedData['photo'] = str_replace('public/skema/', '', $request->file('photo')->store('public/skema'));
        }
        if ($request->file('dokumen_persyaratan')) {
            if ($skema->dokumen_persyaratan !== 'noskema.jpg') {
                Storage::delete($skema->dokumen_persyaratan);
            }

            $validatedData['dokumen_persyaratan'] = str_replace('public/skema/', '', $request->file('dokumen_persyaratan')->store('public/skema'));
        }

        $validatedData['file_syarat'] = $fileSyarat;

        Skema::where('id_skema', $skema->id_skema)->update($validatedData);

        return redirect()->route('skema.index')->with('success', 'Data telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skema $skema)
    {
        Skema::destroy($skema->id_skema);

        return redirect()->route('skema.index')->with('success', 'Data telah terhapus');
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('file')->storeAs('public/uploads', $filenametostore);

            // you can save image path below in database
            $path = asset('storage/uploads/'.$filenametostore);

            echo $path;
            exit;
        }
    }

    public function pesertaSkema(Request $request, $id_skema)
    {
        $skema = Skema::find($id_skema);
        $pengajuans_diterima = Skema::find($id_skema)->status_peserta()->where('status', 'diterima')->get();

        return view('admin.skema.peserta', [
            'skema' => $skema,
            'pengajuans' => $pengajuans_diterima,
        ]);
    }

    public function pesertaSkemaLulus(Request $request, $id_skema, $id_peserta)
    {
        StatusPeserta::where('id_skema', $id_skema)->where('id_users', $id_peserta)->update([
            'status' => 'lulus',
        ]);

        return redirect()->route('skema.pesertaSkema', $id_skema)->with('success_message', 'Peserta telah diluluskan');
    }

    public function sertifikatLulus(Request $request, $id_skema, $id_peserta)
    {
        StatusPeserta::where('id_skema', $id_skema)->where('id_users', $id_peserta)->update([
            'nomor_blanko' => $request->nomor_blanko,
            'nomor_registrasi' => $request->nomor_registrasi,
            'tanggal_penetapan' => $request->tanggal_penetapan,
            'tanggal_surveilan' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addYears(1),
            'tanggal_notif_expired' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addMonths(33),
            'tanggal_expired' => Carbon::createFromFormat('Y-m-d', $request->tanggal_penetapan)->addYears(3),
            'file_sertifikat' => str_replace('public/file_sertifikat/', '', $request->file('file_sertifikat')->store('public/file_sertifikat')),
        ]);

        $skema = Skema::find($id_skema);
        $user = User::find($id_peserta);

        Mail::send(new NotifikasiSertifikatMail([
            'email' => $user->email,
            'subject_' => 'Selamat, Anda telah lulus pada skema '.$skema->nama,
            'message_' => 'Selamat, Anda telah lulus pada skema '.$skema->nama.'. Silahkan login ke akun Anda untuk melihat sertifikat Anda.',
            'skema' => $skema->nama,
        ]));

        $notifikasi = new Notifikasi();

        $notifikasi->judul = 'Selamat, Anda telah lulus pada skema '.$skema->nama;
        $notifikasi->pesan = 'Selamat, Anda telah lulus pada skema '.$skema->nama.'. Silahkan login ke akun Anda untuk melihat sertifikat Anda.';
        $notifikasi->is_dibaca = 'tidak_dibaca';
        $notifikasi->id_users = $user->id_users;

        $notifikasi->save();

        return redirect()->route('skema.sertifikatSkema', $id_skema)->with('success_message', 'Data telah tersimpan');
    }

    public function sertifikatSkema(Request $request, $id_skema)
    {
        $skema = Skema::find($id_skema);
        $pengajuans_diterima = Skema::find($id_skema)->pengajuan()->where('is_disetujui', 'disetujui')->get();

        return view('admin.skema.sertifikat', [
            'skema' => $skema,
            'pengajuans' => $pengajuans_diterima,
        ]);
    }
}