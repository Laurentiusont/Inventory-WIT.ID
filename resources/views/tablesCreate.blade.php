@extends('layouts.user_type.auth')


@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Data Karyawan</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <form action="{{ route('storeDatakaryawan')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nama_karyawan">Nama Karyawan</label>
                        <input type="text" id="nama_karyawan" name="nama_karyawan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                            <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required >   
                     </div>
                    </div>
                    <div class="form-group">
                        <label for="telepon">Phone</label>
                        <input type="text" id="telepon" name="telepon" class="form-control" required >   
                     </div>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" class="form-control" required >   
                     </div>
                     <div class="form-group">
                        <label for="divisi">Divisi</label>
                        <input type="text" id="divisi" name="divisi" class="form-control" required >   
                     </div>
                     <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" required >   
                     </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('tables')}}" class="btn btn-outline-secondary mr-2" role="button">Cancel</a>
                        <button type="submit" class="btn btn-primary " >Save</button>
                        
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
<!-- /.content -->
@endsection