@extends('layouts.main')
@section('content')
    <div class="container mt-2">
        <div class="card">
            <div class="card-header row">
                <h5 class="card-title col-8 mt-3">
                    Laporan Pemakaian Komputer
                </h5>
                <button type="button" class="btn btn-primary col-4 " data-bs-toggle="modal" data-bs-target="#modalCreate">
                    <i class="tf-icons bx bx-spreadsheet"></i>
                    Download
                </button>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table" id="dataPemakaianLabor">
                    <thead>
                        <tr>
                            <th>no</th>
                            <th>Nama peminjam</th>
                            <th>Nama komputer</th>
                            <th>mulai</th>
                            <th>selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->komputer->nama }}</td>
                            <td>{{ date('H:i:s', strtotime($item->start)) }} WIB, {{ date('d-m-Y', strtotime($item->start)) }}</td>
                            <td>{{ date('H:i:s', strtotime($item->end)) }} WIB, {{ date('d-m-Y', strtotime($item->end)) }}</td>
                            
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @push('page-js')
    <script type="text/javascript">
        let table = new DataTable('#dataPemakaianLabor', {
                        // options
                        });
    </script>
    @endpush
@endsection