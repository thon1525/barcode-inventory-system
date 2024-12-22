@props(['label', 'name', 'type' => 'text', 'value' => '', 'required' => false])

<div class="row mb-3">
    <label for="{{ $name }}" class="col-md-4 col-lg-3 col-form-label">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-md-8 col-lg-9">
        <input
            name="{{ $name }}"
            type="{{ $type }}"
            class="form-control @error($name) is-invalid @enderror"
            id="{{ $name }}"
            value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }}
        >
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
