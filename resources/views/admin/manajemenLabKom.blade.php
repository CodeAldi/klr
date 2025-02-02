@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header row">
                <h5 class="card-title col-8 mt-3">
                    Manajemen Labor Komputer
                </h5>
                <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
                    <i class="tf-icons bx bx-plus-circle"></i>
                    Tambah Labor
                </button>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="card">
            <h5 class="card-header">Tabel Data Labor Komputer</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="dataLabor">
                    <thead>
                        <tr>
                            <th>Kode Lab</th>
                            <th>Nama Lab</th>
                            <th>Lokasi Lab</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($labkom as $item)
                        <tr>
                            <td>{{ $item->kodeLab }}</td>
                            <td>{{ $item->namaLab }}</td>
                            <td>{{ $item->lokasiLab }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        {{-- <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalShow"><i class="bx bx-show-alt me-1"></i>
                                            Lihat</button> --}}
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit" data-index="{{ $item }}" onclick="modalEdit(this)"><i class="bx bx-edit-alt me-1"></i>
                                            Edit</button>
                                            <form action="{{ route('admin.labkom.destroy',['laborkom'=>$item]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item"><i class="bx bx-trash me-1"></i>
                                                Delete</button>
                                            </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        {{-- <tr>
                            <td colspan="5" class="bg-warning text-white text-center">Data Masih Kosong!</td>
                        </tr> --}}
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- modal untuk create --}}
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" action="{{ route('admin.labkom.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateTitle">Tambah data labor komputer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="kodeLab" class="form-label">Kode Lab</label>
                            <input type="text" id="kodeLab" class="form-control" name="kodeLab"
                                placeholder="masukan kode lab" required />
                                <span class="form-text">kode lab harus unik & tidak boleh sama dengan kode lab yang lain</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="namaLab" class="form-label">Nama Lab</label>
                            <input type="text" id="namaLab" class="form-control" name="namaLab"
                                placeholder="masukan nama lab" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="lokasiLab" class="form-label">Lokasi Lab</label>
                            <input type="text" id="lokasiLab" class="form-control" name="lokasiLab"
                                placeholder="masukan lokasi lab" required />
                        </div>
                    </div>
                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- modal untuk edit --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" action="{{ route('admin.labkom.update') }}" method="POST" id="formEdit">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Edit data labor komputer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <input type="hidden" name="id" id="Editid" readonly>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="kodeLab" class="form-label">Kode Lab</label>
                            <input type="text" id="EditkodeLab" class="form-control" name="kodeLab"
                                placeholder="masukan kode lab" required />
                            <span class="form-text">kode lab harus unik & tidak boleh sama dengan kode lab yang lain</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="namaLab" class="form-label">Nama Lab</label>
                            <input type="text" id="EditnamaLab" class="form-control" name="namaLab"
                                placeholder="masukan nama lab" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="lokasiLab" class="form-label">Lokasi Lab</label>
                            <input type="text" id="EditlokasiLab" class="form-control" name="lokasiLab"
                                placeholder="masukan lokasi lab" required />
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('page-js')
        <script type="text/javascript">
            let table = new DataTable('#dataLabor', {
                // options
                });
            function modalEdit(item) {
                let indexnya = item.getAttribute("data-index");
                const myjson = JSON.parse(indexnya);
                document.getElementById("EditkodeLab").value = myjson.kodeLab;
                document.getElementById("EditlokasiLab").value = myjson.lokasiLab;
                document.getElementById("EditnamaLab").value = myjson.namaLab;
                document.getElementById("Editid").value = myjson.id;
                console.log(myjson);
                
            }
        </script>
    @endpush
@endsection