@extends('layouts.main')

@section('title', 'Profil - Warkop Pamulang')

@push('styles')
    <style>
        .profile-container {
            padding: 80px 0;
            min-height: 80vh;
        }
        .profile-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 30px;
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(155, 27, 48, 0.1);
        }
        .section-title {
            color: #333;
            font-weight: 800;
            margin-bottom: 40px;
            display: flex;
            align-items: center;
        }
        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 10px;
        }
        .form-control {
            border-radius: 15px;
            padding: 12px 20px;
            border: 1px solid rgba(155, 27, 48, 0.1);
            background: rgba(255, 255, 255, 0.9);
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(155, 27, 48, 0.1);
            border-color: var(--primary-red);
        }
    </style>
@endpush

@section('content')
<div class="profile-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="section-title">
                    <i class="bi bi-person-circle me-3 text-custom-red"></i> Pengaturan Profil
                </h2>

                <div class="profile-card" data-aos="fade-up">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="profile-card" data-aos="fade-up" data-aos-delay="100">
                    @include('profile.partials.update-password-form')
                </div>

                <div class="profile-card border-danger-subtle" data-aos="fade-up" data-aos-delay="200">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
