@extends('layouts.template')
@section('content')
    <div class="container rounded bg-white mt-4 mb-5">
        <div class="row">
            <!-- Left Side: Profile Picture -->
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px" src="{{ asset('image/profile/1729668741.jpg') }}">
                    <span class="font-weight-bold mt-3">{{ $user->nama }}</span>
                    <span>{{ $user->location }}</span>
                </div>
            </div>

            <!-- Right Side: Profile Information (Read-Only) -->
            <div class="col-md-8 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Profile Details</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label class="labels">Username</label>
                            <p class="form-control">{{ $user->username }}</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Level</label>
                            <p class="form-control">{{ $user->level->level_nama }}</p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Nama</label>
                            <p class="form-control">{{ $user->nama }}</p>
                        </div>
                    </div>
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
        .form-control {
            border: none;
            background-color: #f8f9fa;
            padding: 10px 0;
            margin-bottom: 10px;
        }
    </style>
@endpush
