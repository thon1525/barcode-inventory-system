@include ('partials/head');

<body>

    <!-- ======= Header ======= -->
    @include ('partials/header');

    <!-- ======= Sidebar ======= -->
    @include ('partials/aside');

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Manage coupon</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Ca</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


                {{-- @foreach($coupons as $coupon) --}}
<div>

    <a style="font-weight: 700;" class="btn btn-success mb-3" href="{{ url('product/add_product') }}" type="button" data-bs-toggle="modal" data-bs-target="#ModalCreate">Add new coupon</a>
</div>



                             {{-- create model for Create now --}}
                                                           <form action="{{ route('coupon.store') }}" autocomplete="off"  method="POST">
                                                        {{-- @method('update') --}}
                                                         @csrf
                                                            <div class="modal fade" id="ModalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                                Add
                                                                                Coupon
                                                                            </h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <div class="col-md-12">
                                                                                <div class="form-floating">
                                                                                    <input name="coupon_code" required type="text" class="form-control" id="floatingName"  placeholder="coupon_code">
                                                                                    <label for="floatingName">coupon Code</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 mt-md-3">
                                                                                <div class="form-floating">
                                                                                    <input name="discount_percentage" required type="number" class="form-control" id="floatingName"  placeholder="discount_percentage">
                                                                                    <label for="floatingName">discount_percentage</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 mt-md-3">
                                                                                <div class="form-floating">
                                                                                    <input name="expiration_date" required type="date" class="form-control" id="floatingName"  placeholder="expiration_date">
                                                                                    <label for="floatingName">expiration_date</label>
                                                                                </div>
                                                                            </div>
                                                                             <div class="col-md-12 mt-md-3">
                                                                                <div class="form-floating">
                                                                                    <input name="usage_limit" required type="number" class="form-control"  id="floatingName"  placeholder="usage_limit">
                                                                                    <label for="floatingName">usage_limit</label>
                                                                                </div>
                                                                            </div>
                                                                            <b></b>
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

                {{-- @endforeach --}}
                                                     {{-- end model for create now  --}}
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
                                <h5 class="card-title">All coupons  </h5>

                                    {{-- <a href="{{url('product/grid_view')}}" class="btn btn-success ">Grid View <i class="bi bi-grid-3x2"></i></a> --}}

                                </div>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>

                                            <th scope="col">Coupon Code</th>
                                            <th scope="col">Discount_Percentage</th>
                                            <th scope="col">Expiration</th>
                                             <th scope="col">Usage Limit</th>
                                               <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $coupon)

                                        <tr  class="align_tr">
                                            <th scope="row">{{$coupon->id}}</th>

                                            <td>{{$coupon->coupon_code}}</td>
                                            <td>{{$coupon->discount_percentage}}</td>
                                             <td>{{$coupon->expiration_date}}</td>
                                            <td>{{$coupon->usage_limit}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                     <button class="btn btn-primary" autocomplete="off" type="button"  data-bs-toggle="modal" data-bs-target="#ModalEdit{{$coupon->id}}">Edit</button>
                                                     {{-- create model for edit now --}}
                                                           <form action="{{ route('coupon.update', ['coupon' => $coupon->id]) }}"  method="POST">
                                                        {{-- @method('update') --}}
                                                         @csrf
                                                          @method('PUT')
                                                            <div class="modal fade" id="ModalEdit{{$coupon->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                                Edit
                                                                                Coupon
                                                                            </h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="catid" value="{{$coupon->id}}">
                                                                            <div class="col-md-12">
                                                                                <div class="form-floating">
                                                                                    <input name="coupon_code" required type="text" class="form-control" value="{{$coupon->coupon_code}}" id="floatingName"  placeholder="coupon_code">
                                                                                    <label for="floatingName">coupon Code</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 mt-md-3">
                                                                                <div class="form-floating">
                                                                                    <input name="discount_percentage" required type="number" class="form-control" value="{{$coupon->discount_percentage}}" id="floatingName"  placeholder="discount_percentage">
                                                                                    <label for="floatingName">discount_percentage</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 mt-md-3">
                                                                                <div class="form-floating">
                                                                                    <input name="expiration_date" required type="date" class="form-control" value="{{$coupon->expiration_date}}" id="floatingName"  placeholder="expiration_date">
                                                                                    <label for="floatingName">expiration_date</label>
                                                                                </div>
                                                                            </div>
                                                                             <div class="col-md-12 mt-md-3">
                                                                                <div class="form-floating">
                                                                                    <input name="usage_limit" required type="number" class="form-control" value="{{$coupon->usage_limit}}" id="floatingName"  placeholder="usage_limit">
                                                                                    <label for="floatingName">usage_limit</label>
                                                                                </div>
                                                                            </div>
                                                                            <b></b>
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
                                                     {{-- end model for edit now  --}}
                                                     {{-- sarte button delect in coupon --}}
                                                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{$coupon->id}}">
                                                      Delete
                                                    </button>
                                                        <form enctype="multipart/form-data" action="{{ route('coupon.destroy', $coupon->id) }}" method="POST">
                                                           @csrf
                                                    @method('DELETE')
                                                            <div class="modal fade" id="ModalDelete{{$coupon->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                                Delete
                                                                                coupon
                                                                            </h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">Are you sure you want to delete
                                                                            <b>{{$coupon->coupon_code}}</b>
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
                                                     {{-- end sarte button delect in coupon --}}
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
