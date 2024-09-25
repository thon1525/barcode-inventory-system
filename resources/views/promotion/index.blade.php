@include ('partials/head');

<body>

    <!-- ======= Header ======= -->
    @include ('partials/header');

    <!-- ======= Sidebar ======= -->
    @include ('partials/aside');

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Manage promotion</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Ca</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        {{-- @foreach($promotions as $promotion) --}}
        <div>

            <a style="font-weight: 700;" class="btn btn-success mb-3" href="{{ url('product/add_product') }}"
                type="button" data-bs-toggle="modal" data-bs-target="#ModalCreate">Add new promotion</a>
        </div>



        {{-- create model for Create now --}}
        <form action="{{ route('promotion.store') }}" autocomplete="off" method="POST">
            @csrf
            <div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Promotion</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input name="name" required type="text" class="form-control" id="floatingName"
                                        placeholder="Name">
                                    <label for="floatingName">Name</label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-md-3">
                                <div class="form-floating">
                                    <input name="description" type="text" class="form-control" id="floatingDescription"
                                        placeholder="Description">
                                    <label for="floatingDescription">Description</label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-md-3">
                                <div class="form-floating">
                                    <select name="discount_type" required class="form-select" id="floatingDiscountType"
                                        aria-label="Discount Type">
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed">Fixed Amount</option>
                                    </select>
                                    <label for="floatingDiscountType">Discount Type</label>
                                </div>

                            </div>
                            <div class="col-md-12 mt-md-3">
                                <div class="form-floating">
                                    <input name="discount_value" required type="number" step="0.01" class="form-control"
                                        id="floatingDiscountValue" placeholder="Discount Value">
                                    <label for="floatingDiscountValue">Discount Value</label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-md-3">
                                <div class="form-floating">
                                    <input name="minimum_purchase" required type="number" step="0.01"
                                        class="form-control" id="floatingMinimumPurchase"
                                        placeholder="Minimum Purchase">
                                    <label for="floatingMinimumPurchase">Minimum Purchase</label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-md-3">
                                <div class="form-floating">
                                    <input name="start_date" required type="date" class="form-control"
                                        id="floatingStartDate" placeholder="Start Date">
                                    <label for="floatingStartDate">Start Date</label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-md-3">
                                <div class="form-floating">
                                    <input name="end_date" required type="date" class="form-control"
                                        id="floatingEndDate" placeholder="End Date">
                                    <label for="floatingEndDate">End Date</label>
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


        {{-- @endforeach --}}
        {{-- end model for create now --}}
        <!-- Left side columns -->
        <div class="col-lg-12">
            <div class="row">
                @if(session()->has('success'))
                <div class="alert alert-success align-items-center d-flex justify-content-between">

                    <div>
                        {{ session('success') }}

                    </div>
                </div>

                @endif



                <div class="card overflow-auto">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">All promotions </h5>

                            {{-- <a href="{{url('product/grid_view')}}" class="btn btn-success ">Grid View <i
                                    class="bi bi-grid-3x2"></i></a> --}}

                        </div>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>

                                    <th scope="col">discount_type</th>
                                    <th scope="col">discount_value</th>
                                    <th scope="col">minimum_purchase</th>
                                    <th scope="col">start_date</th>
                                    <th scope="col">end_date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($promotions as $promotion)

                                <tr class="align_tr">
                                    <th scope="row">{{$promotion->id}}</th>
                                    <td>{{$promotion->name}}</td>
                                    <td>{{$promotion->discount_type}}</td>
                                    <td>{{$promotion->discount_value}}</td>
                                    <td>{{$promotion->minimum_purchase}}</td>
                                    <td>{{$promotion->start_date}}</td>
                                    <td>{{$promotion->end_date}}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit{{$promotion->id}}">Edit</button>
                                            {{-- create model for edit now --}}
                                            <form
                                                action="{{ route('promotion.update', ['promotion' => $promotion->id]) }}"
                                                autocomplete="off"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal fade" id="ModalEdit{{$promotion->id}}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit
                                                                    Promotion</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="promotion_id"
                                                                    value="{{$promotion->id}}">
                                                                <div class="col-md-12">
                                                                    <div class="form-floating">
                                                                        <input name="name" required type="text"
                                                                            class="form-control"
                                                                            value="{{$promotion->name}}"
                                                                            id="floatingPromotionCode"
                                                                            placeholder="Promotion Code">
                                                                        <label for="floatingPromotionCode">Promotion
                                                                            Name</label>
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-12 mt-md-3">
                                                                    <div class="form-floating">
                                                                        <input name="description" required type="text"
                                                                            class="form-control"
                                                                            value="{{$promotion->description}}"
                                                                            id="floatingPromotionCode"
                                                                            placeholder="description">
                                                                        <label for="floatingPromotionCode">description</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mt-md-3">
                                                                    <div class="form-floating">
                                                                        <select name="discount_type" required
                                                                            class="form-select"
                                                                            id="floatingDiscountType"
                                                                            aria-label="Discount Type">
                                                                            <option value="percentage" @if($promotion->
                                                                                discount_type == 'percentage') selected
                                                                                @endif>Percentage</option>
                                                                            <option value="fixed" @if($promotion->
                                                                                discount_type == 'fixed') selected
                                                                                @endif>Fixed Amount</option>
                                                                        </select>
                                                                        <label for="floatingDiscountType">Discount
                                                                            Type</label>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-12 mt-md-3">
                                                                    <div class="form-floating">
                                                                        <input name="discount_value" required
                                                                            type="number" step="0.01"
                                                                            class="form-control"
                                                                            value="{{$promotion->discount_value}}"
                                                                            id="floatingDiscountValue"
                                                                            placeholder="Discount Value">
                                                                        <label for="floatingDiscountValue">Discount
                                                                            Value</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mt-md-3">
                                                                    <div class="form-floating">
                                                                        <input name="minimum_purchase" required
                                                                            type="number" step="0.01"
                                                                            class="form-control"
                                                                            value="{{$promotion->minimum_purchase}}"
                                                                            id="floatingMinimumPurchase"
                                                                            placeholder="Minimum Purchase">
                                                                        <label for="floatingMinimumPurchase">Minimum
                                                                            Purchase</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mt-md-3">
                                                                    <div class="form-floating">
                                                                        <input name="start_date" required type="date"
                                                                            class="form-control"
                                                                            value="{{$promotion->start_date}}"
                                                                            id="floatingStartDate"
                                                                            placeholder="Start Date">
                                                                        <label for="floatingStartDate">Start
                                                                            Date</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 mt-md-3">
                                                                    <div class="form-floating">
                                                                        <input name="end_date" required type="date"
                                                                            class="form-control"
                                                                            value="{{$promotion->end_date}}"
                                                                            id="floatingEndDate" placeholder="End Date">
                                                                        <label for="floatingEndDate">End Date</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Save
                                                                    Changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            {{-- end model for edit now --}}
                                            {{-- sarte button delect in promotion --}}
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#ModalDelete{{$promotion->id}}">
                                                Delete
                                            </button>
                                            <form enctype="multipart/form-data"
                                                action="{{ route('promotion.destroy', $promotion->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal fade" id="ModalDelete{{$promotion->id}}" tabindex="-1"
                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                    Delete
                                                                    promotion
                                                                </h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">Are you sure you want to delete
                                                                <b>{{$promotion->name}}</b>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Save
                                                                    changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            {{-- end sarte button delect in promotion --}}
                                        </div>
                                    </td>
                                </tr>

                                <!--
                                    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('Product Delete')}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal body">Are you sure you want to delete
                                                    <b></b>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn gray btn-outline-secondary"
                                                        data-dismiss="modal">{{__('Cancel')}}</button>
                                                    <button type="button"
                                                        class="btn btn-outline-danger">{{__('Delete')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                                @endforeach

                            </tbody>
                        </table>
                        <!-- small modal -->
                    </div>
                </div>

                <script>
                    $('table[data-form="deleteForm"]').on('click', '.form-delete', function (e) {
                        e.preventDefault();
                        var $form = $(this);
                        $('#confirm').modal({
                            backdrop: 'static',
                            keyboard: false
                        })
                            .on('click', '#delete-btn', function () {
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
