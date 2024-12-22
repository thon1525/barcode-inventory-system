@include('partials/head')

<body>
    @livewireStyles
    <!-- ======= Header ======= -->
    @include('partials/header')
    <script src="{{ asset('assets/vendor/jQuery3.7/jQuery.js') }}"></script>

    <!-- ======= Sidebar ======= -->
    @include('partials/aside')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>POS</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">POS</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left Section -->
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Select Category</h5>
                            <select id="categorySelect" class="form-select mb-3">
                                <option value="" selected disabled>-- Select Category --</option>
                                <option value="drink">Drink</option>
                                <option value="snack">Snack</option>
                                <option value="grocery">Grocery</option>
                            </select>

                            <h5 class="card-title">Product Import</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Tax</th>
                                            <th>Cost Price</th>
                                            <th>Final Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productTableBody">
                                        <!-- Populated dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Tax Calculation</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Tax: <strong id="tax">0.00</strong></p>
                                    <p>Final Tax: <strong id="finalTax">0.00</strong></p>
                                    <p>Other Fees: <strong id="otherFees">1.00</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <canvas id="taxChart" style="width:100%; height:200px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Select Product</h5>
                            <select id="productSelect" class="form-select mb-3">
                                <option value="" selected disabled>-- Select Product --</option>
                            </select>

                            <h5 class="card-title">Product Details</h5>
                            <div id="productDetails">
                                <p><strong>Product:</strong> <span id="selectedProductName">N/A</span></p>
                                <p><strong>Tax:</strong> <span id="selectedProductTax">N/A</span></p>
                                <p><strong>Cost Price:</strong> <span id="selectedProductCost">N/A</span></p>
                                <p><strong>Final Price:</strong> <span id="selectedProductFinal">N/A</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Price Analysis</h5>
                            <canvas id="priceChart" style="width:100%; height:200px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    @include('partials/footer')

    @livewireScripts

    <!-- Chart.js Integration -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Product Data by Category
        const products = {
            drink: [
                { name: 'Coca Cola', tax: '1.50', cost: '10.00', final: '11.50' },
                { name: 'Water', tax: '0.50', cost: '5.00', final: '5.50' }
            ],
            snack: [
                { name: 'Chips', tax: '1.00', cost: '8.00', final: '9.00' },
                { name: 'Chocolate', tax: '2.00', cost: '12.00', final: '14.00' }
            ],
            grocery: [
                { name: 'Rice', tax: '3.00', cost: '15.00', final: '18.00' },
                { name: 'Oil', tax: '2.00', cost: '20.00', final: '22.00' }
            ]
        };

        // Populate Products Dropdown and Table
        $('#categorySelect').on('change', function () {
            const category = $(this).val();
            const productSelect = $('#productSelect');
            const tableBody = $('#productTableBody');

            productSelect.empty().append('<option value="" selected disabled>-- Select Product --</option>'); // Clear Product Dropdown
            tableBody.empty(); // Clear Product Table

            if (products[category]) {
                products[category].forEach((product, index) => {
                    // Add to product dropdown
                    productSelect.append(`<option value="${index}">${product.name}</option>`);
                    // Add to product table
                    tableBody.append(`
                        <tr>
                            <td>${product.name}</td>
                            <td>${product.tax}</td>
                            <td>${product.cost}</td>
                            <td>${product.final}</td>
                        </tr>
                    `);
                });
                updateTaxCalculation(); // Update tax after populating table
            }
        });

        // Display Selected Product Details
        $('#productSelect').on('change', function () {
            const category = $('#categorySelect').val();
            const productIndex = $(this).val();

            if (category && products[category][productIndex]) {
                const selectedProduct = products[category][productIndex];
                $('#selectedProductName').text(selectedProduct.name);
                $('#selectedProductTax').text(selectedProduct.tax);
                $('#selectedProductCost').text(selectedProduct.cost);
                $('#selectedProductFinal').text(selectedProduct.final);
            }
        });

        // Update Tax Calculation
        function updateTaxCalculation() {
            let totalTax = 0;
            let totalFinal = 0;

            $('#productTableBody tr').each(function () {
                const tax = parseFloat($(this).find('td:nth-child(2)').text());
                const final = parseFloat($(this).find('td:nth-child(4)').text());
                if (!isNaN(tax)) totalTax += tax;
                if (!isNaN(final)) totalFinal += final;
            });

            $('#tax').text(totalTax.toFixed(2));
            $('#finalTax').text(totalFinal.toFixed(2));
        }

        // Tax Chart
        var ctx = document.getElementById('taxChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Tax', 'Other Fees', 'Final Tax'],
                datasets: [{
                    data: [1.90, 1.00, 33.90],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107']
                }]
            }
        });

        // Price Analysis Chart
        var ctx2 = document.getElementById('priceChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Product 1', 'Product 2', 'Product 3'],
                datasets: [{
                    label: 'Price Analysis',
                    data: [3.9, 5.5, 6.8],
                    backgroundColor: ['#007bff', '#17a2b8', '#ffc107']
                }]
            }
        });
    </script>
</body>
