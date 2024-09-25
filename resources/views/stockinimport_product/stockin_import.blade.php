@include ('partials/head');
<script src="{{asset('assets/vendor/jQuery3.7/jQuery.js')}}"></script>
  <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $(function(){
          $("#tablestock_in  tbody tr td").on('click','.update',function(){
         // var x=  $("#tablestock_in tr td").val();
           var current_row = $(this).closest("tbody  tr");
            var idrowstockin = current_row.find("td").eq(0).text();
            // item port iterm
            $.post('/stock_in/manage_product_stock_in/update_stockin', {
                  idrowstockin:idrowstockin
                }, function(result) {
                   if(result==idrowstockin){
                       window.location.href = 'user/user.php?val=nnnn';
                   }
                });
             // item port iterm
          })
         })

    </script>
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
            @if(session()->has('success'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
                <!-- Left side columns -->
                <div class="col-lg-12" id="cardhidetable">
                    <div class="row">
                        <div class="card overflow-auto">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">All Category </h5>

                                    {{-- <a href="{{url('product/grid_view')}}" class="btn btn-success ">Grid View <i class="bi bi-grid-3x2"></i></a> --}}
                                </div>
                                <table class="table table-borderless datatable" id="tablestock_in">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Image product stockin </th>
                                            <th scope="col">Name product stockin</th>
                                            <th scope="col">price product stockin</th>
                                            <th scope="col">qty product stockin</th>
                                            <th scope="col">Total product stockin</th>
                                            <th scope="col"> category stockin</th>
                                            <th scope="col">Supplies stockin</th>
                                            <th scope="col">Barcode product stockin</th>
                                               <th scope="col">Date srate</th>
                                                <th scope="col">Date Exprie</th>
                                            <th scope="col">Options stockin</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        @foreach ( $stock_in_import as $itemstockin)

                                        <tr  class="align_tr">
                                            <th scope="row">{{$itemstockin->id_stock_in_import}}</th>
                                            <td  style="background-color:none !important">
                                                @if (!empty($itemstockin->image_productstockin))
                                                <img src="{{url('upload/stockin_image/'.$itemstockin->image_productstockin)}}" id="product" width="50px" height="50px" alt="Profile" >
                                                @else
                                                <img src="{{url('upload/noimage.jpg') }}" alt="Profile"  id="product" width="50px" height="50px" >

                                                 @endif
                                            </td>
                                            <td>{{$itemstockin->stockin_imporn}}</td>
                                            <td>{{$itemstockin->stockin_price}}</td>
                                               <td>{{$itemstockin->stockin_qty}}</td>
                                               <td>{{$itemstockin->total_product}}</td>
                                               <td>{{$itemstockin->category_name}}</td>
                                               <td>{{$itemstockin->supplier_name}}</td>
                                                <td>{!! DNS1D::getBarcodeHTML("$itemstockin->barcode_import", 'C128')!!} <span class="text-secondary">{{$itemstockin->barcode_import}}</span></td>
                                                <td>
                                                    @if($itemstockin->date_import)
                                                       @php
                                                           $datesrate=$itemstockin->date_import;
                                                           $time = strtotime($datesrate);
                                                      $newformat = date('Y-m-d',$time);
                                                      echo $newformat;
                                                       @endphp
                                                    @endif
                                                </td>
                                                     <td>{{$itemstockin->dateexpire}}</td>
                                                <td>
                                                <div class="d-flex gap-2">
                                                    {{-- <a href="#" id="btnstockin" class="btn btn-primary update" type="button" value="{{$itemstockin->id}}" >Edit</a> --}}
                                                   <form action="{{route('list.stock.in.import.update')}}" method="post">
                                                    @csrf
                                                            <input type="hidden" id="custId" name="itemstockin" value="{{$itemstockin->id_stock_in_import}}">
                                                             {{-- <input type="hidden" id="custId" name="itemstocatgory" value="{{$itemstockin->category_import}}"> --}}
                                                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal">
                                                        Edite
                                                    </button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalDeleteimoport{{$itemstockin->id_stock_in_import}}">
                                                        Delete
                                                      </button>
                                                         {{-- sarte button delect in tax --}}
                                      <form action="{{ route('list.stock.in.import.delete', $itemstockin->id_stock_in_import) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal fade" id="ModalDeleteimoport{{$itemstockin->id_stock_in_import}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                 {{-- end sarte button delect in tax --}}


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
                </div>
                <!-- End Left side columns -->

                <!-- Right side columns -->

            </div><!-- End Right side columns -->


        </section>

    </main><!-- End #main -->

    @include ('partials/footer');
