@extends('superadmin.dashboard.layout.main')



@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Kriteria</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success col-lg-10" role="alert">
      {{ session('success') }}
    </div>
@endif

<div class="table-responsive col-lg-12 mb-5">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th rowspan="2" scope="col">No</th>
          <th rowspan="2" scope="col">Nama Karyawan</th>

          <th colspan="{{$criteria->count()}}" class="text-center">Skor</th>
        </tr>
        <tr>
            @foreach ($criteria as $c)
            <th scope="col">{{$c->name}}</th>
            @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach ($data['score'] as $d)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $d['name'] }}</td>
          @foreach ($d['plot'] as $plot)
            <td>{{ $plot->weight }}</td>
          @endforeach
        </tr>

        @endforeach
      </tbody>
    </table>
  </div>
  <h3>Hitung Vector S</h3>
  <div class="table-responsive col-lg-12 mb-5">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th rowspan="2" scope="col">No</th>
          <th rowspan="2" scope="col">Nama Karyawan</th>

          <th colspan="{{$criteria->count()}}" class="text-center">Skor</th>
          <th rowspan="2">Total</th>
        </tr>
        <tr>
            @foreach ($criteria as $c)
            <th scope="col">{{$c->name}}</th>
            @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach ($data['score'] as $index => $d)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $d['name'] }}</td>
          @foreach ($data['vectorS'][$index] as $plot)
            <td>{{ $plot }}</td>
          @endforeach
          <td>{{ array_sum($data['vectorS'][$index]) }}</td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
            <td class="text-right" colspan="{{$criteria->count() + 2}}"><b>Total</b></td>
            <td>{{ $data['total'] }}</td>
        </tr>
      </tfoot>
    </table>
  </div>
  <h3>Hitung Vector S</h3>
  <div class="table-responsive col-lg-12 mb-5">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th rowspan="2" scope="col">No</th>
          <th rowspan="2" scope="col">Nama Karyawan</th>
          <th>Nilai</th>
        </tr>

      </thead>
      <tbody>
        @foreach ($data['score'] as $index => $d)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $d['name'] }}</td>
          <td>{{ $data['vectorV'][$index] }}</td>
        </tr>
        @endforeach
      </tbody>

    </table>
  </div>
  <h3>Ranking</h3>
  <div class="table-responsive col-lg-12 mb-5">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th rowspan="2" scope="col">Ranking</th>
          <th rowspan="2" scope="col">Nama Karyawan</th>
          <th>Nilai</th>
        </tr>

      </thead>
      <tbody>
        @foreach ($data['rank'] as $index => $d)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $d['name'] }}</td>
          <td>{{ $d['value'] }}</td>
        </tr>
        @endforeach
      </tbody>

    </table>
  </div>
@endsection
