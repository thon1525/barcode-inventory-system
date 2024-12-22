<!-- resources/views/components/form-input.blade.php -->

<div class="{{ $col }}">
    <div class="form-floating">
        <input required type="{{ $type }}" class="form-control" id="floating{{ ucfirst($name) }}" name="{{ $name }}" placeholder="{{ $placeholder }}">
        <label for="floating{{ ucfirst($name) }}">{{ $label }}</label>
    </div>
</div>
