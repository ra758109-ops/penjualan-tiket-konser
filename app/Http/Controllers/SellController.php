<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth; 


class SellController extends Controller
{

    public function index()
    {

        return view('sell');
    }


    public function store(Request $request)
    {
        // 1. VALIDASI DATA
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'category' => 'required|string|in:konser,fan-meeting,festival',
            'zone' => 'required|string|max:100',
            'price' => 'required|integer|min:100000',
            'quantity' => 'required|integer|min:1',
            // Aturan untuk file: maksimal 5MB
            'proof' => 'required|file|mimes:pdf,jpg,png|max:5120',
        ]);

        // 2. PENANGANAN FILE (Menyimpan file dan mendapatkan path)
        $path = null;
        if ($request->hasFile('proof')) {
            // Simpan file ke storage/app/public/proofs
            $path = $request->file('proof')->store('proofs', 'public');
        }

        // 3. SIMPAN KE DATABASE (Menggunakan Model Eloquent)
        Ticket::create([


            'user_id' => Auth::id(),
            'event_name' => $validatedData['event_name'],
            'category' => $validatedData['category'],
            'zone' => $validatedData['zone'],
            'price' => $validatedData['price'],
            'quantity' => $validatedData['quantity'],
            'proof_path' => $path, // Gunakan path file yang sudah disimpan
            'status' => 'pending_verification' // Status awal
        ]);

        // 4. REDIRECT DAN PESAN SUKSES
        return redirect()->route('sell.index')->with('success', 'Pengajuan tiket berhasil dikirim dan menunggu verifikasi!');
    }
}
