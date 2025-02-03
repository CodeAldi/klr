@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header row">
                <h5 class="card-title col-8 mt-3">
                    Manajemen Komputer
                </h5>
                <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
                    <i class="tf-icons bx bx-plus-circle"></i>
                    Tambah Komputer
                </button>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="card">
            <h5 class="card-header">Tabel Data Komputer</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="dataLabor">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>Nama komputer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($komputer as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        {{-- <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalShow"><i class="bx bx-show-alt me-1"></i>
                                            Lihat</button> --}}
                                        <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                            data-index="{{ $item }}" onclick="modalEdit(this)"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</button>
                                        <form action="{{ route('teknisi.komputer.destroy',['komputer'=>$item]) }}"
                                            method="post">
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
            <form class="modal-content" action="{{ route('teknisi.komputer.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateTitle">Tambah data komputer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama komputer</label>
                            <input type="text" id="nama" class="form-control" name="nama"
                                placeholder="contoh : pc-7 i-71014 RTX-4060" required />
                            <span class="form-text">masukan nama komputer berdasarkan processor dan gpu</span>
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
            <form class="modal-content" action="{{ route('teknisi.komputer.update') }}" method="POST" id="formEdit">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditTitle">Edit data komputer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
    
                    <input type="hidden" name="id" id="Editid" readonly>
                    <div class="col mb-3">
                        <label for="Editnama" class="form-label">Nama komputer</label>
                        <input type="text" id="Editnama" class="form-control" name="nama" required />
                        <span class="form-text">masukan nama komputer berdasarkan processor dan gpu</span>
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
                    document.getElementById("Editnama").value = myjson.nama;
                    document.getElementById("Editid").value = myjson.id;
                    console.log(myjson);
                    
                }
    </script>
    @endpush
@endsection