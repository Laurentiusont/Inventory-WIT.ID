@extends('layouts.user_type.auth')


@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Edit Category Data</h6>
                        </div>
                        <div class="card-body px-4 pt-4 pb-2">
                            <form id="saveForm" action="{{ route('updateKantor', ['kantor' => $kantor->id_kantor]) }}"
                                method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="id_kantor">Id Kantor</label>
                                    <input type="text" id="id_kantor" name="id_kantor" class="form-control" required
                                        value="{{ $kantor->id_kantor }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="kota">Kota</label>
                                    <input type="text" id="kota" name="kota" class="form-control" required
                                        value="{{ $kantor->kota }}">
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan">Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control" required
                                        value="{{ $kantor->kecamatan }}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control" required
                                        value="{{ $kantor->alamat }}">
                                </div>
                                <div class="form-group">
                                    <label for="telepon">Telepon</label>
                                    <input type="text" id="telepon" name="telepon" class="form-control" required
                                        value="{{ $kantor->telepon }}">
                                </div>
                                <br>
                                <div class="text-right">
                                    <div class="d-flex justify-content-end">
                                    <a href="{{ route('kantor') }}" class="btn btn-outline-secondary mr-2 gender-heading"
                                        role="button">Cancel</a>
                                    <button type="button" class="btn btn-primary" id="saveButton">Save</button>
                                </div>
                                </div>
                                </br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- /.content -->
    <script>
        document.getElementById('saveButton').addEventListener('click', function() {
            Swal.fire({
                title: "Do you want to save the changes?",
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: "Don't save"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Tampilkan SweetAlert "Saved!" sebelum melanjutkan proses simpan
                    Swal.fire("Saved!", "", "success");
                    // Submit formulir setelah SweetAlert muncul
                    document.getElementById('saveForm').submit();
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
            });
        });
    </script>
@endsection
