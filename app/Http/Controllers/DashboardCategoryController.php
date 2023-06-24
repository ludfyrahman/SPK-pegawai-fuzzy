<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardCategoryController extends Controller
{
    public function index()
    {
         
        return view ('admin.category.index', [
            'data' => Category::all()
        ]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            
            'name' => 'required|max:225',
            'body' => 'required'
        ]);

        $validatedData['id'] = new category;
        $validatedData['body'] = ($request->body);
        Category::create($validatedData);

        return redirect('/category')->with('success', 'Berhasil di tambahkan!');
    }

}
