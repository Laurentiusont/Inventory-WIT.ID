@extends('layouts.user_type.auth')


@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Create Office Data </h6>
                        </div>
                        <div class="card-body px-4 pt-4 pb-2">
                            <form id="office-form" action="{{ route('storeKantor') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <input type="text" id="kota" name="kota" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" id="telepon" name="telepon" class="form-control" required>
                                </div>
                                <br>
                                <div class="text-right">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('kantor') }}"
                                            class="btn btn-outline-secondary mr-2 gender-heading" role="button">Cancel</a>
                                        <button type="submit" class="btn btn-primary " id="save-button">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
    <!-- /.content -->
    document.getElementById('save-button').addEventListener('click', function() {
        // Dapatkan nilai dari input yang perlu divalidasi
        var kota = document.getElementById('kota').value;
    
        // Validasi: Periksa apakah field kota tidak kosong
        if (kota.trim() === '') {
            // Jika field kosong, tampilkan SweetAlert error
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all the required fields!',
            });
        } else {
            // Jika field terisi, simulasikan pengiriman data ke server
            // Tampilkan SweetAlert sukses setelah pengiriman data berhasil
            Swal.fire({
                position: "top-center",
                icon: "success",
                title: "Your work has been saved",
                showConfirmButton: false,
                timer: 3000
            });
    
            // Submit formulir setelah SweetAlert ditutup
            document.getElementById('office-form').submit();
        }
    });
</script>    
@endsection
