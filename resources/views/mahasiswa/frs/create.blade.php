@extends('layouts.mahasiswa')

@section('title', 'Buat FRS')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-lg mx-auto p-8 bg-white shadow-md rounded-xl">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Buat FRS Baru</h1>
            <p class="text-gray-600 text-sm">Isi form di bawah untuk menambah mata kuliah</p>
        </div>
        
        <form method="POST" action="{{ route('mahasiswa.frs.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="jadwalSelect" class="block text-sm font-medium text-gray-700 mb-2">
                    Jadwal Kuliah
                </label>
                <select name="id_jadwal_kuliah" id="jadwalSelect" 
                        class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                        required>
                    <option value="">-- Pilih Jadwal Kuliah --</option>
                    @foreach($jadwalKuliah as $j)
                    <option 
                        value="{{ $j->id_jadwal_kuliah }}"
                        data-matkul="{{ $j->mataKuliah->nama_mata_kuliah }}"
                        data-sks="{{ $j->mataKuliah->sks }}"
                        data-hari="{{ $j->hari }}"
                        data-jammulai="{{ $j->jam_mulai }}"
                        data-jamselesai="{{ $j->jam_selesai }}">
                        {{ $j->mataKuliah->nama_mata_kuliah }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div id="detailSection" class="hidden space-y-4 p-4 bg-blue-50 rounded-lg border border-blue-200">
                <h3 class="font-medium text-gray-800 text-sm mb-3">Detail Mata Kuliah:</h3>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Nama Mata Kuliah</label>
                        <input type="text" id="matkulInput" 
                               class="w-full px-3 py-2 bg-white border border-gray-200 rounded text-sm font-medium text-gray-800" 
                               readonly>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">SKS</label>
                        <input type="text" id="sksInput" 
                               class="w-full px-3 py-2 bg-white border border-gray-200 rounded text-sm font-medium text-gray-800" 
                               readonly>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Hari</label>
                        <input type="text" id="hariInput" 
                               class="w-full px-3 py-2 bg-white border border-gray-200 rounded text-sm font-medium text-gray-800" 
                               readonly>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Jam Mulai</label>
                        <input type="text" id="jamMulaiInput" 
                               class="w-full px-3 py-2 bg-white border border-gray-200 rounded text-sm font-medium text-gray-800" 
                               readonly>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Jam Selesai</label>
                        <input type="text" id="jamSelesaiInput" 
                               class="w-full px-3 py-2 bg-white border border-gray-200 rounded text-sm font-medium text-gray-800" 
                               readonly>
                    </div>
                </div>
            </div>
            <div>
                <label for="semester" class="block text-sm font-medium text-gray-700 mb-2">
                    Semester
                </label>
                <input type="number" name="semester" id="semester" value="4"
                       class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" 
                       required>
            </div>
            <div class="pt-2">
                <button type="submit" id="submitBtn"
                        class="w-full bg-[#14487a] hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-colors duration-200 disabled:bg-gray-400 disabled:cursor-not-allowed" 
                        disabled>
                    Tambah ke FRS
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('jadwalSelect').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const detailSection = document.getElementById('detailSection');
        const submitBtn = document.getElementById('submitBtn');
        
        if (this.value) {
            document.getElementById('matkulInput').value = selected.getAttribute('data-matkul') || '';
            document.getElementById('sksInput').value = selected.getAttribute('data-sks') || '';
            document.getElementById('hariInput').value = selected.getAttribute('data-hari') || '';
            document.getElementById('jamMulaiInput').value = selected.getAttribute('data-jammulai') || '';
            document.getElementById('jamSelesaiInput').value = selected.getAttribute('data-jamselesai') || '';
        
            detailSection.classList.remove('hidden');
            submitBtn.disabled = false;
        } else {
            detailSection.classList.add('hidden');
            submitBtn.disabled = true;
            
            document.getElementById('matkulInput').value = '';
            document.getElementById('sksInput').value = '';
            document.getElementById('hariInput').value = '';
            document.getElementById('jamMulaiInput').value = '';
            document.getElementById('jamSelesaiInput').value = '';
        }
    });
</script>
@endsection