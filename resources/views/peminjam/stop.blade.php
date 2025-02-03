@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                @if (count($catatan) > 0)
                    <p>waktu mulai : {{ date('H:i:s', strtotime($catatan[0]->start)) }} WIB</p>
                    <form action="{{ route('peminjam.stop') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $catatan[0]->id }}">
                        <label for="stop">waktu selesai :</label>
                        <button class="btn-sm btn-primary"><i class='bx bx-stop-circle'></i>Selesai</button>
                    </form>
                @else
                <p class="card-text">belum ada catatan hari ini, silahkan pilih Laboratorium dan dilanjutkan memilih komputer untuk memulai pencatatan</p>
                @endif
            </div>
        </div>
    </div>
@endsection