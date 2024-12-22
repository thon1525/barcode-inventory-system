@include ('partials/head')

<body>
    @include ('partials/header')
    @include ('partials/aside')

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Stock Product Customer Order</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Stock Product Customer Order</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card overflow-auto">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Stock Product Customer</h5>
                                </div>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Date Stock In</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Product Code</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Product Image</th>
                                            <th scope="col">Supplier ID</th>
                                            <th scope="col">Expiration Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($select_stockin as $objitem)
                                            <tr class="align_tr">
                                                <th scope="row">{{ $objitem->StockInID }}</th>
                                                <td>{{ $objitem->DateIn }}</td>
                                                <td>{{ $objitem->name_product_stockin }}</td>
                                                <td>{{ $objitem->category_id_stockin }}</td>
                                                <td>{{ $objitem->product_code_stockin }}</td>
                                                <td>{{ $objitem->qty_product_stockin }}</td>
                                                <td>{{ $objitem->price_product_stockin }}</td>
                                                <td>{{ $objitem->total_product_stockin }}</td>
                                                <td>
                                                    @if ($objitem->product_img_stockin)
                                                        <img src="{{ asset('storage/' . $objitem->product_img_stockin) }}" alt="Product Image" width="50">
                                                    @else
                                                        No Image
                                                    @endif
                                                </td>
                                                <td>{{ $objitem->supplier_id_stockin }}</td>
                                                <td>{{ $objitem->date_expire_stockin }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- End Left side columns -->

            </div><!-- End Right side columns -->
        </section>
    </main><!-- End #main -->

    @include ('partials/footer')
</body>
