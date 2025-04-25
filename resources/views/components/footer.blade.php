<footer class="bg-gray-200 text-black pb-4 pt-8">
    <div class="container mx-auto flex justify-between items-start pr-6 pb-8">
        <div class="w-1/3 flex items-start space-x-4">
            <img src="{{ asset('images/logo.png') }}" alt="PizZaky Logo" class="w-20 h-20">
            <div>
                <h2 class="text-xl font-bold">PizZaky</h2>
                <p class="text-sm leading-relaxed">
                    Jl. Pajjaiang BTN H.Mustafa No.7 Blok F, Daya, <br>
                    Kec. Biringkanaya, Kota Makassar, Sulawesi Selatan 90242
                </p>
            </div>
        </div>

        <div class="w-2/3 flex justify-end space-x-20">
            <div>
                <h3 class="font-bold text-lg pb-2">Navigasi</h3>
                <ul class="text-sm space-y-2">
                    <li><a href="{{ route('home') }}" class="hover:underline">Beranda</a></li>
                    <li><a href="{{ route('menu') }}" class="hover:underline">Menu</a></li>
                    <li><a href="{{ route('pemesanan') }}" class="hover:underline">Keranjang</a></li>
                    <li><a href="{{ route('status_pesanan') }}" class="hover:underline">Pesanan</a></li>
                    <li><a href="{{ route('feedback') }}" class="hover:underline">Feedback</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg pb-2">Social Media</h3>
                <ul class="text-sm space-y-2">
                    <li><a href="https://wa.me/6287775433492" class="hover:underline">Whatsapp</a></li>
                    <li><a href="https://www.facebook.com/hikma.radhi" class="hover:underline">Facebook</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="border-t-2 border-gray-400 pt-4 mt-2 text-center text-sm">
        © Pizzaky Indonesia 2025. All Rights Reserved
    </div>
</footer>
