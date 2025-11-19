<footer class="bg-green-900 text-white py-8">
    <div class="container mx-auto px-6 lg:px-8 text-center md:text-left">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-lg font-semibold mb-3">Kontak Kami</h3>
                <p class="text-sm text-green-200 mb-1">PMB Online © MISBAHUNNUR CIMAHI</p>
                <p class="text-sm text-green-200">
                    Jl. Kolonel Masturi No. 139 Cipageran<br>
                    Kec Cimahi Utara, Cimahi 40511
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Info Lebih Lanjut</h3>
                <p class="text-sm text-green-200 mb-1">
                    <span class="font-medium">Telepon:</span>
                    <a href="tel:0226632371" class="hover:text-green-100">(022) 6632371</a>
                </p>
                <p class="text-sm text-green-200 mb-1">
                    <span class="font-medium">Email:</span>
                    <a href="mailto:humasmisbahunnur@gmail.com"
                        class="hover:text-green-100">humasmisbahunnur@gmail.com</a>
                </p>
                <p class="text-sm text-green-200">
                    <span class="font-medium">Website:</span>
                    <a href="https://misbahunnur.ponpes.id/" target="_blank" rel="noopener noreferrer"
                        class="hover:text-green-100">misbahunnur.ponpes.id</a>
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-3">Tautan Cepat</h3>
                <ul class="space-y-1 text-sm">
                    <li><a href="{{ url('/') }}" class="text-green-200 hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('student.login') }}" class="text-green-200 hover:text-white">Login Siswa</a>
                    </li>
                </ul>
            </div>

        </div>
        <div id="kontak" class="border-t border-green-700 mt-8 pt-6 text-center text-sm text-green-300">
            <p>&copy; {{ date('Y') }} PPDB Misbahunnur Cimahi. All rights reserved.</p>
        </div>
    </div>
</footer>