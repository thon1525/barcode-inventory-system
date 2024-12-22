@include('partials/head')
<script src="{{ asset('assets/vendor/jQuery3.7/jQuery.js') }}"></script>

<body>
    <!-- ======= Header ======= -->
    @include('partials/header')

    <!-- ======= Sidebar ======= -->
    @include('partials/aside')

    <!-- ======= Main Content ======= -->
    <main id="main" class="main">
        <!-- Page Title -->
        <div class="pagetitle">
            <h1>Add stock In</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('index') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Add  stock In</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <!-- Section Content -->
        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Category Dropdown -->
                            <h5 class="card-title">Select Category</h5>
                            <select id="categorySelect" class="form-select mb-3">
                                <option value="" selected disabled>-- Select Category --</option>
                                @foreach ($category as $item)
                                    <option class="text-sm" value="{{ $item->catid }}">
                                        {{ $item->category_name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Product Dropdown -->
                            <h5 class="card-title">Select Product</h5>
                            <select id="productSelect" class="form-select mb-3">
                                <option value="" selected disabled>-- Select Product --</option>
                            </select>

                            <!-- Product Details Table -->
                            <h5 class="card-title">Product Details</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Tax</th>
                                        <th>Cost</th>
                                        <th>Final Price</th>
                                    </tr>
                                </thead>
                                <tbody id="productTableBody">
                                    <!-- Product rows will be dynamically populated here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Section Content -->
    </main><!-- End #main -->

    <!-- Livewire Scripts -->
    @livewireScripts

    <!-- Chart.js Integration -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom JavaScript -->
    <script>
        $(document).ready(function() {
            // Populate Products Dropdown and Table based on Category
            $('#categorySelect').on('change', function() {
                const category = Number($(this).val());
                const productSelect = $('#productSelect');
                const tableBody = $('#productTableBody');

                // Clear previous options and table data
                productSelect.empty().append(
                    '<option value="" selected disabled>-- Select Product --</option>'
                );
                tableBody.empty();

                // Send AJAX request to fetch products by category
                $.post('/cost-products/category', {
                    'category': category,
                    _token: '{{ csrf_token() }}' // CSRF token for security
                }, function(result) {
                    // Populate Product Dropdown
                    result.forEach(product => {
                        productSelect.append(`
                            <option value="${product.id}">
                                ${product.product_name}
                            </option>
                        `);
                    });
                }).fail(function() {
                    alert('Failed to load products. Please try again.');
                });
            });

            // Display Selected Product Details in Table
            $('#productSelect').on('change', function() {
                const productId = $(this).val();
                const tableBody = $('#productTableBody');
alert(productId)
                // Clear previous table data
                tableBody.empty();

                // Fetch product details for the selected product
                $.post('/cost-products/product_id', {
                    'product_id': productId,
                    _token: '{{ csrf_token() }}'
                }, function(product) {
                    // Append product details to the table
                    tableBody.append(`
                        <tr>
                            <td>${product.product_name}</td>
                            <td>${product.tax}</td>
                            <td>${product.product_price}$</td>
                            <td>${product.final_price}</td>
                        </tr>
                    `);
                }).fail(function() {
                    alert('Failed to load product details. Please try again.');
                });
            });
        });
    </script>

    <!-- Footer -->
    @include('partials/footer')
</body>
