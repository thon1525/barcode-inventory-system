

<form class="row g-3" method="post" action="{{ route('product.add') }}">
    @csrf

    <!-- Product Name Input -->
    <x-form-input
        label="Product Name"
        name="product_name"
        type="text"
        placeholder="Product Name"
        col="col-md-12"
    />

    <!-- Product Price Input -->
    <x-form-input
        label="Product Price"
        name="product_price"
        type="number"
        placeholder="Product Price"
        col="col-md-6"
    />

    <!-- Product Quantity Input -->
    <x-form-input
        label="Product Quantity"
        name="product_qty"
        type="number"
        placeholder="Product Quantity"
        col="col-md-6"
    />

    <!-- Additional form fields can be added here using the same pattern -->

    <!-- Form Buttons -->
    <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>
