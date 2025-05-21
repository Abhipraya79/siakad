<aside class="fixed top-0 left-0 z-40 w-56 h-screen pt-14 transition-transform -translate-x-full bg-orange-60 border-r border-gray-200 md:translate-x-0">
    <div class="overflow-y-auto py-5 px-3 h-full bg-orange-60">
        <ul class="space-y-2">
            <div class="flex items-center space-x-3 px-3 mb-4">
                <img src="{{ asset('images/icon_profile.png') }}" alt="Profile Image" class="w-12 h-12 rounded-full object-cover">
                <div class="text-sm font-medium text-black-100">
                    {{ Auth::user()->dosen->nama ?? 'Dosen' }}
                </div>
            </div>

            <li>
                <a href="{{ route('dosen.dashboard') }}" class="nav-link">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('dosen.frs.index') }}" class="nav-link">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 4a1 1 0 011-1h6a1 1 0 010 2H7a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">ACC FRS</span>
                </a>
            </li>

            <li>
                <a href="{{ route('dosen.nilai.index') }}" class="nav-link">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Isi Nilai</span>
                </a>
            </li>

            <li>
                <a href="{{ route('dosen.jadwal.index') }}" class="nav-link">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Jadwal Mengajar</span>
                </a>
            </li>
            <li>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('welcome') }}"
           onclick="event.preventDefault(); this.closest('form').submit();"
           class="nav-link">
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 11-2 0V5H5v10h10v-2a1 1 0 112 0v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm11.707 5.293a1 1 0 00-1.414 1.414L15.586 12H9a1 1 0 100 2h6.586l-2.293 2.293a1 1 0 101.414 1.414l4-4a1 1 0 000-1.414l-4-4z" clip-rule="evenodd" />
            </svg>
            <span class="ml-3">Logout</span>
        </a>
    </form>
</li>
        </ul>
    </div>
</aside>
