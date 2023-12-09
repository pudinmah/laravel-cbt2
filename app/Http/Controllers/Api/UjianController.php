<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SoalResource;
use App\Models\Soal;
use App\Models\Ujian;
use App\Models\UjianSoalList;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    // CREATE UJIAN
    public function createUjian(Request $request)
    {
        // get 20 soal angka random unique
        $soalAngka = Soal::where('kategori', 'Numeric')->inRandomOrder()->limit(20)->get();
        // get 20 soal VERBAL random
        $soalVerbal = Soal::where('kategori', 'Verbal')->inRandomOrder()->limit(20)->get();
        // get 20 soal LOGIKA random
        $soalLogika = Soal::where('kategori', 'Logika')->inRandomOrder()->limit(20)->get();

        // CREATE UJIAN
        $ujian = Ujian::create([
            'user_id' => $request->user()->id,
        ]);

        // SOAL ANGKA
        foreach ($soalAngka as $soal) {
            UjianSoalList::create([
                'ujian_id' => $ujian->id,
                'soal_id' => $soal->id,
            ]);
        }

        // SOAL VERBAL
        foreach ($soalVerbal as $soal) {
            UjianSoalList::create([
                'ujian_id' => $ujian->id,
                'soal_id' => $soal->id,
            ]);
        }

        // SOAL LOGIKA
        foreach ($soalLogika as $soal) {
            UjianSoalList::create([
                'ujian_id' => $ujian->id,
                'soal_id' => $soal->id,
            ]);
        }

        return response()->json([
            'message' => 'Ujian berhasil dibuat',
            'data' => $ujian,
        ]);
    }

    // get list soal by kategori
    public function getListSoalByKategori(Request $request)
    {
        $ujian = Ujian::where('user_id', $request->user()->id)->first();
        $ujianSoalList = UjianSoalList::where('ujian_id', $ujian->id)->get();
        $soalIds = $ujianSoalList->pluck('soal_id');

        dd($soalIds);

        $soal = Soal::whereIn('id', $soalIds)->where('kategori', $request->kategori)->get();



        // $ujianSoalListId = [];

        // foreach ($ujianSoalList as $soal) {
        //     array_push($ujianSoalListId, $soal->soal_id);
        // }

        // $soal = Soal::whereIn('id', $ujianSoalListId)->where('kategori', $request->kategori)->get();

        return response()->json([
            'message' => 'Berhasil mendapatkan soal',
            // 'data' => $soal,
            'data' => SoalResource::collection($soal),
        ]);
    }

    // jawab soal
    public function jawabSoal(Request $request)
    {
        $validatedData = $request->validate([
            'soal_id' => 'required',
            'jawaban' => 'required',
        ]);


        $ujian = Ujian::where('user_id', $request->user()->id)->first();
        $ujianSoalList = UjianSoalList::where('ujian_id', $ujian->id)->where('soal_id', $validatedData['soal_id'])->first();
        $soal = Soal::where('id', $validatedData['soal_id'])->first();

        // CEK JAWABAN
        if ($soal->kunci == $validatedData['jawaban']) {
            $ujianSoalList->update(
                [
                    'kebenaran' => true
                ]
            );
            // $ujianSoalList->kebenaran = true;
            // $ujianSoalList->save();
        } else {
            $ujianSoalList->update(
                [
                    'kebenaran' => false,
                ]
            );
            // $ujianSoalList->kebenaran = false;
            // $ujianSoalList->save();
        }

        return response()->json([
            'message' => 'Berhasil Simpan jawaban',
            'jawaban' => $ujianSoalList->kebenaran,

        ]);
    }
}
