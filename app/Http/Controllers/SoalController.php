<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSoalRequest;
use App\Http\Requests\UpdateSoalRequest;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
    public function index(Request $request)
    {
        // $soals = \App\Models\Soal::paginate(10);

        $soals = DB::table("soals")
        ->when($request->input('pertanyaan'),function($query, $nama){
            return $query->where('pertanyaan', 'like', '%'. $nama .'%');
        })
        // desc
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view("pages.soals.index", compact("soals"));
    }

    public function create()
    {
        return view("pages.soals.create");
    }

    public function store(StoreSoalRequest $request)
    {
        $data = $request->all();
        \App\Models\Soal::create($data);

        return redirect()->route('soal.index')->with("success","Soal success created");
    }

    public function edit($id)
    {
        $soal = \App\Models\Soal::findOrFail($id);

        return view('pages.soals.edit', compact('soal'));
    }

    public function update(UpdateSoalRequest $request,Soal $soal)
    {
        $data = $request->all();
        $soal->update($data);
        return redirect()->route('soal.index')->with('success','Soal successfully update');

    }

    public function destroy(Soal $soal)
    {
        $soal->delete();

        return redirect()->route('soal.index')->with('success','Soal successfully delete');
    }
}
