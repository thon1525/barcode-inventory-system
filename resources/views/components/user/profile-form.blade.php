{{-- resources/views/components/user/profile-form.blade.php --}}
<form method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
    @csrf
    <x-user.input label="Full Name" name="name" id="fullName" type="text" :value="$profileData->name" />
    <x-user.input label="Username" name="username" id="username" type="text" :value="$profileData->username" />
    <x-user.input label="Email" name="email" id="email" type="email" :value="$profileData->email" />


    <x-user.input label="Phone" name="phone" id="phone" type="number" :value="$profileData->phone" />
    <x-user.input label="Address" name="address" id="address" type="text" :value="$profileData->address" />
    <x-user.input label="company" name="company" id="company" type="text" :value="$profileData->company" />

    <div class="row mb-3">
        <label for="avatar" class="col-md-4 col-lg-3 col-form-label">Profile Picture</label>
        <div class="col-md-8 col-lg-9">
            <input name="avatar" type="file" class="form-control" id="avatar">
        </div>
    </div>
    <x-textarea id="about" name="about" label="Description" name="about" rows="5"
        value="{{ $profileData->about }}" :required="true" />
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>
