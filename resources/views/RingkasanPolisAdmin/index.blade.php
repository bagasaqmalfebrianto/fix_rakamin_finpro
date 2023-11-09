@extends('layout.main')

@section('title', 'Ringkasan Polis')

@section('css')
    <!-- Custom styles for this template tabel -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/rpolis.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
@endsection

@section('isi')
<div id="isi">
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-chevron-circle-up float-right" style="color: black;"></i></button>

    </div>

    <!-- Tabel Data Polis -->
    <div class="line"></div>

    <div id="page-top">
        <div id="wrapper">
            <div class="container-fluid">
                          <!-- DataTales Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h5 class="m-0" style="color: black;font-weight: bold;">Data Polis</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table-sm table-bordered table-striped text-center table-hover" id="dataTable" width="100%" cellspacing="0">
                      <thead class="bg-warning">
                        <tr>
                            <th>No.</th>
                            <th>Nomor Polis</th>
                            <th>Nama</th>
                            <th>Jumlah Asuransi</th>
                            <th>Alamat Email</th>
                            <th>Status Polis</th>
                            <th>Detail Polis</th>
                            <th>Ubah Data</th>
                            <th>Tambah Asuransi</th>
                            <th></th>
                        </tr>
                      </thead>
                      <tbody class="bg-light">
                        @foreach ($data_user as $data )


                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $data->no_polis }}</td>
                          <td>{{ $data->nama_lengkap }}</td>
                          <td>{{ $jumlahDataProfilPolis[$data->id]}}</td>
                          <td>{{ $data->email }}</td>
                          <td>
                              <div class="badge badge-success text-body text-wrap" style="width: 6rem;">active</div>
                          </td>
                          <td><button type="button" class="btn btn-warning btn-sm font-weight-bold" data-toggle="modal" data-target="#datapolis">Detail</button></td>

                          <td><a href="RingkasanPolisAdmin/{{ $data->id }}/edit" class="btn btn-warning btn-sm font-weight-bold" >Ubah Data</a></td>
                          <td><a href="{{ url('RingkasanPolisAdmin/TambahPengguna', ['id' => $data->id]) }}" class="btn btn-warning btn-sm font-weight-bold" >Tambah Asuransi</a></td>
                          <td><a class="btn btn-warning btn-sm font-weight-bold" role="button" href="Premi">Bayar</a></td>
                        </tr>
                        @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>

        </div>
    </div>
@endsection

@section('JS')
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endsection
