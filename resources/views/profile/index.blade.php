@extends('layouts.template')
@section('content')
    <div class="container rounded bg-white mt-4 mb-5">
        <div class="row">
            <!-- Left Side: Profile Picture and Edit Button -->
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="{{ asset($user->user_profile) }}">
                    <span class="font-weight-bold mt-3">{{ $user->nama }}</span>
                    <span class="text-black-50">{{ $user->email }}</span>
                    <span>{{ $user->location }}</span>

                    <!-- Edit Profile Photo Button -->
                    <div class="mt-4">
                        <button class="btn btn-primary profile-button" type="button"
                                onclick="modalAction('{{ url('/profile/' . session('user_id') . '/edit_profile') }}')">
                            <i class="fas fa-camera"></i> Edit Profile Photo
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Side: Profile Information Form -->
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Settings</h4>
                    </div>
                    <form action="{{ url('/profile/update_ajax', ['id' => $user->user_id]) }}" method="POST">
                        @csrf
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Username</label>
                                <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Level</label>
                                <select class="form-control" name="level_id">
                                    @foreach ($level as $lvl)
                                        <option value="{{ $lvl->level_id }}" 
                                            {{ $user->level->level_id == $lvl->level_id ? 'selected' : '' }}>
                                            {{ $lvl->level_nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6"><label class="labels">Nama</label><input type="text" class="form-control" name="nama" value="{{ $user->nama }}"></div>
                            <div class="col-md-6"><label class="labels">Password</label><input type="password" class="form-control" name="password" placeholder="Leave blank if not changing"></div>
                        </div>
                        <div class="mt-5 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        body {
            background: #f8f9fa;
        }
        .rounded-circle {
            border: 3px solid #007bff;
        }
        .labels {
            font-size: 14px;
            font-weight: 500;
        }
        .profile-button {
            background-color: #fd7e14;
            border: none;
        }
        .profile-button:hover {
            background-color: #e9590e;
        }
    </style>
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
    </script>
@endpush
