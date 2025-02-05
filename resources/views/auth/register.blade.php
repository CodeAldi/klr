@extends('layouts.auth')
@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register Card -->
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center">
                    
                </div>
                <!-- /Logo -->
                <h4 class="mb-2">Register here 🚀</h4>
                <p class="mb-4">Make your app management easy and fun!</p>

                <form id="formAuthentication" class="mb-3" action="{{ route('registeraction') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="name"
                            placeholder="Enter your username" autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="nomor_induk" class="form-label">Nomor induk mahasiswa / pegawai</label>
                        <input type="text" class="form-control" id="nomor_induk" name="nomor_induk"
                            placeholder="nomor induk mahasiswa atau pegawai" autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="cp" class="form-label">contact / no hp</label>
                        <input type="text" class="form-control" id="cp" name="cp"
                            placeholder="nomor hp atau wa" autofocus />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            placeholder="Enter your email" />
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="video">Ambil foto wajah :</label>
                        <video id="video" autoplay class="form-control"></video>

                    </div>
                    <div class="row mb-3">
                        <label for="canvas">Preview:</label>
                        <canvas id="canvas" class="form-control"></canvas>
                    </div>
                    <input type="file" name="wajah" id="wajah" accept="image/*" hidden>
                    <button id="capture" type="button" class="btn btn-warning d-grid w-100 mb-2"><i class='bx bx-camera'></i> Ambil foto</button>
                    <button class="btn btn-primary d-grid w-100">Sign up</button>
                </form>

                <p class="text-center">
                    <span>Already have an account?</span>
                    <a href="{{ route('login') }}">
                        <span>Sign in instead</span>
                    </a>
                </p>
            </div>
        </div>
        <!-- Register Card -->
    </div>
</div>
@endsection
@push('in-body')
    <script>
        const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
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