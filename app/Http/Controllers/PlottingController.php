<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PlottingPosition;
use App\Models\Employee;
use App\Models\Position;
use App\Models\PositionDetail;
use App\Models\Criteria;
// import db
use Illuminate\Support\Facades\DB;
// import plottingpositiondetail
use App\Models\PlottingPositionDetail;
class PlottingController extends Controller
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
        $data = PlottingPosition::all();
        $title = 'List Plotting Karyawan';

        return view('superadmin.plotting.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Plotting Karyawan';
        $employee = Employee::all();
        $position = Position::all();
        $positionDetail = PositionDetail::all();
        $criterias = Criteria::with('criteriaDetail')->get();
        $data = (object)[
            'name'                   => '',
            'description'            => '',
            'weight'                => '',
            'type'                   => 'create',
            'route'                  => route('plotting.store')
        ];
        return view('superadmin.plotting.form', compact('title', 'data', 'employee','position','positionDetail', 'criterias'));
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
            'employee_id'       => 'required',
            'position_id'       => 'required',
            'criteria.*'            => 'required',

        ]);

        try {
            DB::beginTransaction();
            $plot =PlottingPosition::create([
                'employee_id'     => $request->employee_id,
                'position_id'     => $request->position_id,
            ]);
            foreach ($request->criteria as $key => $criteria) {
                PlottingPositionDetail::create([
                    'plotting_position_id'  => $plot->id,
                    'criteria_id'          => $key,
                    'weight'                => $criteria,
                ]);
            }
            DB::commit();
            return redirect(route('plotting.index'))->with ('Berhasil menambah data!');
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('failed', 'Gagal menambah data!'.$th->getMessage());
        }
    }

    public function calculation(Request $request){
        $positionDetail = PositionDetail::with(['position','criteriaDetail'])->where('position_id', $request->position_id)->get();
        $criteria = Criteria::with('plottingPositionDetail')->get();
        $employee = Employee::with(['plottingPosition', 'plottingPosition.plottingPositionDetail','plottingPosition.plottingPositionDetail.criteria'])->get();
        $data = $this->calculationAction($employee, $positionDetail,$request);
        $positions = Position::with('positionDetail')->get();
        $title = 'Perhitungan Plotting Karyawan';
        return view('superadmin.plotting.calculation', compact('title', 'criteria', 'employee', 'data', 'positions','request', 'positionDetail'));
    }

    public function calculationAction($data, $positionDetail, $request){
        $score = [];
        $value = -0.15;
        $vectorS = [];
        $vectorV = [];
        $total = 0;
        $weight_fixing = [];
        foreach ($positionDetail as $index => $d)
        {
            $weight_fixing[] = [
                'name' => 'W'.$index+1,
                'weight' => $d->weight / $positionDetail->sum('weight'),
            ];
        }
        $weight_fixing_total = array_sum(array_column($weight_fixing, 'weight'));
        foreach ($data as $key => $d) {
            $childData = $d->plottingPosition?->plottingPositionDetail;
            if($childData!= null){
                $score[] = ['name' => $d->nama, 'plot' => $childData];
                $s = $this->calculationScore($childData, $weight_fixing);
                $vectorS[] = $s;
                $total += array_sum($s);
            }
        }
        foreach ($vectorS as $key => $vector) {
            $vectorV[] = $this->calculationScoreV($vectorS[$key], $total);
        }
        $rank = [];
        foreach ($vectorV as $key => $value) {
            $childRank = ['name' => $score[$key]['name'], 'value' => $value];
            $rank[] = $childRank;
        }
        usort($rank, function($a, $b) {
            return $b['value'] <=> $a['value'];
        });
        $result = ['score' => $score, 'vectorS' => $vectorS, 'vectorV' => $vectorV,'rank' => $rank, 'total' => $total];
        return $result;
    }
    public function calculationScore($data, $weight_fixing){
        $score = [];
        $all = Criteria::sum('weight');
        // dd($data->toArray());
        foreach ($data as $key => $d) {
            $value = $d->criteria->weight / $all;
            $score[] = $d->weight ** ($weight_fixing[$key]['weight'] ?? 0);
        }
        // dd($score);

        return $score;
    }
    public function calculationScoreV($score, $total){
        $totalScrore = array_sum($score);
        $result = $totalScrore / $total;
        return $result;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PlottingPosition::where('id', $id)->first();
        $data->route = route('plotting.index');
        $data->type = 'detail';
        $title = 'Detail Plotting Karyawan';
        $Kriteria = PlottingPosition::all();

        // code aslinya
        return view('superadmin.plotting.form', compact('id', 'data', 'title'));
    }

    public function edit($id)
    {
        //
        $data = PlottingPosition::where('id', $id)->first();
        $data->route = route('plotting.update', $id);
        $title = 'Edit Plotting Karyawan';
        return view('superadmin.plotting.form', compact('data', 'title'));
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
        Session::flash('sukses','Plotting Karyawan Berhasil Diimport!');

        // alihkan halaman kembali
        return redirect(route('plotting.index'));
    }


    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name'                   => 'required',
            'description'            => 'required',
            'weight'            => 'required',

        ]);
        try {
            $data = ([
                'name'                   => $request->name,
                'description'            => $request->description,
                'weight'                 => $request->weight,
                'updated_at'             => date('Y-m-d H:i:s'),
            ]);

            PlottingPosition::where('id', $id)->update($data);
            return redirect('criteria')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!'.$th->getMessage());
        }
    }

    public function destroy($id)
    {
        //
        try {
            PlottingPosition::where('id', $id)->delete();
            return redirect(route('plotting.index'))->with('success', 'Berhasil menghapus data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal menghapus data!'.$th->getMessage());
        }
    }
}
