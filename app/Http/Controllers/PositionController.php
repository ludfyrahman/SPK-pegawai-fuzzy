<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Position;
class PositionController extends Controller
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
        $data = Position::all();
        $title = 'List Data Jabatan';

        return view('superadmin.position.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data Jabatan';
        $data = (object)[
            'name'                   => '',
            'description'            => '',
            'type'                   => 'create',
            'route'                  => route('position.store')
        ];
        $positions              = ['fungsional', 'struktural'];
        return view('superadmin.position.form', compact('title', 'data', 'positions'));
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
            'position_type'            => 'required',

        ]);

        try {
            Position::create([
                'name'                   => $request->name,

                'position_type'            => $request->position_type,
                'created_at'             => date('Y-m-d H:i:s'),
                'updated_at'             => date('Y-m-d H:i:s'),
            ]);
            return redirect('position')->with ('Berhasil menambah data!');
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
        $data = Position::where('id', $id)->first();
        $data->route = route('position.index');
        $data->type = 'detail';
        $title = 'Detail Data Jabatan';
        $Jabatan = Position::all();

        // code aslinya
        return view('superadmin.position.form', compact('id', 'data', 'title'));
    }

    public function edit($id)
    {
        //
        $data = Position::where('id', $id)->first();
        $data->route = route('position.update', $id);
        $title = 'Edit Data Jabatan';
        $positions  = ['fungsional', 'struktural'];
        return view('superadmin.position.form', compact('data', 'title', 'positions'));
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
        $name = $file->store('position', 'public');
        // $file->move('file_siswa',$nama_file);
        $path = storage_path('app/public/' . $name);
        // import data
        $import = new JabatanImport();
        Excel::import($import, $path);

        // notifikasi dengan session
        Session::flash('sukses','Data Jabatan Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect(route('position.index'));
    }


    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name'                   => 'required',
            'position_type'            => 'required',

        ]);
        try {
            $data = ([
                'name'                   => $request->name,
                'position_type'            => $request->position_type,
                'updated_at'             => date('Y-m-d H:i:s'),
            ]);

            Position::where('id', $id)->update($data);
            return redirect('position')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!');
        }
    }
}
