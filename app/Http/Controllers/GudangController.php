<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use App\Models\Part;
class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Gudang::all();
        $title = 'List Data Gudang';
        return view('superadmin.gudang.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data Gudang';
        $data = (object)[
            'name'          => '',
            'deskripsi'     => '',
            'type'          => 'create',
            'route'         => route('gudang.store')
        ];
        return view('superadmin.gudang.form', compact('title', 'data'));
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
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        try {
            Gudang::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);
            return redirect('gudang')->with('success', 'Berhasil menambah data!');
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
    public function show($id)
    {
        $data = Gudang::where('id', $id)->first();
        $data->route = route('gudang.index');
        $data->type = 'detail';
        $title = 'Detail Data Gudang';
        $parts = Part::where('gudang_id', $id)->get();
        return view('superadmin.gudang.form', compact('data', 'title', 'parts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Gudang::where('id', $id)->first();
        $data->route = route('gudang.update', $id);
        $title = 'Edit Data Gudang';
        return view('superadmin.gudang.form', compact('data', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        try {
            $data = ([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ]);

            Gudang::where('id', $id)->update($data);
            return redirect('gudang')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Gudang::find($id)->delete();
        return redirect('gudang')->with('success', 'Berhasil mengubah data!');
    }
}
