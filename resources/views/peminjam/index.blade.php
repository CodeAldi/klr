@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="card">
            <h5 class="card-header">Mulai pencatatan</h5>
            <div class="card-body">
                @if (count($komputer)>0)
                <form action="{{ route('peminjam.mulai') }}" method="post" enctype="multipart/form-data">
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
                    <div class="row my-2 justify-content-md-center">
                        <button id="capture" type="button" class="btn btn-warning d-grid w-75"><i class='bx bx-camera'></i> Ambil
                        foto</button>
                    </div>
                    <div class="row mb-3">
                        <label for="video1" class="col-6">Ambil foto wajah :</label>
                        <label for="canvas1" class="col-6">Preview:</label>
                    </div>
                    <div class="row mb-3 gx-2">
                        <video id="video1" autoplay class="rounded w-50 col-4"></video>
                        <canvas id="canvas1" class="rounded w-50 col-4"></canvas>
                    </div>
                    <input type="file" name="wajah" id="wajah" accept="image/*" hidden>
                    
                </form>
                @else
                <p class="card-text">Silahkan pilih labor terlebih dahulu di halaman home</p>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('page-js')
<script>
    const video = document.getElementById('video1');
            const canvas = document.getElementById('canvas1');
            const context = canvas.getContext('2d');
            const captureButton = document.getElementById('capture');
            const wajah = document.getElementById('wajah');
    
            // Akses kamera
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    video.srcObject = stream;
                })
                .catch(function (error) {
                    console.log("Gagal mengakses kamera: ", error);
                });
    
            // Ambil gambar dari video
            captureButton.addEventListener('click', function () {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                // photo.src = canvas.toDataURL('image/png'); 
                canvas.toBlob(blob => {
                const file = new File([blob], "captured_image.png", { type: "image/png" });
                
                // Masukkan file ke input type file
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                wajah.files = dataTransfer.files;
                
                }, "image/png");

            });
</script>
@endpush