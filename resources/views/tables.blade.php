@extends('layouts.user_type.auth')

@section('content')

  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row align-items-center d-flex">
                <div class="col-md-9"><h6>Data Karyawan</h6></div>
                <div class="col-md-3"><a href="{{ route('createDatakaryawan') }}" class="btn btn-warning w-100" role="button">Tambah Data Karyawan</a>
                </div>
              </div>


            </div>
            <div class="card-body px-0 pt-0 pb-2">

              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Position</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Division</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Address</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($datakaryawans as $datakaryawan)
                            <tr style="font-size: 0.75em">
                                <td class="py-2">{{ $datakaryawan->id_karyawan  }}</td>
                                <td class="py-2">{{ $datakaryawan->nama_karyawan  }}</td>
                                <td class="py-2">{{ $datakaryawan->jenis_kelamin }}</td>
                                <td class="py-2">{{ $datakaryawan->email }}</td>
                                <td class="py-2">{{ $datakaryawan->telepon  }}</td>
                                <td class="py-2">{{ $datakaryawan->jabatan }}</td>
                                <td class="py-2">{{ $datakaryawan->divisi }}</td>
                                <td class="py-2">{{ $datakaryawan->alamat }}</td>
                                <td > <a href="{{ route('editDatakaryawan',['id' => $datakaryawan->id_karyawan]) }}" class="btn btn-outline-warning" role="button">Update</a></td >
                                <td > <a href="{{ route('deleteDatakaryawan',['id' => $datakaryawan->id_karyawan]) }}" class="btn btn-outline-danger" role="button">Delete</a> </td>
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
  </main>
  
  @endsection
