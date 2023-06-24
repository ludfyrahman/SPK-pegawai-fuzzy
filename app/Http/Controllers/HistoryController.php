<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Part;
use App\Models\Gudang;
use App\Models\History;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = History::all();
        $title = 'List Data part';

        return view('superadmin.history.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $title = 'Tambah Data History';
        $id = $request->id;
        $data = (object)[
            'part_id'       => '',
            'tanggal'       => '',
            'amount'       => '',
            'type'          => '',
            'description'   => '',
            'page'          => 'create',
            'route'         => route('history.store', ['id' => $id])
        ];
        return view('superadmin.history.form', compact('title', 'data', 'id'));
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
            'part_id'       => 'required',
            'tanggal'       => 'required',
            'amount'        => 'required',
            'type'          => 'required',
            'description'   => 'required',
        ]);

        try {

            $history = History::where('part_id', $request->part_id)->get();
            $pemasukan = $pengeluaran = 0;
            foreach ($history as $key => $h) {
                if($h->type == 1)
                    $pemasukan+=$h->amount;
                if($h->type == 2)
                    $pengeluaran+=$h->amount;
            }
            if($request->type == 2)
                $pengeluaran+=$request->amount;
            if($request->type == 1)
                $pemasukan+=$request->amount;

            $total = $pemasukan - $pengeluaran;
            if($total < 0){
                return back()->with('failed', 'Gagal menambah data! silahkan isi jumlah yang valid. jumlah pengeluaran melebihi pemasukan');
            }
            History::create([
                'part_id'       => $request->part_id,
                'tanggal'       => $request->tanggal,
                'amount'        => $request->amount,
                'type'          => $request->type,
                'description'   => $request->description,
            ]);
            $part = Part::find($request->part_id);
            $part->stok = $total;
            $part->save();
            return redirect(route('part.show', $request->id))->with('success', 'Berhasil menambah data!');
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
        return view('superadmin.history.show', compact('id','data', 'title', 'gudang', 'history'));
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
        $data = History::where('id', $id)->first();
        $data->route = route('history.update', $id);
        $gudang = Gudang::all();
        $title = 'Edit Data part';
        return view('superadmin.history.form', compact('id', 'data', 'title', 'gudang'));
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
            'tanggal'       => 'required',
            'amount'        => 'required',
            'type'          => 'required',
            'description'   => 'required',
        ]);
        try {
            $history = History::where('part_id', $request->part_id)->get();
            $pemasukan = $pengeluaran = 0;
            foreach ($history as $key => $h) {
                if($h->type == 1)
                    $pemasukan+=$h->amount;
                if($h->type == 2)
                    $pengeluaran+=$h->amount;
            }
            if($request->type == 2)
                $pengeluaran+=$request->amount;
            if($request->type == 1)
                $pemasukan+=$request->amount;


            $total = $pemasukan - $pengeluaran;
            if($total < 0){
                return back()->with('failed', 'Gagal menambah data! silahkan isi jumlah yang valid. jumlah pengeluaran melebihi pemasukan');
            }
            $data = ([
                'tanggal'       => $request->tanggal,
                'amount'       => $request->amount,
                'type'          => $request->type,
                'description'   => $request->description,
            ]);

            History::where('id', $id)->update($data);

            $part = Part::find($request->part_id);
            $part->stok = $total;
            $part->save();
            return redirect('part')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!' .$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //
        // Part::find($id)->delete();
        // return redirect(route('part.show', $request->id))->with('success', 'Berhasil Hapu data!');
    }
}
