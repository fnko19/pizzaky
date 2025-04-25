@extends('layouts.app')



@php
    $menus = [
        ['image' => 'images/p1.png', 'name' => 'Tuna Melt'],
        ['image' => 'images/p2.jpg', 'name' => 'Pepperoni Feast'],
        ['image' => 'images/p3.jpg', 'name' => 'Veggie Supreme'],
        ['image' => 'images/p4.jpg', 'name' => 'Cheese Overload'],
        ['image' => 'images/p5.jpg', 'name' => 'BBQ Chicken']
    ];
@endphp
@section('content')
<section class="w-full mt-16 bg-cover bg-center min-h-[88vh] flex items-center" style="background-image: url('{{ asset('images/home.png') }}');">
    <div class="container mx-auto flex items-end justify-end">
        <div class="w-1/2">
            <h1 class="text-6xl font-bold text-gray-900">Fresh dari Oven, <br> <span class="text-yellow-500 mt-4">Lezat di Setiap Gigitan!</span></h1>
            <p class="mt-4 text-lg font-semibold text-gray-600">Pizza selalu hangat, dipanggang saat dipesan dengan topping melimpah, keju meleleh, dan rasa autentik!</p>
            <a href="{{ route('menu') }}" class="mt-6 inline-block bg-red-500 text-white px-6 py-2 rounded-lg text-lg font-bold">Pesan Sekarang</a>
        </div>
    </div>
</section>

<!-- Menu Favorit -->
<section class="bg-red-700 py-16 min-h-[60vh]">
    <div class="container mx-auto items-center justify-center">
        <h2 class="text-3xl text-yellow-300 font-bold">Menu Favorit</h2>
        <p class="text-white text-lg font-semibold mt-3">Pilihan paling banyak dipesan dan dijamin enak!</p>

        <div class="grid grid-cols-5 gap-6 mt-6">
            @foreach ($menus as $menu)
                <div class="bg-white rounded-lg p-4 shadow-lg">
                    <img src="{{ asset($menu['image']) }}" alt="{{ $menu['name'] }}" class="rounded-lg w-80">
                    <h3 class="text-xl text-center font-bold pt-4 text-red-700">{{ $menu['name'] }}</h3>
                </div>
            @endforeach
        </div>
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

<!-- Feedback Section -->
<section class="bg-red-700 py-20 text-white">
  <h3 class="font-bold text-3xl text-center pb-12">Apa Kata Mereka Tentang PizZaky</h3>

  <div class="flex justify-center items-center gap-4">
    
    <!-- Tombol Prev -->
    <button onclick="prevTestimonial()" class="bg-yellow-300 hover:bg-yellow-400 text-white p-3 rounded-full shadow-md transition-all duration-300 ml-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M15 19l-7-7 7-7" />
      </svg>
    </button>

    <!-- Testimonial container -->
    <div id="testimonial-container" class="flex items-center gap-6 overflow-hidden"></div>

    <!-- Tombol Next -->
    <button onclick="nextTestimonial()" class="bg-yellow-300 hover:bg-yellow-400 text-white p-3 rounded-full shadow-md transition-all duration-300 mr-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M9 5l7 7-7 7" />
      </svg>
    </button>
  </div>
</section>

@endsection

<script>
const testimonials = [
    { quote: "Bagus bagus", name: "Aidil", avatar: "/images/profile3.jpg" },
    { quote: "Bagi freebies dong hehee", name: "Pani tia", avatar: "/images/profile2.jpg" },
    { quote: "Websitenya lucu hehehe", name: "Shab", avatar: "/images/profile1.jpg" },
    { quote: "Pizzanya enak banget bosss, sayang jauh di Sudiang :G", name: "NanaMei", avatar: "/images/profile4.jpg" },
    { quote: "OMG", name: "Aidil", avatar: "/images/profile3.jpg" },
    { quote: "Bagus bagus keren omagah", name: "Pani tia", avatar: "/images/profile2.jpg" },
    { quote: "hehehe", name: "Shab", avatar: "/images/profile1.jpg" },
    { quote: "we love we live woilah", name: "NanaMei", avatar: "/images/profile4.jpg" }
];

let current = 0;

function renderTestimonials() {
    const container = document.getElementById('testimonial-container');
    container.innerHTML = '';

    const visibleCount = 3;
    const start = current;
    const end = Math.min(current + visibleCount, testimonials.length);

    for (let i = start; i < end; i++) {
        const testimonial = testimonials[i];
        const testimonialElement = document.createElement('div');

        testimonialElement.classList.add(
            'bg-white', 'p-6', 'rounded-xl', 'shadow-xl', 'w-80', 'mx-2',
            'transition-all', 'duration-300', 'h-[250px]', 'flex', 'flex-col', 'justify-between'
        );

        testimonialElement.innerHTML = `
            <p class="text-gray-700 text-center pt-8">"${testimonial.quote}"</p>
            <div class="flex flex-col items-center justify-center">
                <img src="${testimonial.avatar}" alt="${testimonial.name}" class="w-14 h-14 rounded-full mb-2">
                <p class="font-medium text-gray-800">${testimonial.name}</p>
            </div>
        `;

        container.appendChild(testimonialElement);
    }
}

function nextTestimonial() {
    const total = testimonials.length;
    current = (current + 1) % (total - 2); // Adjust the modulo to fit the range
    renderTestimonials();
}

function prevTestimonial() {
    const total = testimonials.length;
    current = (current - 1 + (total - 2)) % (total - 2); // Adjust the modulo to fit the range
    renderTestimonials();
}

document.addEventListener('DOMContentLoaded', () => {
    renderTestimonials();
    setInterval(() => {
        nextTestimonial();
    }, 3000);
});
</script>
