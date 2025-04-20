@extends('layouts.app')

@section('content')
<div class="container-fluid px-0 pb-40">

    <img src="{{ asset('images/pro.png') }}" alt="Promo" class="w-full pt-16 pb-12 d-block">

    <div class="container pt-5">
        <h2 class="pb-8 text-2xl text-red-600 font-bold">Menu</h2>
        <div class="row">
            @foreach($menus as $menu)
            <div class="col-md-2 d-flex pb-2">
                <div class="card h-100 w-70">
                    <img src="{{ Storage::url($menu->image_path) }}" class="card-img-top w-[320px] h-[200px] object-cover img-fluid" alt="{{ $menu->nama_pizza }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title font-bold">{{ $menu->nama_pizza }}</h5>
                        <p class="card-text flex-grow-1 text-sm pb-3">{{ $menu->deskripsi_singkat }}</p>
                        <a href="{{ route('detail', ['id' => $menu->id]) }}" class="btn bg-red-700 font-bold text-white hover:bg-red-500 mt-auto">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
