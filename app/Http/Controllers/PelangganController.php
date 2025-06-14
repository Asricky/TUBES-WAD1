<?php

namespace App\Http\Controllers;
use App\Models\Session;
use App\Models\Schedule;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
{
    return view('pelanggan.dashboard');
}

public function status()
{
    $status = Session::where('client_id', auth()->id())->get(); // sesuaikan relasi
    return view('pelanggan.status', compact('status'));
}

public function jadwal()
{
    $jadwal = Schedule::where('client_id', auth()->id())->get(); // sesuaikan relasi
    return view('pelanggan.jadwal', compact('jadwal'));
}   
}
