<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Koneksi Database
use App\Models\Candidates;
use App\Models\Jobs;
use App\Models\Skills;
use App\Models\Skill_sets;

// Api Resource
use App\Http\Resources\CandidatesResource;

class CandidateController extends Controller
{
    
    public function index()
    {
        // Get Data Candidate
        $candidates = Candidates::all();

        // Return collection of Candidate
        return new CandidatesResource('List Data Candidates', $candidates);
    }


    public function store(Request $request)
    {
        //Define Validation Rules
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'jobs'     => 'required',
            'email'    => 'required|unique:candidates|email',
            'phone'    => 'required|unique:candidates|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
            'year'     => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|integer|digits:4',
            'skills'   => 'required'
        ], [
            'name.required'=> 'Entry Nama wajib diisi',

            'jobs.required'=> 'Entry Jobs wajib diisi',

            'email.required'=> 'Entry Email wajib diisi',
            'email.unique'=> 'Email sudah digunakan, silahkan gunakan Email lain',
            'email.email'=> 'Email wajib menggunakan @',
            
            'phone.required'=> 'Entry Phone wajib diisi',
            'phone.unique'=> 'Nomor Telepon sudah digunakan, silahkan gunakan Phone lain',
            'phone.regex'=> 'Entry Phone wajib diisi Angka',
            'phone.min'=> 'Entry Phone Minimal 10 Angka',
            'phone.max'=> 'Entry Phone Minimal 13 Angka',

            'year.required'=> 'Entry Year wajib diisi',
            'year.regex'=> 'Entry Year wajib diisi Angka',
            'year.integer'=> 'Entry Year wajib diisi Angka',
            'year.digits'=> 'Entry Year wajib berisi 4 digit',

            'skills.required'=> 'Entry Skills wajib diisi',
        ]);

        // Cek Apakah Validasi Gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Get Data From Tabel Jobs
        $jobs_id = Jobs::where('name', 'LIKE', '%'.$request->jobs.'%')->get('id');

        // Store/Simpan Data to Table Candidates
        $candidate = Candidates::create([
            'name'      => $request->name,
            'job_id'    => $jobs_id[0]['id'],
            'email'     => $request->email,
            'phone'     => $request->phone,
            'year'      => $request->year,
        ]);

        // Get Data From Tabel Candidates (Ambil ID)
        $candidate_id = Candidates::where('phone', 'LIKE', '%'.$request->phone.'%')->get('id');

        // Get Data From Table Skill_Sets (Ambil ID)
        $skillsTo_arr = preg_split('~{tag=.+?{/tag}(*SKIP)(*F)|\h*,\h*~', $request->skills);

        // Perulangan Untuk Input Data ke Tabel Skill_Sets
        foreach ($skillsTo_arr as $skill) {
            
            // Get Data From Tabel Skills (Ambil ID)
            $skill_id = Skills::where('name', 'LIKE', '%'.$skill.'%')->get('id');

            // Jika Array Tidak Kosong Maka Jalankan
            if ( sizeof($skill_id) != 0 ) {

                // Get Data From Tabel Skills (Cek apakah ada data yg sama di tabel Skill_sets)
                // Digunakan Agar Tidak Terjadi Redudansi
                $skill_sets_id = Skill_sets::where([
                                                    ['candidate_id', '=', $candidate_id[0]['id']],
                                                    ['skill_id', '=', $skill_id[0]['id']],
                                                  ])->get('skill_id');

                // Jika $skill_sets_id(variabel diatas) Tidak Kosong Maka Iterasi Foreach Harus Di Skip
                if ( sizeof($skill_sets_id) != 0 ) {
                    continue;
                }

                //Store Data to Table Skills Set
                $skill_sets = Skill_sets::create([
                    'candidate_id' => $candidate_id[0]['id'],
                    'skill_id'     => $skill_id[0]['id']
                ]);

            }
        }
        
        // Return collection of Candidate
        return new CandidatesResource('Candidate Data successfully added!', $candidate);
    }


    public function show(Candidates $candidate)
    {
        // Return Single Data of Candidate 
        return new CandidatesResource('Candidate data found!', $candidate);
    }


    public function destroy(Candidates $candidate)
    {   
        // Delete Post
        $candidate->delete();

        // Return Response to Delete Single Data
        return new CandidatesResource('Candidate data has been successfully deleted!', null);
    }


}
