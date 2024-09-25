@include ('partials/head');

<body>

    <!-- ======= Header ======= -->
    @include ('partials/header');

    <!-- ======= Sidebar ======= -->
    @include ('partials/aside');

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Stock prodct constomer order</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Stock prodct constomer order</li>
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
                                <h5 class="card-title">Stock prodct constomer </h5>

                                    {{-- <a href="{{url('product/grid_view')}}" class="btn btn-success ">Grid View <i class="bi bi-grid-3x2"></i></a> --}}

                                </div>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col"> Date Stock in</th>
                                            <th scope="col">Product Name </th>
                                            <th scope="col">Category product</th>
                                            <th scope="col">qty product</th>
                                            <th scope="col">price product</th>
                                            <th scope="col"> Total</th>
                                            <th scope="col">barcode product</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($select_stockin as $objitem)

                                        <tr  class="align_tr">
                                            <th scope="row">{{$objitem->id}}</th>

                                            <td>{{$objitem->date_stock_in}}</td>
                                            <td>{{$objitem->name_product_stockin}}</td>
                                            <td>{{$objitem->categore_stockin_pro}}</td>
                                            <td>{{$objitem->qty_product_stockin}}</td>
                                            <td>{{$objitem->price_product_stockin}}</td>
                                            <td>{{$objitem->total_product_stockin}}</td>
                                            <td>{{$objitem->product_barcode_stockin}}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- small modal -->
                            </div>
                        </div>

                        <script>
                            $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e) {
                                e.preventDefault();
                                var $form = $(this);
                                $('#confirm').modal({
                                        backdrop: 'static',
                                        keyboard: false
                                    })
                                    .on('click', '#delete-btn', function() {
                                        $form.submit();
                                    });
                            });
                        </script>

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->

            </div><!-- End Right side columns -->


        </section>

    </main><!-- End #main -->

    @include ('partials/footer');
