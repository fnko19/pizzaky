@extends('layouts.app')

@section('content')
<div class="container-fluid bg-gray-50 px-0 pb-40">

    <img src="{{ asset('images/pro.png') }}" alt="Promo" class="w-full pt-16 pb-12 d-block">

    <div class="container pt-3">
    <h1 class="pb-8 text-3xl text-red-600 font-bold">Menu</h1>
        <h2 class="pb-8 text-xl font-bold">Pizza Pilihan rasa</h2>
        <div class="row">
            @foreach($menus as $menu)
            <div class="col-md-2 d-flex pb-2">
                <div class="card h-100 w-70 shadow-md">
                    <img src="{{ Storage::url($menu->image_path) }}" class="card-img-top w-[320px] h-[200px] object-cover img-fluid" alt="{{ $menu->nama_pizza }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title font-bold">{{ $menu->nama_pizza }}</h5>
                        <p class="card-text flex-grow-1 text-sm text-gray-500 pb-3">{{ $menu->deskripsi_singkat }}</p>
                        <a href="{{ route('detail', ['id' => $menu->id]) }}" class="btn bg-red-700 font-bold text-white hover:bg-red-500 mt-auto">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <h2 class="pb-8 pt-16 text-xl font-bold">Pizza Panjang</h2>
        <div class="row">
            @foreach($panjangs as $panjang)
            <div class="col-md-2 d-flex pb-2">
                <div class="card h-100 w-70 shadow-md">
                    <img src="{{ Storage::url($panjang->image_path) }}" class="card-img-top w-[320px] h-[200px] object-cover img-fluid" alt="{{ $panjang->nama_pizza}}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title font-bold">{{ $panjang->nama_pizza }}</h5>
                        <p class="card-text flex-grow-1 text-sm text-gray-500 pb-3">{{ $panjang->desc_singkat }}</p>
                        <a href="{{ route('pizzapanjang.detail', ['id' => $panjang->id]) }}" class="btn bg-red-700 font-bold text-white hover:bg-red-500 mt-auto">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <h2 class="pb-8 pt-16 text-xl font-bold">Menu Lain</h2>
        <div class="row">
            @foreach($lains as $lain)
            <div class="col-md-2 d-flex pb-2">
                <div class="card h-100 w-70 shadow-md">
                    <img src="{{ Storage::url($lain->image_path) }}" class="card-img-top w-[320px] h-[200px] object-cover img-fluid" alt="{{ $lain->nama_makanan }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title font-bold">{{ $lain->nama_makanan }}</h5>
                        <p class="card-text flex-grow-1 text-gray-500 text-sm pb-3">{{ $lain->deskripsi_singkatt }}</p>
                        <a href="{{ route('makananlain.detail', ['id' => $lain->id]) }}" class="btn bg-red-700 font-bold text-white hover:bg-red-500 mt-auto">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
