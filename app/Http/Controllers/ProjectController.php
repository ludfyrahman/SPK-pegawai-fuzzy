<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Imports\ProjectImport;


class ProjectController extends Controller
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
        $data = Project::all();
        $title = 'List Data Project';

        return view('superadmin.project.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data project';
        $data = (object)[
            'nip_lama'               => '',
            'nip_baru'               => '',
            'nama'                   => '',
            'gelar_depan'            => '',
            'gelar_belakang'         => '',
            'tmt_cpns'               => '',
            'gol_akhir_id'           => '',
            'gol_akhir_nama'         => '',
            'tmt_golongan'           => '',
            'mk_tahun'               => '',
            'mk_bulan'               => '',
            'jenis_jabatan_nama'     => '',
            'jabatan_nama'           => '',
            'tmt_jabatan'            => '',
            'tingkat_pendidikan'     => '',
            'pendidikan_nama'        => '',
            'tahun_lulus'            => '',
            'kpkn_nama'              => '',
            'lokasi_kerja_nama'      => '',
            'unor_nama'              => '',
            'instasi_induk_nama'     => '',
            'type'                   => 'create',
            'route'                  => route('project.store')
        ];
        return view('superadmin.project.form', compact('title', 'data'));
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
            'nip_lama'               => 'required',
            'nip_baru'               => 'required',
            'nama'                   => 'required',
            'gelar_depan'            => 'required',
            'gelar_belakang'         => 'required',
            'tmt_cpns'               => 'required',
            'gol_akhir_id'           => 'required',
            'gol_akhir_nama'         => 'required',
            'tmt_golongan'           => 'required',
            'mk_tahun'               => 'required',
            'mk_bulan'               => 'required',
            'jenis_jabatan_nama'     => 'required',
            'jabatan_nama'           => 'required',
            'tmt_jabatan'            => 'required',
            'tingkat_pendidikan'     => 'required',
            'pendidikan_nama'        => 'required',
            'tahun_lulus'            => 'required',
            'kpkn_nama'              => 'required',
            'lokasi_kerja_nama'      => 'required',
            'unor_nama'              => 'required',
            'instasi_induk_nama'     => 'required',

        ]);

        try {
            Project::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'nip_lama'               => $request->nip_lama,
                'nip_baru'               => $request->nip_abru,
                'nama'                   => $request->nama,
                'gelar_depan'            => $request->gelar_depan,
                'gelar_belakang'         => $request->gelar_belakang,
                'tmt_cpns'               => $request->tmt_cpns,
                'gol_akhir_id'           => $request->gol_akhir_id,
                'gol_akhir_nama'         => $request->gol_akhir_nama,
                'tmt_golongan'           => $request->tmt_golongan,
                'mk_tahun'               => $request->mk_tahun,
                'mk_bulan'               => $request->mk_bulan,
                'jenis_jabatan_nama'     => $request->jenis_jabatan_nama,
                'jabatan_nama'           => $request->jabatan_nama,
                'tmt_jabatan'            => $request->tmt_jabatan,
                'tingkat_pendidikan'     => $request->tingkat_pendidikan,
                'pendidikan_nama'        => $request->pendidikan_lama,
                'tahun_lulus'            => $request->tahun_lulus,
                'kpkn_nama'              => $request->kpkn_nama,
                'lokasi_kerja_nama'      => $request->lokasi_kerja_nama,
                'unor_nama'              => $request->unor_nama,
                'instasi_induk_nama'     => $request->instansi_induk_nama,
            ]);
            return redirect('project')->with ('Berhasil menambah data!');
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
        $data = Project::where('id', $id)->first();
        $data->route = route('project.index');
        $data->type = 'detail';
        $title = 'Detail Data project';
        $project = Project::all();

        // code aslinya
        return view('superadmin.project.show', compact('id', 'data', 'title'));
    }

    public function edit($id)
    {
        //
        $data = Project::where('id', $id)->first();
        $data->route = route('project.update', $id);
        $title = 'Edit Data Project';
        return view('superadmin.project.form', compact('data', 'title'));
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
        $name = $file->store('project', 'public');
        // $file->move('file_siswa',$nama_file);
        $path = storage_path('app/public/' . $name);
        // import data
        $import = new ProjectImport();
        Excel::import($import, $path);

        // notifikasi dengan session
        Session::flash('sukses','Data Project Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect(route('project.index'));
    }


    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'gudang_id'     => 'required',
            'nip_lama'               => 'required',
            'nip_baru'               => 'required',
            'nama'                   => 'required',
            'gelar_depan'            => 'required',
            'gelar_belakang'         => 'required',
            'tmt_cpns'               => 'required',
            'gol_akhir_id'           => 'required',
            'gol_akhir_nama'         => 'required',
            'tmt_golongan'           => 'required',
            'mk_tahun'               => 'required',
            'mk_bulan'               => 'required',
            'jenis_jabatan_nama'     => 'required',
            'jabatan_nama'           => 'required',
            'tmt_jabatan'            => 'required',
            'tingkat_pendidikan'     => 'required',
            'pendidikan_nama'        => 'required',
            'tahun_lulus'            => 'required',
            'kpkn_nama'              => 'required',
            'lokasi_kerja_nama'      => 'required',
            'unor_nama'              => 'required',
            'instasi_induk_nama'     => 'required',

        ]);
        try {
            $data = ([
                'nama'                   => $request->nama,
                'deskripsi'              => $request->deskripsi,
                'nip_lama'               => $request->nip_lama,
                'nip_baru'               => $request->nip_abru,
                'nama'                   => $request->nama,
                'gelar_depan'            => $request->gelar_depan,
                'gelar_belakang'         => $request->gelar_belakang,
                'tmt_cpns'               => $request->tmt_cpns,
                'gol_akhir_id'           => $request->gol_akhir_id,
                'gol_akhir_nama'         => $request->gol_akhir_nama,
                'tmt_golongan'           => $request->tmt_golongan,
                'mk_tahun'               => $request->mk_tahun,
                'mk_bulan'               => $request->mk_bulan,
                'jenis_jabatan_nama'     => $request->jenis_jabatan_nama,
                'jabatan_nama'           => $request->jabatan_nama,
                'tmt_jabatan'            => $request->tmt_jabatan,
                'tingkat_pendidikan'     => $request->tingkat_pendidikan,
                'pendidikan_nama'        => $request->pendidikan_lama,
                'tahun_lulus'            => $request->tahun_lulus,
                'kpkn_nama'              => $request->kpkn_nama,
                'lokasi_kerja_nama'      => $request->lokasi_kerja_nama,
                'unor_nama'              => $request->unor_nama,
                'instasi_induk_nama'     => $request->instansi_induk_nama,
            ]);

            Project::where('id', $id)->update($data);
            return redirect('project')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!');
        }
    }
}
