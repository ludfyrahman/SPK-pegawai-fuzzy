@extends('superadmin.dashboard.layout.main')

@section('container')

<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight mb-5">Detail Barang</h2>

            <div class="bg-white overflow-hidden shadow sm:rounded-lg mb-10">
                 <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <tbody>
                        <tr>
                                <th class="border px-6 py-4 text-right">Image</th>
                                
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Part No</th>
                                <td class="border px-6 py-4">{{ $data->part_no }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Name</th>
                                <td class="border px-6 py-4">{{ $data->name }}</td>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Quantity</th>
                                
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Deskripsi</th>
                                
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Tanggal</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Lemari</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Rak</th>
                            </tr>
                            <tr>
                                <th class="border px-6 py-4 text-right">Barcode</th>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection