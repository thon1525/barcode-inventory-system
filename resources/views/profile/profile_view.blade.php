@extends('dashboard')
@section('admin')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if (!empty($profileData->avatar))
                                <img src="{{ url('upload/profile_pictures/' . $profileData->avatar) }}" alt="Profile"
                                    class="rounded-circle">
                            @else
                                <img src="{{ url('upload/noimage.jpg') }}" alt="Profile" class="rounded-circle">
                            @endif
                            <h2>{{ $profileData->name }}</h2>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <x-profile.nav-tab label="Overview" target="profile-overview" :isActive="true" />
                                <x-profile.nav-tab label="Edit Profile" target="profile-edit" :isActive="false" />
                                <x-profile.nav-tab label="Change Password" target="profile-change-password"
                                    :isActive="false" />
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview">
                                    <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">{{ $profileData->about }}</p>
                                    <h5 class="card-title">Profile Details</h5>

                                    <x-profile.profile-row label="Full Name" value="{{ $profileData->name }}" />
                                    <x-profile.profile-row label="email" value="{{ $profileData->email }}" />
                                    <x-profile.profile-row label="Company" value="{{ $profileData->company }}" />
                                    <x-profile.profile-row label="Country" value="{{ $profileData->country }}" />
                                    <x-profile.profile-row label="Address" value="{{ $profileData->address }}" />
                                    <x-profile.profile-row label="Phone" value="{{ $profileData->phone }}" />

                                </div>
                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <x-user.profile-form :profileData="$profileData" />
                                </div>
                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <x-user.change-password-form />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
