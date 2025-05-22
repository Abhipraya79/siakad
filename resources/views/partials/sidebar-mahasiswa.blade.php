<aside class="fixed top-0 left-0 z-40 w-56 h-screen pt-14 transition-transform -translate-x-full border-r border-gray-200 md:translate-x-0 " style="background-color: #14487a;">
<div class="overflow-y-auto py-5 px-3 h-full">
        <h2 class="text-4xl font-bold text-center mb-6 drop-shadow-md animate-fade-in" style="color: #f3c903;">
            Siakad MIS
        </h2>

        <!-- Bagian Profil -->
        <div class="flex items-center space-x-3 px-3 mb-6">
            <img src="{{ asset('images/ikon_profile.png') }}" alt="Profile Image" style="width: 100px; height: 100px;" class="rounded-full object-cover">
            <div class="text-sm font-medium text-black-100">
                {{ Auth::user()->name }}
            </div>
        </div>
        <ul class="space-y-2">       
            <li>
                <a href="{{ route('mahasiswa.dashboard') }}" 
                   class="nav-link">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.frs.index') }}" 
                   class="nav-link">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">FRS</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.jadwal.index') }}" 
                   class="nav-link">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Jadwal Kuliah</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.nilai.index') }}" 
                   class="nav-link">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Nilai</span>
                </a>
            </li>
        </ul>
    </div>
</aside>