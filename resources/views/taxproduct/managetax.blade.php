@include ('partials/head');
<script src="{{asset('assets/vendor/jQuery3.7/jQuery.js')}}"></script>
<script>
$(document).on('keyup', '[data-min_max]', function(e){
    var min = parseInt($(this).data('min'));
    var max = parseInt($(this).data('max'));
    var val = parseInt($(this).val());
    if(val > max)
    {
        $(this).val(max);
        $(this).val("");
        return false;
    }
    else if(val < min)
    {
        $(this).val(min);
        return false;
    }
});

$(document).on('keydown', '[data-toggle=just_number]', function (e) {
    // Allow: backspace, delete, tab, escape, enter and .
    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
         // Allow: Ctrl+A
        (e.keyCode == 65 && e.ctrlKey === true) ||
         // Allow: Ctrl+C
        (e.keyCode == 67 && e.ctrlKey === true) ||
         // Allow: Ctrl+X
        (e.keyCode == 88 && e.ctrlKey === true) ||
         // Allow: home, end, left, right
        (e.keyCode >= 35 && e.keyCode <= 39)) {
             // let it happen, don't do anything
             return;
    }
    // Ensure that it is a number and stop the keypress
    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
        e.preventDefault();
    }
});
$('#nametax').unbind('keyup change input paste').bind('keyup change input paste',function(e){
    var $this = $(this);
    var val = $this.val();
    var valLength = val.length;
    var maxCount = $this.attr('maxlength');
    if(valLength>maxCount){
        $this.val($this.val().substring(0,maxCount));
    }
});
</script>

<body>

    <!-- ======= Header ======= -->
    @include ('partials/header');

    <!-- ======= Sidebar ======= -->
    @include ('partials/aside');

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Manage Tax</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Manage Ca</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                {{-- @if(session()->has('message'))
                <div class="alert alert-success align-items-center d-flex justify-content-between">

                    <div>
                        {{ session('message') }}

                    </div>
                    <div><a style="font-weight: 700;" class="btn btn-success" href="{{url('product/add_product')}}">Add
                            new
                            product</a></div>

                </div>
                @endif --}}
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
                                <h5 class="card-title">All tax name </h5>

                                    {{-- <a href="{{url('product/grid_view')}}" class="btn btn-success ">Grid View <i class="bi bi-grid-3x2"></i></a> --}}

                                </div>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>

                                            <th scope="col">Tax Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($taxproduct as $itemtax)

                                        <tr  class="align_tr">
                                            <th scope="row">{{$itemtax->id_tex}}</th>

                                            <td>{{$itemtax->nametax}}</td>
                                            <td>{{$itemtax->price_tax}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                     <button class="btn btn-primary" type="button"  data-bs-toggle="modal" data-bs-target="#ModalEdit{{$itemtax->id_tex}}">Edit</button>
                                                     {{-- create model for edit now --}}
                                                           <form action="{{ route('tax.update', ['tax' => $itemtax->id_tex]) }}" autocomplete="off" method="POST">
                                                        {{-- @method('update') --}}
                                                         @csrf
                                                          @method('PUT')
                                                            <div class="modal fade" id="ModalEdit{{$itemtax->id_tex}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                                Edit
                                                                                product
                                                                            </h1>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="catid" value="{{$itemtax->id_tex}}">
                                                                            <div class="col-md-12">
                                                                                <div class="form-floating">
                                                                                    <input name="nametax" required type="text" id="nametax" maxlength="20" class="form-control" value="{{$itemtax->nametax}}" id="floatingName" name="tax_name" placeholder="Product Name">
                                                                                    <label for="floatingName">Tax Name</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-12 mt-md-3">
                                                                                <div class="form-floating">
                                                                                    <input name="price_tax" data-min_max data-min="0" data-max="100" data-toggle="just_number" id="pricesetting" required type="number" class="form-control" value="{{$itemtax->price_tax*100}}" id="floatingName" name="pricetax" placeholder="Product Name">
                                                                                    <label for="floatingName">Price</label>
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
                                                     {{-- sarte button delect in tax --}}
                                                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDelete{{$itemtax->id_tex}}">
                                                      Delete
                                                    </button>
                                                        <form enctype="multipart/form-data" action="{{ route('tax.destroy', $itemtax->id_tex) }}" method="POST">
                                                           @csrf
                                                    @method('DELETE')
                                                            <div class="modal fade" id="ModalDelete{{$itemtax->id_tex}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                            <b>{{$itemtax->nametax}}</b>
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
                                                     {{-- end sarte button delect in tax --}}
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
