<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = User::all();
        $title = 'List Data User';
        return view('superadmin.user.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Tambah Data User';
        $data = (object)[
            'name'          => '',
            'username'          => '',
            'email'          => '',
            'password'          => '',
            'type'          => 'create',
            'route'         => route('user.store')
        ];
        return view('superadmin.user.form', compact('title', 'data'));
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'email:rfc,dns',
            'password' => '',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password,

            ]);
            return redirect('user')->with('success', 'Berhasil menambah data!');
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
        $data = User::where('id', $id)->first();
        $data->route = route('user.index');
        $data->type = 'detail';
        $title = 'Detail Data User';
        return view('superadmin.user.form', compact('data', 'title'));
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
        $data = User::where('id', $id)->first();
        $data->route = route('user.update', $id);
        $title = 'Edit Data User';
        return view('superadmin.user.form', compact('data', 'title'));
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'email:rfc,dns',
        ]);
        try {
            $data = ([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);

            User::where('id', $id)->update($data);
            return redirect('user')->with('success', 'Berhasil mengubah data!');
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
        User::find($id)->delete();
        return redirect('user')->with('success', 'Berhasil mengubah data!');
    }
}
