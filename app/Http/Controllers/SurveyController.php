<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusPengajuan;
use App\Models\Skema;
use App\Models\Survey;
use App\Models\StatusPeserta;


class SurveyController extends Controller
{
    public function index(){
        if(auth()->user()->status_peserta()->where('tanggal_surveilan', '!=', null)->get()->count() > 0){
            $berapaJumlahSurveyYangBelumDiIsi = 0;
            $belumSurvey = auth()->user()->status_peserta()->where('tanggal_surveilan', '!=', null)->get();
            foreach ($belumSurvey as $key => $value) {
                if($value->hasSurveyPassed()){
                    $berapaJumlahSurveyYangBelumDiIsi += 1;
                }
            }
            if($berapaJumlahSurveyYangBelumDiIsi > 0){
            }
        }

        // dd($belumSurvey);

        return view('peserta.survey.index', [
            'skemas' => Skema::all(),
            'surveys' => isset($belumSurvey) ? $belumSurvey : [], // apa makna baris ini?
        ]);
    }

    public function create(Request $request, $id_status_peserta){
        return view('peserta.survey.create', [
            'survey' => StatusPeserta::where('id_status_peserta', $id_status_peserta)->get()[0], // apa makna baris ini?
        ]);
    }

    public function store(Request $request, $id_status_peserta)
    {

        $status_peserta = StatusPeserta::where('id_status_peserta', $id_status_peserta)->get()[0];

        $rules = [
            'nomor_blanko' => 'required',
            'pekerjaan' => 'required',
            'instansi' => 'required',
            'keterangan' => 'required',
        ];


        $validatedData = $request->validate($rules);

        $validatedData['id_users'] = $status_peserta->id_users;
        $validatedData['id_skema'] = $status_peserta->id_skema;
        $validatedData['id_status_peserta'] = $status_peserta->id_status_peserta;

        // dd($request,$rules);
        $survey = new Survey();

        $survey->nomor_blanko = $validatedData['nomor_blanko'];
        $survey->pekerjaan = $validatedData['pekerjaan'];
        $survey->instansi = $validatedData['instansi'];
        $survey->keterangan = $validatedData['keterangan'];
        $survey->id_users = $validatedData['id_users'];
        $survey->id_skema = $validatedData['id_skema'];
        $survey->id_status_peserta = $validatedData['id_status_peserta'];

        $survey->save();

        StatusPeserta::where('id_status_peserta', $id_status_peserta)->update([
            'sudah_servey' => 'sudah',
        ]);

        return redirect()->route('peserta.survey.index')->with('success', 'Survey berhasil disimpan');
    }
}