<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class DashboardProductController extends Controller
{
    public function index()
    {
         
        return view ('superadmin.gudang1.index', [
            'data' => Product::all()
        ]);
    }

    public function create()
    {
        return view('superadmin.gudang1.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            
            'part_no' => 'required',
            'name' => 'required|max:225',
            'qty' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|file|mimes:png,jpg,jpeg||max:1024',
            'tanggal' => 'required',
            'code' => 'required'
        ]);

        
       $data = [
        'part_no' => $request->input('part_no'),
        'name' => $request->input('name'),
        'qty' => $request->input('qty'),
        'deskripsi' => $request->input('deskripsi'),
        
        'tanggal' => $request->input('tanggal'),
        'code' => $request->input('code'),
       ];
       
       

       if($request->file('image')) {
        $data['image'] = $request->file('image')->store('post-images');
       }

       Product::create($data);

       return redirect('/gudang1')->with('success', 'Berhasil di tambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
        Product::find($id)->delete();

        return redirect('/gudang1')->with('success', 'Berhasil di hapus!');

        
    }

    public function update(Request $request, Product $products)
    {
        $request->validate([
            'id' => $request->user()->id,
            'name' => 'required|max:225',
            'qty' => 'required',
            'image' => 'required',
            'deskripsi' => 'required|max:255',
            'code' => 'required',
            'tanggal' => 'required',
        ]);
        
        $data = [ 
            'part_no' => $request->input('part_no'),
            'name' => $request->input('name'),
            'qty' => $request->input('qty'),
            'deskripsi' => $request->input('deskripsi'),
            'image' => $request->input('image'),
            'code' => $request->input('code'),
            'tanggal' => $request->input('tanggal'),
        ];

       

        Product::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Products Created'
        ]);

        Product::where('id', $products->id)
        ->update($request);

        return redirect('/gudang1')->with('success', 'Berhasil di ubah!');
    }

    public function edit(Product $products)
    {
        return view('superadmin.gudang1.edit', [
            'product' => $products,
            'data' => $products::all()
        ]);
    }

      /**
     * Display the specified resource.
     *
     * @param  \App\Models\{Product} $product
     * @return \Illuminate\Http\Response
     */

    public function show(Product $products)
    {
        
        // dd($product);
        return view('superadmin.gudang1.show', [
            'data' => $products
        ]);
    }

}
