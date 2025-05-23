<aside class="fixed top-0 left-0 z-40 w-56 h-screen pt-14 transition-transform -translate-x-full border-r border-gray-200 md:translate-x-0 bg-[#14487a]">
    <div class="overflow-y-auto py-6 px-4 h-full">
        <!-- Judul -->
        <h2 class="text-3xl font-extrabold text-center mb-8 text-yellow-400 drop-shadow-md tracking-wide animate-fade-in">
            Siakad MIS
        </h2>

        <!-- Profil Pengguna -->
        <div class="flex items-center space-x-4 px-2 mb-8">
            <img src="{{ asset('images/ikon_profile.png') }}" alt="Profile Image" class="w-16 h-16 rounded-full object-cover border-2 border-yellow-400">
            <div class="text-white font-semibold text-sm">
                {{ Auth::user()->name }}
            </div>
        </div>

        <!-- Navigasi Menu -->
        <ul class="space-y-3 text-sm">
            <li>
                <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center p-2 text-white rounded-md hover:bg-yellow-500 hover:text-black transition">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.frs.index') }}" class="flex items-center p-2 text-white rounded-md hover:bg-yellow-500 hover:text-black transition">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                    </svg>
                    FRS
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.jadwal.index') }}" class="flex items-center p-2 text-white rounded-md hover:bg-yellow-500 hover:text-black transition">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    Jadwal Kuliah
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.nilai.index') }}" class="flex items-center p-2 text-white rounded-md hover:bg-yellow-500 hover:text-black transition">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                    </svg>
                    Nilai
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('welcome') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center p-2 text-white rounded-md hover:bg-red-500 hover:text-white transition">
                        <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 11-2 0V5H5v10h10v-2a1 1 0 112 0v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm11.707 5.293a1 1 0 00-1.414 1.414L15.586 12H9a1 1 0 100 2h6.586l-2.293 2.293a1 1 0 101.414 1.414l4-4a1 1 0 000-1.414l-4-4z" clip-rule="evenodd" />
                        </svg>
                        Logout
                    </a>
                </form>
            </li>
        </ul>
    </div>
</aside>
