<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="row">
        <div class="col-2 offset-md-5">
            <div wire:loading id="lazyloading">
                <div class="d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="row g-3"  autocomplete="off" wire:submit.prevent="save">
        @csrf
        <div class="col-md-12">
            <div class="form-floating">
               <input class="form-control" id="categoryinput" type="text" maxlength="20" wire:model="tax" :disabled="isSubmitting">
               <label for="floatingName">Category Name</label>
               @error('tax') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-floating">
               <input type="number" data-min_max data-min="0" data-max="100" data-toggle="just_number" class="form-control" wire:model="taxprice" :disabled="isSubmitting">
               <label for="floatingEmail">Category description</label>
               @error('taxprice') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" :disabled="isSubmitting">Save Contact</button>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.hook('beforeSubmit', () => {
                @this.set('isSubmitting', true);
            });

            Livewire.hook('afterSubmit', () => {
                @this.set('isSubmitting', false);
            });
        });
    </script>
@endpush
