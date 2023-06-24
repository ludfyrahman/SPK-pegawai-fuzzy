<?php

namespace App\Http\Controllers;

use App\Imports\PartImport;
use Illuminate\Http\Request;
use App\Models\Part;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Gudang;
use App\Models\History;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Part::all();
        $title = 'List Data part';

        return view('superadmin.part.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data part';
        $data = (object)[
            'gudang_id'     => '',
            'no_part'       => '',
            'sap'           => '',
            'cat'           => '',
            'deskripsi'     => '',
            'satuan'        => '',
            'lokasi'        => '',
            'keterangan'    => '',
            'stok'          => '',
            'foto'          => '',
            'barcode'       => '',
            'type'          => 'create',
            'route'         => route('part.store')
        ];
        $gudang = Gudang::all();
        return view('superadmin.part.form', compact('title', 'data', 'gudang'));
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
            'gudang_id'     => 'required',
            'no_part'       => 'required',
            'sap'           => 'required',
            'cat'           => 'required',
            'deskripsi'     => 'required',
            'satuan'        => 'required',
            'lokasi'        => 'required',
            'keterangan'    => 'required',
            'stok'          => 'required',
            'foto'          => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'barcode'       => 'required',
        ]);

        try {
            $foto = $request->file('foto');

            if($foto!=null){
                $filename =$foto->hashName();
                $foto->storeAs('foto', $filename);
                Part::create([
                    'gudang_id'     => $request->gudang_id,
                    'no_part'       => $request->no_part,
                    'sap'           => $request->sap,
                    'cat'           => $request->cat,
                    'deskripsi'     => $request->deskripsi,
                    'satuan'        => $request->satuan,
                    'lokasi'        => $request->lokasi,
                    'keterangan'    => $request->keterangan,
                    'stok'          => $request->stok,
                    'foto'          => $filename,
                    'barcode'       => $request->barcode,
                ]);
            }else{
                Part::create([
                    'gudang_id'     => $request->gudang_id,
                    'no_part'       => $request->no_part,
                    'sap'           => $request->sap,
                    'cat'           => $request->cat,
                    'deskripsi'     => $request->deskripsi,
                    'satuan'        => $request->satuan,
                    'lokasi'        => $request->lokasi,
                    'keterangan'    => $request->keterangan,
                    'stok'          => $request->stok,
                    'barcode'       => $request->barcode,
                ]);
            }

            return redirect('part')->with('success', 'Berhasil menambah data!');
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
        $data = Part::where('id', $id)->first();
        $data->route = route('part.index');
        $data->type = 'detail';
        $title = 'Detail Data part';
        $gudang = Gudang::all();

        $history = History::where('part_id', $id)->get();
        // code aslinya
        return view('superadmin.part.show', compact('id', 'data', 'title', 'gudang', 'history'));
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
        $data = Part::where('id', $id)->first();
        $data->route = route('part.update', $id);
        $gudang = Gudang::all();
        $title = 'Edit Data part';
        return view('superadmin.part.form', compact('data', 'title', 'gudang'));
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
        $name = $file->store('part', 'public');
        // $file->move('file_siswa',$nama_file);
        $path = storage_path('app/public/' . $name);
        // import data
        $import = new PartImport();
        Excel::import($import, $path);

        // notifikasi dengan session
        Session::flash('sukses','Data Part Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect(route('part.index'));
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
            'gudang_id'     => 'required',
            'no_part'       => 'required',
            'sap'           => 'required',
            'cat'           => 'required',
            'deskripsi'     => 'required',
            'satuan'        => 'required',
            'lokasi'        => 'required',
            'keterangan'    => 'required',
            'stok'          => 'required',
            'foto'          => 'nullable|image|mimes:jpeg,jpg,png,gif',
            'barcode'       => 'required',
        ]);
        try {
            $data = ([
                'gudang_id'     => $request->gudang_id,
                'no_part'       => $request->no_part,
                'sap'           => $request->sap,
                'cat'           => $request->cat,
                'deskripsi'     => $request->deskripsi,
                'satuan'        => $request->satuan,
                'lokasi'        => $request->lokasi,
                'keterangan'    => $request->keterangan,
                'stok'          => $request->stok,
                'barcode'       => $request->barcode,
            ]);
            if($request->foto != null){
                $foto = $request->file('foto');
                $filename = $foto->hashName();
                $foto->storeAs('foto', $filename);
                $data['foto']      = $filename;
            }

            Part::where('id', $id)->update($data);
            return redirect('part')->with('success', 'Berhasil mengubah data!');
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
        Part::find($id)->delete();
        return redirect('part')->with('success', 'Berhasil mengubah data!');
    }
}
