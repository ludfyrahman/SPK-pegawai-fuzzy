<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CriteriaDetail as Criteria;

class DetailCriteriaController extends Controller
{
     //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $id = $request->id;
        $data = Criteria::where('criteria_id', $id)->get();
        $title = 'List Data Detail Kriteria';
        return view('superadmin.detail-criteria.index', compact('data', 'title', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $title = 'Tambah Data Detail Kriteria';
        $data = (object)[
            'name'                   => '',
            'description'            => '',
            'type'                   => 'create',
            'route'                  => route('detail-criteria.store', ['id' => $request->id])
        ];
        $id = $request->id;
        return view('superadmin.detail-criteria.form', compact('title', 'data', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $id = $request->id;
        $request->validate([
            'weight'                 => 'required',
            'description'            => 'required',

        ]);
        try {
            Criteria::create([
                'criteria_id'            => $id,
                'weight'                 => $request->weight,
                'description'            => $request->description,
                'created_at'             => date('Y-m-d H:i:s'),
                'updated_at'             => date('Y-m-d H:i:s'),
            ]);
            return redirect(route('detail-criteria.index', ['id' => $id]))->with ('Berhasil menambah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menambah data!'.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $data = Criteria::where('id', $id)->first();
        $data->route = route('detail-criteria.index');
        $data->type = 'detail';
        $title = 'Detail Data Detail Kriteria';
        $Kriteria = Criteria::all();

        // code aslinya
        return view('superadmin.detail-criteria.form', compact('id', 'data', 'title'));
    }

    public function edit(Request $request,$id)
    {
        //
        $data = Criteria::where('id', $id)->first();
        $data->route = route('detail-criteria.update', $id);
        $title = 'Edit Data Detail Kriteria';
        $id = $request->id;
        return view('superadmin.detail-criteria.form', compact('data', 'title', 'id'));
    }



    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'weight'                 => 'required',
            'description'            => 'required',
        ]);
        try {
            $data = ([
                'weight'                 => $request->weight,
                'description'            => $request->description,
                'updated_at'             => date('Y-m-d H:i:s'),
            ]);
            $parent = $request->id;
            Criteria::where('id', $id)->update($data);
            $find = Criteria::where('id', $id)->first();
            return redirect(route('detail-criteria.index', ['id' => $find->criteria_id]))->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {

            return back()->with('failed', 'Gagal mengubah data!'.$th->getMessage());
        }
    }

    public function destroy(Request $request, $id)
    {
        //
        try {
            $criteria = Criteria::where('id', $id)->delete();
            return redirect(route('detail-criteria.index', ['id' => $criteria->criteria_id]))->with('success', 'Berhasil menghapus data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menghapus data!');
        }
    }
}
