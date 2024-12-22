@props(['label', 'name', 'rows' => 3, 'value' => '', 'required' => false])

<div class="row mb-3">
    <label for="{{ $name }}" class="col-md-4 col-lg-3 col-form-label">
        {{ $label }}
        @if ($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    <div class="col-md-8 col-lg-9">
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            rows="{{ $rows }}"
            class="form-control @error($name) is-invalid @enderror"
            {{ $required ? 'required' : '' }}
        >{{ old($name, $value) }}</textarea>
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
