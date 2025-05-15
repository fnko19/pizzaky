@extends('layouts.app')

@section('content')

<section class="w-full mt-16 bg-cover bg-center min-h-[88vh] flex items-center" style="background-image: url('{{ asset('images/home.png') }}');">
    <div class="container mx-auto flex items-end justify-end">
        <div class="w-1/2">
            <h1 class="pl-2 text-6xl font-bold text-gray-900">Fresh dari Oven, <br> <span class="text-yellow-500 mt-4">Lezat di Setiap Gigitan!</span></h1>
            @auth
            <div class="container mx-auto">
                <p class="mt-4 text-lg font-semibold text-gray-600">Pizza selalu hangat, dipanggang saat dipesan dengan topping melimpah, keju meleleh, dan rasa autentik!</p>
                <a href="{{ route('menu') }}" class="mt-6 inline-block bg-red-500 text-white px-4 py-2 rounded-lg text-lg font-bold">Pesan Sekarang</a>
            </div>
            @else
            <div class="container mx-auto">
                <p class="mt-4 text-lg font-semibold text-gray-600">Masuk sekarang untuk nikmati PizZaky!!</p>
                <a href="{{ route('login') }}" class="mt-6 inline-block bg-red-500 text-white px-4 py-2 rounded-lg text-lg font-bold">Masuk Sekarang</a>
            </div>
            @endauth
      </div>

        </div>
    </div>
</section>

<!-- Menu Favorit -->
<section class="bg-red-700 py-16 min-h-[60vh]">
    <div class="container mx-auto px-4">
        @if($rasas->count())
            @foreach ($rasas as $bulan => $menuList)
                <div class="mb-12">
                    <h2 class="text-3xl text-yellow-300 font-bold">Rasa Favorit Bulan {{ $bulan }}</h2>
                    <p class="text-white text-lg font-semibold mt-2">Pilihan paling banyak dipesan dan dijamin enak!</p>

                    <div class="grid grid-cols-5 gap-6 mt-12">
                        @foreach ($menuList as $rasa)         
                            <div class="bg-white rounded-lg p-4 shadow-lg">
                                <img src="{{ Storage::url($rasa->image_path) }}" alt="{{ $rasa->nama_rasa }}" class="rounded-lg w-full h-48 object-cover">
                                <h3 class="text-xl text-center font-bold pt-4 text-red-700">{{ $rasa->nama_rasa }}</h3>
                                <p class="text-sm text-center pt-2 text-gray-700">{{ $rasa->desc_singkat }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-white text-center">Belum ada data rasa favorit yang tersedia.</p>
        @endif
    </div>
</section>

<!-- Alamat Kami -->
<section class="py-16" style="background-image: url('{{ asset('images/alamat.png') }}'); background-size: 100% 100%;">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div class="flex flex-col space-y-4">
            <h2 class="text-3xl font-bold text-red-700">Alamat Kami</h2>
            <div class="map-container w-full max-w-2xl shadow-xl">
                <iframe 
                    frameborder="0" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d993.4949792438238!2d119.51655560000003!3d-5.106937500000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefbd60ba70ecb%3A0x7b9413253a7ec7c4!2spizZaky!5e0!3m2!1sid!2sid!4v1742307203582!5m2!1sid!2sid" 
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen=""
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <div class="flex flex-col items-start space-y-8">
            <p class="text-lg flex items-center">
                <img src="{{ asset('images/clock.png') }}" alt="Jam" class="w-8 h-8 mr-2"> 
                <strong>Jam Buka : </strong>&nbsp; 08:00 - 22:00
            </p>
            <p class="text-lg flex items-center">
                <img src="{{ asset('images/phone.png') }}" alt="Telepon" class="w-8 h-8 mr-2"> 
                <strong>Telp : </strong>&nbsp; 0877 7543 3492
            </p>
        </div>
    </div>
</section>

<!-- Tentang PizZaky -->
<section class="bg-gray-100 py-8">
    <div class="container mx-auto flex items-center ">
        <div class="w-1/2">
            <img src="{{ asset('images/about.png') }}" alt="Tentang Pizza" class="w-full rounded-lg">
        </div>
        <div class="w-1/2 py-6 px-20">
            <h2 class="text-3xl font-bold text-red-700">Tentang PizZaky</h2>
            <p class="mt-4 text-lg">PizZaky adalah usaha pizza rumahan yang menghadirkan kelezatan dalam setiap gigitan. Dibuat dengan resep spesial, bahan berkualitas, dan selalu fresh saat dipesan.</p>
            <p class="mt-3 text-lg">Selain bisa mengambil langsung di tempat, kami juga menyediakan layanan antar agar Anda bisa menikmati pizza tanpa harus keluar rumah</p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20">
    <div class="container mx-auto flex items-center justify-between">
        <div class="py-6">
            <h2 class="text-3xl text-center font-bold text-red-700">Pesan sekarang dan nikmati pizza hangat kapan saja! 🍕</h2>
        </div>
        <div class="flex justify-end">
            <img src="{{ asset('images/cta.jpg') }}" class="w-[600px] shadow-md">
        </div>
    </div>
</section>

<section class="bg-red-700 py-20 text-white">
  <h3 class="font-bold text-3xl text-center pb-12">Apa Kata Mereka Tentang PizZaky</h3>

  <div class="flex justify-center items-center gap-4">
    <!-- Tombol Prev -->
    <button onclick="prevTestimonial()" class="bg-yellow-300 hover:bg-yellow-400 text-white p-3 rounded-full shadow-md transition-all duration-300 ml-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M15 19l-7-7 7-7" />
      </svg>
    </button>

    <!-- Testimonial container -->
    <div id="testimonial-container" class="flex items-center gap-6 overflow-hidden"></div>

    <!-- Tombol Next -->
    <button onclick="nextTestimonial()" class="bg-yellow-300 hover:bg-yellow-400 text-white p-3 rounded-full shadow-md transition-all duration-300 mr-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>
</section>

@endsection

<script id="testimonials-data" type="application/json">
  {!! $feedbacks
      ->map(function($f){
        return [
          'quote'  => $f->isi,
          'name'   => $f->user->name,
          'avatar' => $f->user->foto
              ? asset("storage/{$f->user->foto}")
              : asset("images/default.png"),
        ];
      })
      ->toJson() !!}
</script>

<script>
  const testimonials = JSON.parse(
    document.getElementById('testimonials-data').textContent
  );
  const quoteImageUrl = "{{ asset('images/quote.jpg') }}";

  let current = 0;
  function renderTestimonials() {
    const container = document.getElementById("testimonial-container");
    container.innerHTML = "";
    const visibleCount = 3;
    const start = current;
    const end   = Math.min(current + visibleCount, testimonials.length);

    for (let i = current; i < end; i++) {
        const { quote, name, avatar } = testimonials[i];
        const el = document.createElement("div");
        el.className = "bg-white rounded-xl shadow-lg p-4 w-80 mx-2 flex flex-col justify-between h-[220px]";

        el.innerHTML = `
          <img src="/images/quote.png" alt="Quote icon" class="w-8 h-8 justify-start" />
          <p class="text-gray-800 text-center text-lg italic pb-4">${quote}</p>
          <div class="flex rounded-xl justify-center items-center space-x-4">
            <img src="${avatar}" alt="${name}" class="w-10 h-10 rounded-full border-2 border-yellow-400 shadow-md" />
            <p class="text-sm text-gray-900 items-center">${name}</p>
          </div>
        `;
      container.appendChild(el);
    }
  }

  function nextTestimonial() {
    current = (current + 1) % testimonials.length;
    renderTestimonials();
  }
  function prevTestimonial() {
    current = (current - 1 + testimonials.length) % testimonials.length;
    renderTestimonials();
  }

  document.addEventListener("DOMContentLoaded", () => {
    renderTestimonials();
    setInterval(nextTestimonial, 1500);
  });
</script>
