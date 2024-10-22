@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>

    <div class="card-body">
        @if (empty($user))
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID</th>
                    <td>{{ $user->user_id }}</td>
                </tr>
                <tr>
                    <th>Level</th>
                    <td>{{ $user->level ? $user->level->level_nama : '-' }}</td> <!-- Tambahkan pengecekan apakah relasi level ada -->
                </tr>
                <tr>
                    <th>Username</th>
                    <td>{{ $user->username }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $user->nama }}</td>
                </tr>
                <tr>
                    <th>Foto Profil</th>
                    <td>
                        @if ($user->user_profile)
                            <img src="{{ asset('uploads/'.$user->user_profile) }}" alt="Profile Picture" class="img-thumbnail" width="100">
                        @else
                            Tidak ada foto profil
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>********</td> <!-- Tidak menampilkan password asli -->
                </tr>
            </table>
        @endif

        <a href="{{ url('user') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
