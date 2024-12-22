@include ('partials/head');

<body>

    <!-- ======= Header ======= -->
    @include ('partials/header');

    <!-- ======= Sidebar ======= -->
    @include ('partials/aside');

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Manage Products</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Products</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                @if(session()->has('message'))
                    <div class="alert alert-success d-flex justify-content-between align-items-center">
                        <div>{{ session('message') }}</div>
                        <a class="btn btn-success font-weight-bold" href="{{ url('product/add_product') }}">Add new product</a>
                    </div>
                @endif

                <div class="col-lg-12">
                    <div class="card overflow-auto">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">All products</h5>
                                <a href="{{ url('product/grid_view') }}" class="btn btn-success">Grid View <i class="bi bi-grid-3x2"></i></a>
                            </div>

                            <table class="table table-borderless datatable ">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Img</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Category</th>
                                        <th>Code</th>
                                        <th>Supplier</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <x-product-row :product="$product" :categories="$categories" :suppliers="$suppliers" />
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }} <!-- For pagination links -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    @include ('partials/footer');
