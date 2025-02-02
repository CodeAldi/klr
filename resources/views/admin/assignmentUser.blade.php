@extends('layouts.main')
@section('content')
    <div class="container mt-2">
        <div class="card">
            <div class="card-header row">
                <h5 class="card-title col-8 mt-3">
                    Assignment Staff Labor Komputer
                </h5>
                <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
                    <i class="tf-icons bx bx-plus-circle"></i>
                    Assignment
                </button>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="card">
            <h5 class="card-header">Tabel Data Staff Labor Komputer</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="dataAssignment">
                    <thead>
                        <tr>
                            <th>Nama Lab</th>
                            <th>Kepala Lab</th>
                            <th>Teknisi Lab</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assignment as $item)
                        <tr>
                            <td>{{ $item[0]->labkom->namaLab}}</td>
                            @forelse ($item as $data)
                            <td>{{ $data->user->name }}</td>
                            @empty
                            
                            @endforelse
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        {{-- <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                            data-index="{{ $item }}" onclick="modalEdit(this)"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</button> --}}
                                        <form action="{{ route('admin.assignmentUser.destroy',['id'=>$item[0]->labkom->id]) }}"
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
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- modal untuk create --}}
    <div class="modal fade" id="modalCreate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" action="{{ route('admin.assignmentUser.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateTitle">Assign staff labor komputer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="kalab" class="form-label">Pilih Kepala labor</label>
                            <select name="kalab" id="kalab" class="form-select">
                                <option value="">Pilih Kepala Labor</option>
                                @forelse ($kalab as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty
                    
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="teknisi" class="form-label">Pilih Teknisi labor</label>
                            <select name="teknisi" id="teknisi" class="form-select">
                                <option value="">Pilih Teknisi</option>
                                @forelse ($teknisi as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @empty
                    
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="labor" class="form-label">Pilih Labor</label>
                            <select name="labor" id="labor" class="form-select">
                                <option value="">Pilih Labor</option>
                                @forelse ($labor as $item)
                                <option value="{{ $item->id }}">{{ $item->namaLab }}</option>
                                @empty
                    
                                @endforelse
                            </select>
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
        let table = new DataTable('#dataAssignment', {
                        // options
                        });
    </script>
    @endpush
@endsection