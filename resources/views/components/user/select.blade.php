@props(['label', 'name', 'options' => [], 'selected' => '', 'required' => false])

<div class="row mb-3">
    <label for="{{ $name }}" class="col-md-4 col-lg-3 col-form-label">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-md-8 col-lg-9">
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-select @error($name) is-invalid @enderror"
            {{ $required ? 'required' : '' }}
        >
            <option value="">Select {{ strtolower($label) }}</option>
            @foreach ($options as $value => $text)
                <option value="{{ $value }}" {{ (string) $value === (string) old($name, $selected) ? 'selected' : '' }}>
                    {{ $text }}
                </option>
            @endforeach
        </select>
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
