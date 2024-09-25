@include ('partials/head');

<body>

    <!-- ======= Header ======= -->
    @include ('partials/header');

    <!-- ======= Sidebar ======= -->
    @include ('partials/aside');

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Manage Category</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Category</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                @if(session()->has('message'))
                <div class="alert alert-success align-items-center d-flex justify-content-between">

                    <div>
                        {{ session('message') }}

                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="card overflow-auto">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">All Import Product </h5>

                                    {{-- <a href="{{url('product/grid_view')}}" class="btn btn-success ">Grid View <i class="bi bi-grid-3x2"></i></a> --}}

                                </div>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">images  product import</th>
                                            <th scope="col">Name product import</th>
                                            <th scope="col">Price Product import</th>
                                            <th scope="col">Qty Product import</th>
                                            <th scope="col">Category Product import</th>
                                            <th scope="col">suppler Product import</th>
                                            <th scope="col">Barcode Product import</th>
                                            <th scope="col">Date  Product import</th>
                                            <th scope="col">total  Product import</th>
                                            <th scope="col">Expire  Product import</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productimport as $itemexport)

                                        <tr  class="align_tr">
                                            <th scope="row">{{$itemexport->id_importpro}}</th>
                                            <td  style="background-color:none !important">
                                                @if (!empty($itemexport->image_product))
                                                <img src="{{url('upload/products/'.$itemexport->image_product)}}" id="product" width="50px" height="50px" alt="Profile" >
                                                @else
                                                <img src="{{url('upload/noimage.jpg') }}" alt="Profile"  id="product" width="50px" height="50px" >

                                                 @endif
                                            </td>
                                            <td>{{$itemexport->namepro_import}}</td>
                                            <td>{{$itemexport->proprice_import}}</td>
                                            <td>{{$itemexport->progty_import}}</td>
                                            <td>{{$itemexport->category_name}}</td>
                                            <td>{{$itemexport->supplier_name}}</td>
                                            <td>{!! DNS1D::getBarcodeHTML("$itemexport->barcodepro_import", 'C128')!!} <span class="text-secondary">{{$itemexport->barcodepro_import}}</span></td>
                                            <td>@if($itemexport->date_import)
                                                @php
                                                $namedate=    $itemexport->date_import;
                                                $time = strtotime($namedate);
                                                $newformat = date('Y-m-d',$time);
                                                echo $newformat;
                                                @endphp
                                            @endif
                                            </td>
                                            <td>{{$itemexport->total_product}}</td>
                                            <td>{{$itemexport->dateexpire}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <form action="{{route('export.product.view_product', $itemexport->id_importpro)}}" method="get">
                                                        @csrf
                                                            <button class="btn btn-primary" type="submit">Edit</button>
                                                        </form>

                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{$itemexport->id_importpro}}">
                                                        Delete
                                                    </button>

                                                    <form enctype="multipart/form-data" action="{{route('import.product.destroy', $itemexport->id_importpro)}}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal fade" id="ModalDelete{{$itemexport->id_importpro}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                            Delete
                                                                            product
                                                                        </h1>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">Are you sure you want to delete
                                                                        <b>{{$itemexport->namepro_import}}</b>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger">Save
                                                                            changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </td>
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

    @include ('partials/footer')
