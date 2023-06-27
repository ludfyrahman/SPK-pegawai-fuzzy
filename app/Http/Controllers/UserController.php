<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
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
        $employee = Employee::all();
        return view('superadmin.user.form', compact('title', 'data', 'employee'));
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
            $employee_id = $request->employee_id;
            User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            if($employee_id){
                Employee::where('id', $employee_id)->update(['user_id' => User::latest()->first()->id]);
            }
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
        $employee = Employee::where('user_id', $id)->first();
        $data->employee_id = $employee->id ?? null;
        $data->route = route('user.index');
        $data->type = 'detail';
        $title = 'Detail Data User';
        $employee = Employee::all();
        return view('superadmin.user.form', compact('data', 'title', 'employee'));
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
        $employee = Employee::where('user_id', $id)->first();
        $data->employee_id = $employee->id ?? null;
        $data->route = route('user.update', $id);
        $title = 'Edit Data User';
        $employee = Employee::all();
        return view('superadmin.user.form', compact('data', 'title', 'employee'));
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

            if($request->password){
                $data['password'] = Hash::make($request->password);
            }

            User::where('id', $id)->update($data);
            return redirect('user')->with('success', 'Berhasil mengubah data!');
        } catch (\Throwable $th) {
            return back()->with('failed', 'Gagal mengubah data!'.$th->getMessage());
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
