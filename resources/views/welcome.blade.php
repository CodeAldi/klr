@extends('layouts.main')
@section('content')
@if (Auth()->user()->hasRole('Peminjam'))
<div class="container">
    <div class="card">
        <h5 class="card-header">Pilih Laboratorium Komputer</h5>
        <div class="card-body">
            <form action="{{ route('peminjam.pilihLabor') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-10"><select name="labor" id="labor" class="form-select">
                            <option value="$">Pilih Labor</option>
                            @forelse ($labor as $item)
                            <option value="{{ $item->id }}">{{ $item->namaLab }}</option>
                            @empty

                            @endforelse
                        </select></div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Pilih</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@elseif(Auth()->user()->hasRole('Teknisi LabKom'))
<div class="container mt-2">
    <div class="card">
        <h5 class="card-header">Selamat datang, {{ Auth()->user()->name }},<br>Teknisi Labor : {{ Auth()->user()->Assignment[0]->labkom->namaLab }}</h5>
    </div>
</div>
@elseif(Auth()->user()->hasRole('Kepala LabKom'))
<div class="container mt-2">
    <div class="card">
        <h5 class="card-header">Selamat datang, {{ Auth()->user()->name }},<br>kepala labor : {{ Auth()->user()->Assignment[0]->labkom->namaLab }}</h5>
        
    </div>
</div>
@elseif(Auth()->user()->hasRole('admin'))
@else

@endif
@endsection