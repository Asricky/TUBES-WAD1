@extends('layouts.app')

@section('content')
<h2>Dashboard Pelanggan</h2>
<ul>
    <li><a href="{{ url('/status-konsultasi') }}">Lihat Status Konsultasi</a></li>
    <li><a href="{{ url('/jadwal-konsultasi') }}">Lihat Jadwal Konsultasi</a></li>
</ul>
@endsection
