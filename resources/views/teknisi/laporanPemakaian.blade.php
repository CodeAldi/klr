@extends('layouts.main')
@section('content')
    <div class="container mt-2">
        <div class="card">
            <h5 class="card-header">Tabel Data Komputer</h5>
            <div class="table-responsive text-nowrap">
                <table class="table" id="dataLabor">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>Nama peminjam</th>
                            <th>Nama komputer</th>
                            <th>mulai</th>
                            <th>selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->komputer->nama }}</td>
                            <td>{{ date('H:i:s', strtotime($item->start)) }} WIB</td>
                            <td>{{ date('H:i:s', strtotime($item->end)) }} WIB</td>
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
@endsection