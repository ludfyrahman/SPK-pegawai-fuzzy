<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Position;
use App\Models\PositionDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use App\Imports\ProjectImport;


class EmployeeController extends Controller
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
        $data = Employee::all();
        $title = 'List Data Pegawai';

        return view('superadmin.employee.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data Pegawai';
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
            'route'                  => route('employee.store')
        ];
        return view('superadmin.employee.form', compact('title', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable',
            'nip_baru' => 'required',
            'nip_lama' => 'required',
            'nama' => 'required',
            'gelar_depan' => 'required',
            'gelar_belakang' => 'required',
            'tmt_cpns' => 'required',
            'gol_akhir' => 'required',
            'tmt_golongan' => 'required',
            'tingkat_pendidikan' => 'required',
            'nama_pendidikan' => 'required',
            'tahun_lulus' => 'required',
            'lokasi_kerja_nama' => 'required',
            'unit_kerja' => 'required',
            'instansi' => 'required',
            'unit_kerja_target' => 'required',
            'position_target' => 'required',
        ]);

        try {
            Employee::create([
                'user_id' => $request->user_id ?? null,
                'nip_baru' => $request->nip_baru,
                'nip_lama' => $request->nip_lama,
                'nama' => $request->nama,
                'gelar_depan' => $request->gelar_depan,
                'gelar_belakang' => $request->gelar_belakang,
                'tmt_cpns' => $request->tmt_cpns,
                'gol_akhir' => $request->gol_akhir,
                'tmt_golongan' => $request->tmt_golongan,
                'tingkat_pendidikan' => $request->tingkat_pendidikan,
                'nama_pendidikan' => $request->nama_pendidikan,
                'tahun_lulus' => $request->tahun_lulus,
                'lokasi_kerja_nama' => $request->lokasi_kerja_nama,
                'unit_kerja' => $request->unit_kerja,
                'instansi' => $request->instansi,
                'unit_kerja_target' => $request->unit_kerja_target,
                'position_target' => $request->position_target,
            ]);
            return redirect('employee')->with ('Berhasil menambah data!');
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
        $data = Employee::with(['position', 'position.position'])->where('id', $id)->first();
        $position = Position::all();
        $data->route = route('employee.index');
        $data->type = 'detail';
        $title = 'Detail Data Pegawai';
        $project = Employee::all();

        // code aslinya
        return view('superadmin.employee.form', compact('id', 'data', 'title', 'position'));
    }

    public function edit($id)
    {
        //
        $data = Employee::where('id', $id)->first();
        $data->route = route('employee.update', $id);
        $title = 'Edit Data Pegawai';
        return view('superadmin.employee.form', compact('data', 'title'));
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
        $name = $file->store('employee', 'public');
        // $file->move('file_siswa',$nama_file);
        $path = storage_path('app/public/' . $name);
        // import data
        $import = new ProjectImport();
        Excel::import($import, $path);

        // notifikasi dengan session
        Session::flash('sukses','Data Project Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect(route('employee.index'));
    }


    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'user_id' => 'nullable',
            'nip_baru' => 'required',
            'nip_lama' => 'required',
            'nama' => 'required',
            'gelar_depan' => 'required',
            'gelar_belakang' => 'required',
            'tmt_cpns' => 'required',
            'gol_akhir' => 'required',
            'tmt_golongan' => 'required',
            'tingkat_pendidikan' => 'required',
            'nama_pendidikan' => 'required',
            'tahun_lulus' => 'required',
            'lokasi_kerja_nama' => 'required',
            'unit_kerja' => 'required',
            'instansi' => 'required',
            'unit_kerja_target' => 'required',
            'position_target' => 'required',

        ]);
        try {
            $data = ([
                'user_id' => $request->user_id ?? null,
                'nip_baru' => $request->nip_baru,
                'nip_lama' => $request->nip_lama,
                'nama' => $request->nama,
                'gelar_depan' => $request->gelar_depan,
                'gelar_belakang' => $request->gelar_belakang,
                'tmt_cpns' => $request->tmt_cpns,
                'gol_akhir' => $request->gol_akhir,
                'tmt_golongan' => $request->tmt_golongan,
                'tingkat_pendidikan' => $request->tingkat_pendidikan,
                'nama_pendidikan' => $request->nama_pendidikan,
                'tahun_lulus' => $request->tahun_lulus,
                'lokasi_kerja_nama' => $request->lokasi_kerja_nama,
                'unit_kerja' => $request->unit_kerja,
                'instansi' => $request->instansi,
                'unit_kerja_target' => $request->unit_kerja_target,
                'position_target' => $request->position_target,
            ]);

            Employee::where('id', $id)->update($data);
            return redirect('employee')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!');
        }
    }

    public function storeEmployee(Request $request, $id){
        // dd($request->toArray());
        $request->validate([
            'position_id' => 'required',
            'start_period' => 'required',
            'end_period' => 'required',
            'status' => 'required',
        ]);

        try {
            PositionDetail::create([
                'user_id' => $id,
                'position_id' => $request->position_id,
                'start_period' => $request->start_period,
                'end_period' => $request->end_period,
                'status' => $request->status,
                'created_at' => now(),
            ]);
            return redirect(route('employee.edit', $id))->with('success', 'Berhasil menambah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menambah data!'.$th->getMessage());
        }
    }
}
