@include ('partials/head');
<script src="{{asset('assets/vendor/jQuery3.7/jQuery.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function(){

  // date

               // Calculate the date range for allowing dates from today to +N days
            var today = new Date();
         //   var maxDate = new Date();
            var numberOfDaysToAdd = 30; // Change this number as needed
          // maxDate.setDate(today.getDate() + numberOfDaysToAdd);
            $("#datepicker").datepicker({
                minDate: 0, // 0 means today
             //  maxDate: maxDate,

                dateFormat: 'yy-mm-dd', // Change the date format as needed
            });
  // end date


     $("#importproductpriceupdate").on('change keydown keyup', function(){
      totalproduct();
     });

            $("#qtyproductimport").on('change keydown keyup', function(){
              totalproduct();
              });

    function totalproduct(){
      var pricedata=$("#importproductpriceupdate").val();
     var qtyproductdata =$("#qtyproductimport").val();
    var tottal = parseFloat(pricedata)*parseFloat(qtyproductdata);
    var alltotalimport = parseFloat(tottal).toFixed(2);
    $("#totalproduct").val(alltotalimport);
    }


          // add Allow numbers (0-9), Enter (keyCode 13), Delete (keyCode 46), and Backspace (keyCode 8)
        $(document).ready(function() {
            $("#importproductpriceupdate").select(function(){
                  $('#importproductpriceupdate').val("");
                    });
            $('#importproductpriceupdate').on('keydown paste cut copy', function(event) {
                if ((event.which >= 48 && event.which <= 57) || event.which === 13 || event.which === 8 || isSymbolKey(event)) {
                return true; // Allow the key press
                } else {
                event.preventDefault(); // Prevent input of other characters
                return false;
                }
            });
            function isSymbolKey(event) {
                const symbolKeys = [37, 38, 39, 40, 45, 46, 47, 95, 190]; // Added keyCode for the period (.)
                return symbolKeys.includes(event.which);
            }
                });
       // add Allow numbers (0-9), Enter (keyCode 13), Delete (keyCode 46), and Backspace (keyCode 8)

          // add  // add Allow numbers (0-9), Enter (keyCode 13), Delete (keyCode 46), and Backspace (keyCode 8) end
          // add even to javascript
            $(document).on('keyup', '[data-min_max]', function(e){
                var min = parseInt($(this).data('min'));
                var max = parseInt($(this).data('max'));
                var val = parseInt($(this).val());
                if(val > max)
                {
                    $(this).val("");
                    $(".invalid-number").show();
                    $(".invalid-number-two").show();
                    return false;
                }
                else if(val < min)
                {
                    $(this).val(min);
                    return false;
                }
            });
          // end number event
          // start number condition
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



    })


</script>
<body>

    <!-- ======= Header ======= -->
    @include ('partials/header');

    <!-- ======= Sidebar ======= -->
    @include ('partials/aside');
    @foreach ($productimportupdate as $product)
    <main id="main" class="main">

        <div class="pagetitle">

            <h1>
                {{ $product->namepro_import }}

            </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">
                        {{ $product->namepro_import }}
                        </h1>
                    </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->


        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Edit product</h5>


                                @if(session()->has('message'))
                                <div class="alert alert-success align-items-center d-flex justify-content-between">

                                    <div>
                                        {{ session('message') }}

                                    </div>
                                    <div><a style="font-weight: 700;" class="btn btn-success" href="{{url('/import_product/add_product/view_product')}}">Check
                                            product</a></div>

                                </div>
                                @else

                                @endif
{{--
                                @if(session()->has('barcode'))
                                <div class="alert alert-danger align-items-center d-flex justify-content-between">

                                    <div>
                                        {{ session('barcode') }}

                                    </div>
                                    @php
                                    $product_code = session('product_code');
                                    @endphp

                                    <div><a style="font-weight: 700;" class="btn btn-primary" href="{{url('product/manage_product/')}}">Edit
                                            product {{$product_code}} </a></div>

                                </div>

                                    @endif --}}
                                <div class="d-flex justify-content-center mb-3">
                                    @if (!empty($product->image_product))
                                    <img src="{{url('upload/products/'.$product->image_product)}}" id="product" width="400px" height="400px" alt="Profile" >
                                    @else
                                    <img src="{{url('upload/noimage.jpg') }}" alt="Profile"  id="product" width="400px" height="400px" >

                                     @endif
                                </div>
                                <!-- Floating Labels Form -->
                                <form class="row g-3" method="post" action="{{route('import.product.edit')}}" enctype="multipart/form-data">
                                    @csrf
                                    <!-- <img src="" alt=""> -->
                                    <input required type="hidden" class="form-control" id="floatingName" name="idproduct" value="{{$product->id_importpro}}" placeholder="Product Name">
                                    <div class="col-md-12">
                                        <div class="form-floating" id="pricedata">
                                            <input required type="text" class="form-control" id="floatingName" name="product_name" value="{{$product->namepro_import}}" placeholder="Product Name">
                                            <label for="floatingName">Product Name import</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input required type="text"  data-min_max data-min="0" data-max="1000000000000000" id="importproductpriceupdate"  value="{{$product->proprice_import}}" class="form-control" id="floatingEmail" name="product_price" placeholder="Product Price">
                                            <label for="floatingEmail">Product import Price</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" value="{{$product->progty_import}}" data-min_max data-min="0" data-max="1000000000000000" required class="form-control" id="qtyproductimport" id="floatingPassword" name="product_qty" placeholder="Product qty">
                                            <label for="floatingPassword">Product Import qty</label>

                                        </div>

                                        @endforeach
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">

                                            <select class="form-select" required id="floatingSelect" name="category_id" aria-label="Category">
                                                @foreach ($category as $cat)
                                                @if ($cat->catid == $product->procate_import)
                                                <option selected value="{{$cat->catid}}">
                                                    {{ $cat->category_name}}
                                                </option>
                                                @else
                                                <option value="{{$cat->catid}}">
                                                    {{ $cat->category_name}}
                                                </option>
                                                @endif



                                                @endforeach
                                            </select>
                                            <label for="floatingSelect"> Import Category</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating mb-3">

                                            <select class="form-select" required id="floatingSelect" name="supplier_id" aria-label="Category">
                                                @foreach ($suppliers as $supplier)

                                                @if ($supplier->id == $product->prosupp_import)
                                                <option selected value="{{$supplier->id}}">
                                                    {{ $supplier->supplier_name}}
                                                </option>
                                                @else
                                                <option  value="{{$supplier->id}}">
                                                    {{ $supplier->supplier_name}}
                                                </option>
                                                @endif



                                                @endforeach
                                            </select>
                                            <label for="floatingSelect"> Import Category</label>
                                        </div>
                                    </div>
                                      <input type="hidden"  name="dateimport" value="{{$product->date_import}}">
                                     <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text"  value="{{$product->total_product}}" data-min_max data-min="0" data-max="1000000000000000"  required class="form-control" id="totalproduct" id="floatingPassword" name="product_total" placeholder="Product total">
                                            <label for="floatingPassword">Product import Total</label>

                                        </div>

                                    <div class="col-md-8">

                                        <div class="col-md-8 col-lg-9">
                                            <label for="product">Product Import Image</label>

                                          <input name="product_change" type="file" class="form-control" id="productchange" >

                                        </div>
                                      </div>
                                      <div class="text-center mb-3">
                                        @if (!empty($product->image_product))
                                        <img src="{{url('upload/products/'.$product->image_product)}}" id="showproducts" width="100px" height="100px" alt="Profile" >
                                              @else
                                        <img src="{{url('upload/noimage.jpg') }}" alt="Profile"  id="showproducts" width="100px" height="100px" >

                                          @endif
                                      </div>

                                    <hr>

                                    @foreach ($productimportupdate as $product)
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="floatingcode" name="product_code" value="{{$product->barcodepro_import}}" placeholder="Product code">
                                            <label for="floatingcode">Product Import code</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex   flex-column align-items-center">
                                               {!! DNS1D::getBarcodeHTML("$product->barcodepro_import",  'C128') !!}
                                           <p> {{$product->barcodepro_import  }}</p>
                                        </div>
                                    </div>

                                    <hr>
                                      <div class="col-md-12">
                                        <div class="form-floating">
                                            <input required type="text" class="form-control" id="datepicker" id="floatingcode" name="product_dateexprice" value="{{$product->dateexpire}}" placeholder="Product code">
                                            <label for="floatingcode">Product expire date</label>
                                        </div>
                                    </div>
                                     <hr>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" >Edit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </form><!-- End floating Labels Form -->

                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->

                <script type="text/javascript">
                    $(document).ready(function(){
                      $('#productchange').change(function(e){
                        var reader = new FileReader();
                        reader.onload = function(e){
                          $('#showproducts').attr('src', e.target.result);
                        }
                          reader.readAsDataURL(e.target.files['0']);
                      });
                    });
                  </script>
            </div>
        </section>
        @endforeach
    </main><!-- End #main -->
    @include ('partials/footer');
