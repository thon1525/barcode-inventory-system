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

       // create product
       $(function(){

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

             // Calculate the date range for allowing dates from today to +N days
       // change price stokin
       $(".form-floating #importproductprice").change(function(){
        total();
       });
      // change qty product
      $(".form-floating #productimportqty").change(function(){
        total();
       });
        // create function total
        function total(){
            var importproductprice =   $("#importproductprice").val();
            var productimportqty= $("#productimportqty").val();
            var totalproductstockin=importproductprice*productimportqty;
            var total = parseFloat(totalproductstockin);
           $("#importprodutotal").val(total).prop('disabled', true);
        }
        // add btn submit
                (() => {
           'use strict'
                    const forms = document.querySelectorAll('.needs-validation')
                    Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                 //   event.preventDefault()
                   // event.stopPropagation()
                  if(form.checkValidity()==""){
                        var importpro=     $("#importpro").val("");
                        var importproductprice =   $("#importproductprice").val("");
                        var productimportqty= $("#productimportqty").val("");
                        var categoryproduct=   $("#categoryproduct").val("");
                        var addsupplierval=$("#addsupplierval").val("");
                        var productbarcode=$("#productbarcode").val("");
                        var importprodutotal=$("#importprodutotal").val("");
                     }
                     // addd eles
                  }
                    else{
                           var importpro=   $("#importpro").val();
                            var importproductprice =   $("#importproductprice").val();
                            var productimportqty= $("#productimportqty").val();
                            var categoryproduct=   $("#categoryproduct").val();
                            var addsupplierval=$("#addsupplierval").val();
                            var productbarcode=$("#productbarcode").val();
                            var importprodutotal=$("#importprodutotal").val();
                            var dateexpire=$('#datepicker').val();
                            // add product import
                             $.post('/import_product/add_product/add_import', {
                            importpro:importpro,
                            importproductprice:importproductprice,
                            productimportqty:productimportqty,
                            categoryproduct:categoryproduct,
                            addsupplierval:addsupplierval,
                            productbarcode:productbarcode,
                            importprodutotal:importprodutotal,
                            dateexpire:dateexpire,
                            }, function(result) {
                              if(result==1){
                                   $('.spinner-border').show();
                                    $('.spinner-border').removeClass('d-none');
                              }
                            });
                     }



                form.classList.add('was-validated')
                }, false)
            })
        })()
        // btn save

      //  end javasript bnt submit

      // add Allow numbers (0-9), Enter (keyCode 13), Delete (keyCode 46), and Backspace (keyCode 8)
        $(document).ready(function() {
            $('#importproductprice').on('keydown paste copy', function(event) {
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
         // add  // add Allow numbers (0-9), Enter (keyCode 13), Delete (keyCode 46), and Backspace (keyCode 8)
             $(document).ready(function() {
            $('#productimportqty').on('keydown paste copy', function(event) {
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
          // end number condition
       })


</script>
<body>

    // <!-- ======= Header ======= -->
    @include ('partials/header');

    // <!-- ======= Sidebar ======= -->
    @include ('partials/aside');
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add New import Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Add new import product</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                    {{-- load condition --}}
                        <div class="d-flex justify-content-center" id="loadingpro">
                            <div class="spinner-border d-none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            </div>
                    {{-- end load condition  --}}
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add New  Product</h5>
                                {{-- start add product import for ecommerce --}}
                              <form class="row g-3 needs-validation" autocomplete="off" novalidate>
                              {{-- add custom form  add import --}}
                                 <div class="col-12 form-floating">
                                    <input type="text" id="importpro" class="form-control" placeholder="add product import" id="validationCustom03" required>
                                        <label for="validationCustom03" class="form-label">Product Import</label>
                                    <div class="invalid-feedback">
                                    Please Enter product Import
                                    </div>
                                </div>
                              {{-- end custom import --}}
                                {{-- add custom form  add import price --}}
                                 <div class="col-6 form-floating">
                                    <input type="text" id="importproductprice" data-min_max data-min="0" data-max="1000000000000000" data-toggle="just_number"  class="form-control" placeholder="add product price" id="validationCustomprice" required>
                                        <label for="validationCustomprice" class="form-label">Product Import price</label>
                                    <div class="invalid-feedback">
                                    Please Enter product price
                                    </div>
                                         <P style="display: none;" class="invalid-number invalid-feedback">User can click 0 to 1000000000000</P>
                                </div>
                              {{-- end custom import price --}}
                               {{-- add custom form  add import qty --}}
                                 <div class="col-6 form-floating">
                                    <input type="text" class="form-control" id="productimportqty" data-min_max data-min="0" data-max="1000000000000000" data-toggle="just_number"  placeholder="add product qty" id="validationCustomqty" required>
                                        <label for="validationCustomqty" class="form-label">Product Import qty</label>
                                    <div class="invalid-feedback">
                                   Please Enter product qty
                                    </div>
                                       <P style="display: none;" class="invalid-number-two invalid-feedback">User can click 0 to 1000000000000</P>
                                </div>
                              {{-- end custom import qty --}}
                              {{-- add custom form  add import total  --}}
                              <div class="col-6 form-floating">
                                <input type="text" id="importprodutotal" Disabled data-min_max data-min="0" data-max="1000000000000000" data-toggle="just_number"  class="form-control" placeholder="add product price" id="validationCustomprice" required>
                                    <label for="validationCustomprice" class="form-label">Product Import total</label>
                                <div class="invalid-feedback">
                                Please Enter product price
                                </div>
                                     <P style="display: none;" class="invalid-number invalid-feedback">User can click 0 to 1000000000000</P>
                            </div>
                            {{-- end custom import total --}}
                             {{-- add product import category --}}
                                 <div class="col-6 form-floating">
                                        <select class="form-select" id="categoryproduct" id="validationselectoptioncate" required>
                                        <option selected value=""> Add category</option>
                                         @foreach($categories as $itemcate)
                                        <option value="{{$itemcate->catid}}"> {{$itemcate->category_name}} </option>
                                         @endforeach
                                        </select>
                                        <label for="validationselectoptioncate" class="form-label">Product Import category</label>
                                    <div class="invalid-feedback">
                                    Please enter category
                                    </div>
                                </div>
                             {{-- end add product import category --}}
                                  {{-- add product supplie import --}}
                                      <div class="col-6 form-floating">
                                        <select class="form-select" id="addsupplierval" id="validationselectoptionsupplier" required>
                                        <option selected value=""> Add supplie</option>
                                       @foreach($suppliers as $itemsupp)
                                        <option value="{{$itemsupp->id}}"> {{$itemsupp->supplier_name}} </option>
                                         @endforeach
                                        </select>
                                        <label for="validationselectoptionsupplier" class="form-label">Product Import supplie</label>
                                    <div class="invalid-feedback">
                                    Please select supplie
                                    </div>
                                </div>
                                   {{-- end product supplie import --}}
                                     {{-- add custom form  add import barcode--}}
                                 <div class="col-6 form-floating">
                                    <input type="text" id="productbarcode" class="form-control" placeholder="add product import" id="validationCustombarcode" required>
                                        <label for="validationCustombarcode" class="form-label">Product Import barcode</label>
                                    <div class="invalid-feedback">
                                    Please enter barcode
                                    </div>
                                </div>
                              {{-- end custom import barcode --}}
                                  {{-- add custom form  add date expire--}}
                                  <div class="col-12 form-floating">
                                    <input type="text" id="datepicker"  class="form-control" placeholder="add product import" id="validationCustombarcode" required>
                                        <label for="validationCustombarcode" class="form-label">date expire</label>
                                    <div class="invalid-feedback">
                                        date expire
                                    </div>
                                </div>
                              {{-- end custom import date expire --}}
                                <div class="col-12 ">
                                    <button class="btn btn-primary offset-5" type="submit" id="btn_saveimport">Submit form</button>
                                </div>
                                </form>
                                 {{-- end add product import for ecommerce --}}
                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->


            </div>
        </section>

    </main><!-- End #main -->

    @include ('partials/footer');
