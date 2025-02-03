@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">Mulai pencatatan</h5>
            <div class="card-body">
                @if (count($komputer)>0)
                <form action="{{ route('peminjam.mulai') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-10"><select name="komputer" id="komputer" class="form-select">
                                <option value="$">Pilih Komputer</option>
                                @forelse ($komputer as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @empty
    
                                @endforelse
                            </select></div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary"><i class='bx bx-play-circle'></i> Mulai</button>
                        </div>
                    </div>
    
                </form>
                @else
                <p class="card-text">Silahkan pilih labor terlebih dahulu di halaman home</p>
                @endif
            </div>
        </div>
    </div>
@endsection