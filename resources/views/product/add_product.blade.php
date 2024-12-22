@include ('partials/head');

<body>
    <script src="{{ asset('assets/vendor/jQuery3.7/jQuery.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <!-- ======= Header ======= -->
    @include ('partials/header');
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Set date picker with a restricted date range
            var today = new Date();
            var numberOfDaysToAdd = 30;
            $("#dateExpire").datepicker({
            dateFormat: 'yy-mm-dd', // Set the date format
            minDate: 0,            // Disable past dates
            changeMonth: true,     // Enable month dropdown
            changeYear: true,      // Enable year dropdown
            yearRange: "2024:2034" // Set a year range (optional)
        });
        });
    </script>
    <!-- ======= Sidebar ======= -->
    @include ('partials/aside');
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add New Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('index') }}">Home</a></li>
                    <li class="breadcrumb-item active">Add new product</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <form method="post" action="{{ route('category.add') }}" autocomplete="off">
            @csrf
            <div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Promotion</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input name="name" required type="text" class="form-control" id="floatingName"
                                        placeholder="Category Name">
                                    <label for="floatingName">Category Name</label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-md-3">
                                <div class="form-floating">
                                    <input name="description" type="text" class="form-control"
                                        id="floatingDescription" placeholder="Description">
                                    <label for="floatingDescription">Category description</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <section class="section dashboard">
            <div class="row">



                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add New Product</h5>
                                @if (session()->has('message'))
                                    <div class="alert alert-success align-items-center d-flex justify-content-between">

                                        <div>
                                            {{ session('message') }}

                                        </div>
                                        <div><a style="font-weight: 700;" class="btn btn-success"
                                                href="{{ url('product/manage_product') }}">Check
                                                product</a></div>

                                    </div>
                                @endif
                                @if (session()->has('barcode'))
                                    @php
                                        $product_code = session('product_code');
                                        $id = session('id');
                                    @endphp
                                    <form action="{{ route('product.view_product', $id) }}" method="get">
                                        @csrf
                                        <div
                                            class="alert alert-danger align-items-center d-flex justify-content-between">

                                            <div>
                                                {{ session('barcode') }}

                                            </div>


                                            <div><button style="font-weight: 700;" class="btn btn-primary"
                                                    type="submit">Edit
                                                    product {{ $product_code }} </button></div>

                                        </div>
                                    </form>
                                @endif
                                <!-- Floating Labels Form -->
                                <form class="row g-3" method="post" action="{{ route('product.add') }}">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="floatingName"
                                                name="product_name" placeholder="Product Name">
                                            <label for="floatingName">Product Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input required type="number" class="form-control" id="floatingEmail"
                                                name="product_price" placeholder="Product Price">
                                            <label for="floatingEmail">Product Price</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" required class="form-control" id="floatingPassword"
                                                name="product_qty" placeholder="Product qty">
                                            <label for="floatingPassword">Product qty</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 old_add_category_div">

                                        <div class="form-floating mb-3">

                                            <select class="form-select" required id="floatingSelect" name="category_id"
                                                aria-label="Category">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->catid }}">
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelect">Category</label>

                                        </div>
                                    </div>
                                    <div class="col-md-2 py-2 add_category_btn">

                                        <a class="btn btn-primary add-category-btn" data-bs-toggle="modal"
                                            data-bs-target="#ModalCreate">+</a>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">

                                            <select class="form-select" required id="floatingSelect"
                                                name="supplier_id" aria-label="Category">
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">
                                                        {{ $supplier->supplier_name }} |
                                                        {{ $supplier->supplier_company }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelect">Supplier</label>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="col-sm-6">
                                        <!-- Product Code -->
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="floatingCode"
                                                name="product_code" placeholder="Product code">
                                            <label for="floatingCode">Product code</label>
                                            <div class="invalid-feedback">Product code is required.</div>
                                        </div>


                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Date Expire -->
                                        <div class="form-floating">
                                            <input required type="text" id="dateExpire"
                                                class="form-control datepicker" name="date_expire"
                                                placeholder="Expiration Date">
                                            <label for="dateExpire" class="form-label">Date Expire</label>
                                            <div class="invalid-feedback">Please provide a valid expiration date.</div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </form><!-- End floating Labels Form -->

                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->


            </div>
        </section>

    </main><!-- End #main -->

    @include ('partials/footer');
