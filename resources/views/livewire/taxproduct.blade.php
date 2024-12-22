<div>
    <form class="row g-3" wire:submit.prevent="save">
        @csrf

        <!-- Tax Name -->
        <div class="col-md-12">
            <div class="form-floating">
                <input
                    type="text"
                    id="taxName"
                    class="form-control @error('tax') is-invalid @enderror"
                    maxlength="20"
                    wire:model.defer="tax"
                >
                <label for="taxName">Tax Name</label>
                @error('tax')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Tax Percentage -->
        <div class="col-md-12">
            <div class="form-floating">
                <input
                    type="number"
                    id="taxPercentage"
                    class="form-control @error('taxprice') is-invalid @enderror"
                    min="0"
                    max="100"
                    wire:model.defer="taxprice"
                >
                <label for="taxPercentage">Tax Percentage</label>
                @error('taxprice')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Add to Category Checkbox -->
        <div class="col-md-12">
            <div class="form-check">
                <input
                    type="checkbox"
                    id="canCheck"
                    class="form-check-input"
                    wire:model="can_check"
                >
                <label class="form-check-label" for="canCheck">Add Tax to Category</label>
            </div>
        </div>

        <!-- Category Dropdown -->
        @if ($can_check)
            <div class="col-md-12">
                <div class="form-floating">
                    <select
                        id="categorySelect"
                        class="form-control @error('category_selected') is-invalid @enderror"
                        wire:model.defer="category_selected"
                    >
                        <option value="" selected disabled>-- Select Category --</option>
                        @foreach ($category as $item)
                            <option value="{{ $item['catid'] }}">{{ $item['category_name'] }}</option>
                        @endforeach
                    </select>

                    <label for="categorySelect">Category</label>
                    @error('category_selected')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        @endif

        <!-- Save Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Save Tax</span>
                <span wire:loading>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Saving...
                </span>
            </button>
        </div>
    </form>

    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <!-- Error Message -->
    @if (session()->has('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
</div>
