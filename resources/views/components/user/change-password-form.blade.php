<form method="post" action="{{ route('password.update') }}" class="mt-4">
    @csrf
    @method('put')

    <div class="mb-3 ">
        <label for="update_password_current_password" class="form-label">{{ __('Current Password') }}</label>
        <input type="password" id="update_password_current_password" name="current_password" class="form-control" autocomplete="current-password">
        @if ($errors->updatePassword->has('current_password'))
            <div class="text-danger mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
        @endif
    </div>

    <div class="mb-3">
        <label for="update_password_password" class="form-label">{{ __('New Password') }}</label>
        <input type="password" id="update_password_password" name="password" class="form-control" autocomplete="new-password">
        @if ($errors->updatePassword->has('password'))
            <div class="text-danger mt-1">{{ $errors->updatePassword->first('password') }}</div>
        @endif
    </div>

    <div class="mb-3">
        <label for="update_password_password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
        <input type="password" id="update_password_password_confirmation" name="password_confirmation" class="form-control" autocomplete="new-password">
        @if ($errors->updatePassword->has('password_confirmation'))
            <div class="text-danger mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
        @endif
    </div>

    <div class="d-flex align-items-center gap-3">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    
        @if (session('status') === 'password-updated')
            <p class="text-muted small mb-0" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)">
                {{ __('Saved.') }}
            </p>
        @endif
    </div>
</form>

