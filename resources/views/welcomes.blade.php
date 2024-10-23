@extends('layouts.template')

@section('content')

<div class="container">
    <div class="row my-5">
        <!-- Company Introduction Section -->
        <div class="col-md-6">
            <h1 class="display-4">Selamat Datang di Flower Blooms</h1>
            <p class="lead">Flower Blooms adalah toko perhiasan yang menawarkan koleksi perhiasan eksklusif dengan desain yang elegan dan berkualitas tinggi. Kami menghadirkan keindahan dalam setiap detail, dari cincin, kalung, gelang, hingga anting-anting, yang dibuat dengan dedikasi dan keahlian.</p>
        </div>
        <div class="col-md-6">
            <!-- Image for Company Profile with smaller size -->
            <img src="{{ asset('image/company_profile.jpg') }}" class="img-fluid rounded" alt="Gambar Toko Perhiasan" style="max-width: 300px; height: auto;">
        </div>
    </div>

    <!-- Services Section -->
    <div class="row text-center my-5">
        <div class="col-md-4">
            <img src="{{ asset('image/service1.jpg') }}" class="img-fluid rounded-circle mb-3" alt="Cincin" style="max-width: 150px; height: auto;">
            <h3>Cincin Eksklusif</h3>
            <p>Kami menawarkan cincin dengan desain yang mewah dan penuh makna, sempurna untuk momen spesial Anda.</p>
        </div>
        <div class="col-md-4">
            <img src="{{ asset('image/service2.jpg') }}" class="img-fluid rounded-circle mb-3" alt="Kalung" style="max-width: 150px; height: auto;">
            <h3>Kalung Mewah</h3>
            <p>Koleksi kalung kami dirancang dengan detail yang memikat dan bahan-bahan berkualitas tinggi.</p>
        </div>
        <div class="col-md-4">
            <img src="{{ asset('image/service3.jpg') }}" class="img-fluid rounded-circle mb-3" alt="Anting-anting" style="max-width: 150px; height: auto;">
            <h3>Anting Cantik</h3>
            <p>Kami menghadirkan anting-anting elegan yang dapat mempercantik penampilan Anda di berbagai kesempatan.</p>
        </div>
    </div>

</div>

@endsection
