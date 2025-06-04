<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
   public function store(Request $request)
{
    $mahasiswa = $request->user();          // sudah ter-auth sanctum
    if (!$mahasiswa) {
        return response()->json(['status'=>'error','message'=>'Unauthorized'], 401);
    }

        // Generate kode_bayar auto increment
    $last = Pembayaran::orderByDesc('id_bayar')->first();
    $lastNumber = 0;
    if ($last && preg_match('/BYR(\d+)/', $last->kode_bayar, $match)) {
        $lastNumber = (int)$match[1];
    }
    $newKode = 'BYR' . str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);

    $request->validate([
        'token'             => 'required|string|size:10',
        'tanggal_bayar'     => 'required|date',
        'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
        'id_frs'            => 'required|exists:frs,id_frs',
    ]);

     $mahasiswaId = $mahasiswa->id_mahasiswa ?? $mahasiswa->id;

      $pembayaran = Pembayaran::create([
        'token'             => $request->token,
        'kode_bayar'        => $newKode,
        'id_mahasiswa'      => $mahasiswa->id_mahasiswa,
        'id_frs'            => $request->id_frs,
        'tanggal_bayar'     => $request->tanggal_bayar,
        'status_pembayaran' => $request->status_pembayaran,
    ]);
    return response()->json(['status'=>'success','data'=>$pembayaran], 201);
}

      public function cekStatusUkt(Request $request)
    {
        $mahasiswa = $request->user(); // sudah pakai sanctum
        $mahasiswaId = $mahasiswa->id_mahasiswa ?? $mahasiswa->id;

        // Ambil pembayaran terakhir milik mahasiswa
        $pembayaran = Pembayaran::where('id_mahasiswa', $mahasiswaId)
            ->orderByDesc('tanggal_bayar')
            ->first();

        $lunas = $pembayaran && $pembayaran->status_pembayaran === 'Lunas';

        return response()->json([
            'lunas'              => $lunas,
            'status_pembayaran'  => $pembayaran ? $pembayaran->status_pembayaran : 'Belum Lunas',
        ]);
    }
 public function index(Request $request)
    {
        $mahasiswa = $request->user();
        $mahasiswaId = $mahasiswa->id_mahasiswa ?? $mahasiswa->id;

        $list = Pembayaran::where('id_mahasiswa', $mahasiswaId)
            ->orderByDesc('tanggal_bayar')
            ->get();

        return response()->json([
            'status' => 'success',
            'data'   => $list,
        ]);
    }

 public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:Lunas,Belum Lunas',
        ]);

        $mahasiswa   = $request->user();
        $mahasiswaId = $mahasiswa->id_mahasiswa ?? $mahasiswa->id;

        // Cari berdasarkan id_bayar + id_mahasiswa
        $p = Pembayaran::where('id_bayar', $id)
            ->where('id_mahasiswa', $mahasiswaId)
            ->first();

        if (!$p) {
            return response()->json(['status'=>'error','message'=>'Pembayaran tidak ditemukan'], 404);
        }

        $p->status_pembayaran = $request->status_pembayaran;
        $p->save(); // Karena $primaryKey sudah di-set, Laravel akan pakai "WHERE id_bayar = …"

        return response()->json(['status'=>'success','data'=>$p]);
    }
}