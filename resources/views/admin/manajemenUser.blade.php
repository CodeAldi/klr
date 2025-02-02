@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header row">
                <h5 class="card-title col-8 mt-3">
                    Manajemen User
                </h5>
                <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#modalCreate">
                    <i class="tf-icons bx bx-plus-circle"></i>
                    Tambah User
                </button>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="card">
            <h5 class="card-header">Tabel Data User</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="dataUsers">
                    <thead>
                        <tr>
                            <th>nama</th>
                            <th>email</th>
                            <th>role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($users as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->role }}</td>
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
                                        <button class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit" data-index="{{ $item }}"
                                            onclick="modalEdit(this)"><i class="bx bx-edit-alt me-1"></i>
                                            Edit</button>
                                        <form action="{{ route('admin.manajemenUser.destroy',['user'=>$item]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item"><i
                                                    class="bx bx-trash me-1"></i>
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
            <form class="modal-content" action="{{ route('admin.manajemenUser.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateTitle">Tambah data user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" class="form-control" name="name"
                                placeholder="masukan nama user" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="email" class="form-label">email</label>
                            <input type="email" id="email" class="form-control" name="email"
                                placeholder="masukan alamat email user" required />
                            <span class="form-text">email harus unik & tidak boleh sama dengan email yang lain</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="password" class="form-label">password</label>
                            <input type="text" id="password" class="form-control" name="password"
                                placeholder="masukan passowrd" required />
                            <span class="form-text">min 8 character</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select">
                                <option value="">Pilih Role User</option>
                                @forelse ($roles as $item)
                                    <option value="{{ $item->value }}">{{ $item->value }}</option>
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
    {{-- modal untuk edit --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content" action="{{ route('admin.manajemenUser.update') }}" method="POST" id="formEdit">
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
                            <label for="Name" class="form-label">Nama</label>
                            <input type="text" id="EditName" class="form-control" name="name" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="EditEmail" class="form-control" name="email" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="Editrole" class="form-select">
                                <option value="">Pilih Role User</option>
                                @forelse ($roles as $item)
                                <option value="{{ $item->value }}">{{ $item->value }}</option>
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
        let table = new DataTable('#dataUsers', {
                    // options
                    });
                function modalEdit(item) {
                    let indexnya = item.getAttribute("data-index");
                    const myjson = JSON.parse(indexnya);
                    document.getElementById("EditName").value = myjson.name;
                    document.getElementById("EditEmail").value = myjson.email;
                    document.getElementById("Editrole").value = myjson.role;
                    document.getElementById("Editid").value = myjson.id;
                    console.log(myjson);
                    
                }
    </script>
    @endpush
@endsection