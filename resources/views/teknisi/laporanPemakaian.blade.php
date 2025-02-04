@extends('layouts.main')
@section('content')
    <div class="container mt-2">
        <div class="card">
            <h5 class="card-header">Tabel Data Komputer</h5>
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