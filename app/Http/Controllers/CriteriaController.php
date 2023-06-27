<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Criteria;

class CriteriaController extends Controller
{
     //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Criteria::all();
        $title = 'List Data Kriteria';

        return view('superadmin.criteria.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data Kriteria';
        $data = (object)[
            'name'                   => '',
            'description'            => '',
            'type'                   => 'create',
            'route'                  => route('criteria.store')
        ];
        return view('superadmin.criteria.form', compact('title', 'data'));
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
            'name'                   => 'required',
            'description'            => 'required',

        ]);

        try {
            Criteria::create([
                'name'                   => $request->name,
                'description'            => $request->description,
                'created_at'             => date('Y-m-d H:i:s'),
                'updated_at'             => date('Y-m-d H:i:s'),
            ]);
            return redirect('criteria')->with ('Berhasil menambah data!');
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
        $data = Criteria::where('id', $id)->first();
        $data->route = route('criteria.index');
        $data->type = 'detail';
        $title = 'Detail Data Kriteria';
        $Kriteria = Criteria::all();

        // code aslinya
        return view('superadmin.criteria.form', compact('id', 'data', 'title'));
    }

    public function edit($id)
    {
        //
        $data = Criteria::where('id', $id)->first();
        $data->route = route('criteria.update', $id);
        $title = 'Edit Data Kriteria';
        return view('superadmin.criteria.form', compact('data', 'title'));
    }


    public function importData(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        // $nama_file = rand().$file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $name = $file->store('criteria', 'public');
        // $file->move('file_siswa',$nama_file);
        $path = storage_path('app/public/' . $name);
        // import data
        $import = new KriteriaImport();
        Excel::import($import, $path);

        // notifikasi dengan session
        Session::flash('sukses','Data Kriteria Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect(route('criteria.index'));
    }


    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name'                   => 'required',
            'description'            => 'required',

        ]);
        try {
            $data = ([
                'name'                   => $request->name,
                'description'            => $request->description,
                'updated_at'             => date('Y-m-d H:i:s'),
            ]);

            Criteria::where('id', $id)->update($data);
            return redirect('criteria')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!');
        }
    }
}
