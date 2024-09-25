@include ('partials/head');
<script src="{{asset('assets/vendor/jQuery3.7/jQuery.js')}}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
    $(function(){
           $("#hidewhenadd").hide();
            $("#addcategory").show();
               $("#totalpos").hide();
               $("#btn_submit_deforvalues").hide();
     // create function total
           $(".floatoptionvalues #qtyval").on('change', function(){
            totalproduct();
           });
           // create function jquery
           $(".selectoptioninputval #priceproduct").on('change', function(){
            totalproduct();
           });
                  // create function total
                  // create even change in
                  $(".selectoptioninputval #discount_pro").on('change', function(){
                        totalproduct();
                    });
                  // end create even change in even
                  function totalproduct(){
                    var qty_product= $("#qtyval").val();
                    var price_product =  $("#priceproduct").val();
                    var discount_product=    $("#discount_pro").val();
                    var discount_pro = discount_product/100;
                     var disnewproductold=qty_product*price_product*discount_pro;
                     var  product_total_new = qty_product*price_product- disnewproductold;
                    var total = parseFloat(product_total_new);
                    var valuesoptiontoal = $("#totalproduct").val(total).prop('disabled', true);
                  }
                  // add function jquery
                         // add insert in laravel
                         $("#btn_submit").click(function(e){
                                         e.preventDefault();
                                    var approduct=$("#addproduct").val();
                                    var form_date_values=$(".form-date-values").val();
                                     var qty_product= $("#qtyval").val();
                                      var price_product =  $("#priceproduct").val();
                                      var totalvalues_product = $("#totalproduct").val();
                                 var discount_product=    $("#discount_pro").val();

                                     var barcode_product=  $("#barcodeproduct").val();
                                      var select_option =     $(".value-select-option select").val();
                                  // add add stock in
                                  $.post('/product/stock_in/product/add_stock_in', {
                                    form_date_values:form_date_values,
                                    approduct:approduct,
                                    qty_product:qty_product,
                                    price_product:price_product,
                                    totalvalues_product:totalvalues_product,
                                    select_option:select_option,
                                    barcode_product:barcode_product,
                                    discount_product:discount_product,
                                        }, function(result) {
                                         if(result==1){

                                            $("#alert").show("1000");
                                          $("#btn-get-resart").click(function(){
                                            window.location.href = '{{ route("product.stock_in") }}';
                                          });
                                 //
                                         }

                                        });
                                   // add add stock in
                                            });
                                //        // add insert in laravel
                                // add button to insert stock in
                                   $("#btn_submit_deforvalues").click(function(e){
                                    e.preventDefault();

                                        var discount_product=    $("#discount_pro").val();
                                    var form_date_values=$(".form-date-values").val();
                                    var form_select_product=$(".form-select-product").val();
                                    var select_option_category =  $("#Category").val();
                                    var qty_product= $("#qtyval").val();
                                    var price_product =  $("#priceproduct").val();
                                    var product_totalqty=$("#totalposval").val();
                                    var barcodeproduct =$("#barcodeproduct").val();
                            // remouve product in form select
                                        $.post('/product/stock_in/product/delect', {
                                            form_select_product:form_select_product
                                    }, function(result) {

                                    });
                              // end remove product in form select
                                    $.post('/product/stock_in/product/add_stock_inpos', {
                                        form_date_values:form_date_values,
                                        form_select_product:form_select_product,
                                        select_option_category:select_option_category,
                                        qty_product:qty_product,
                                        price_product:price_product,
                                        product_totalqty:product_totalqty,
                                        barcodeproduct:barcodeproduct,
                                        discount_product:discount_product
                                        }, function(result) {
                                            if(result==1){
                                          $("#alert").show("1000");
                                          $("#btn-get-resart").click(function(){
                                            window.location.href = '{{ route("product.stock_in") }}';
                                          });
                                         }
                                        });

                                   })
                                // add button to insert stock in
        $(".form-floating select").on('change paste keyup',function(){
                  var val_show_item=   $(".form-select-product").val();
                // add condition
                 if(val_show_item=="0"){
                    var category =     $("#Category").val("");
                       $("#qtyval").val("");
                       var totalvalues_product = $("#totalproduct").val("");
                                   $("#discount_pro").val("");

                       $("#priceproduct").val("");
                      var valuesoption =     $(".value-select-option select").val();
                         $("#barcodeproduct").val("0");
                         // true pop
                          $("#Category").prop('disabled', false);
                           $("#qtyval").prop('disabled', false);
                          $("#priceproduct").prop('disabled', false);
                         $("#barcodeproduct").prop('disabled', false);
                            $("#resposive-addproduct").show();
                            $("#addcategory").show();
                              $("#hidewhenadd").hide();
                            // add total
                              $("#totalwhenhid").show();
                               $("#totalpos").hide();
                              $("#btn_submit").show();
                              $("#btn_submit_deforvalues").hide();
                              // add product
                                $("#discount_pro").prop('disabled', false);

                     }
                $.post('/product/stock_in/product/search', {
                    val_show_item:val_show_item,
                        }, function(result) {

                        //   var myObject = Object.assign({}, result);
                            // console.log(result);

                        $.each(result, function(index, item) {
                            //    Access properties of each item in the array
                            //  console.log('ID: ' + item.product_name);
                            $("#Category").val(item.category_name);
                            $("#Category").prop('disabled', true);
                          var qty_product =  $("#qtyval").val(item.product_qty);
                          var qtyprice =  $("#qtyval").prop('disabled', true);
                             var product_price=   $("#priceproduct").val(item.product_price);
                                  $("#priceproduct").prop('disabled', true);
                               $("#barcodeproduct").val(item.product_code);
                                $("#barcodeproduct").prop('disabled', true);
                                // add new resposive
                                $("#resposive-text").addClass("col-md-12");
                              $("#resposive-addproduct").hide();
                              $("#addcategory").hide();
                              $("#hidewhenadd").show();
                              // add product total hide
                               $("#totalwhenhid").hide();
                               $("#totalpos").show();
                               // add totoal pos
                         var total_pro=      $("#totalposval").val(item.product_total);
                               $("#totalposval").prop('disabled', true);
                               $("#btn_submit").hide();
                              $("#btn_submit_deforvalues").show();
                              $("#totalhide").hide();
                              //add discount_pro product in laravel
                             // var discount_product=


                              $("#discount_pro").val(item.product_discount);
                                $("#discount_pro").prop('disabled', true);
                            });
                        });
                })
                // add values condition


    })
</script>
<body>

    <!-- ======= Header ======= -->
    @include ('partials/header');

    <!-- ======= Sidebar ======= -->
    @include ('partials/aside');
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Add New Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Add New Stock In Order product constomer</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                   {{-- alert sussuce now --}}
                   <div id="alert" style="display:none;">
                   <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Successfully added the Stock In Order product
                    <button type="button" class="btn-close" id="btn-get-resart" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>
                      </div>
                   {{-- alert sussuce now --}}
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Add New Stock In</h5>
                                <!-- Floating Labels Form -->
                                <form class="row g-3" method="post">
                                    @csrf
                                    <div class="col-md-6" id="resposive-text">
                                        <div class="form-floating">
                                            <input required type="date" class="form-control form-date-values" id="floatingName" name="product_name" placeholder="input date">
                                            <label for="floatingName">Date</label>
                                        </div>
                                    </div>
                                {{-- add new resposive_text --}}
                                     <div class="col-md-6" id="resposive-addproduct">
                                        <div class="form-floating">
                                            <input required type="text" id="addproduct" class="form-control" id="floatingName" name="product_name" placeholder="input date">
                                            <label for="floatingName">Add product</label>
                                        </div>
                                    </div>
                                 {{-- add new resposive_text --}}
                                    <div class="col-md-6 old_add_category_div">
                                        <div class="form-floating mb-3">
                                            <select class="form-select form-select-product" required id="floatingSelect" name="category_id" aria-label="Category">
                                             <option selected value="0">Add Or Select product</option>
                                                @foreach ($product as $itemproduct)
                                                <option value="{{$itemproduct->product_name}}">{{$itemproduct->product_name}}</option>
                                                @endforeach
                                               <label for="floatingSelect">Select product</label>
                                        </select>
                                        </div>
                                    </div>

                                    {{-- add select product category--}}
                                   <div class="col-md-6 old_add_category_div" id="hidewhenadd">
                                        <div class="form-floating mb-3">
                                            <input id="Category" required type="text" class="form-control" id="floatingEmail" name="product_price" placeholder="product total">
                                            <label for="floatingEmail">Category</label>
                                        </div>
                                    </div>
                                      {{-- add select product category --}}
                                      <div class="col-md-6 old_add_category_div" id="addcategory">
                                            <div class="form-floating  value-select-option mb-3">
                                            <select class="form-select" required id="floatingSelect" name="category_id" aria-label="Category">
                                                @foreach($categories as  $itemcategories)
                                                <option value="{{$itemcategories->category_name}}">{{$itemcategories->category_name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="floatingSelect"> Category</label>
                                        </div>
                                    </div>
                                       {{-- add select product category --}}
                                    <div class="col-md-6">
                                        <div class="form-floating floatoptionvalues">
                                            <input id="qtyval" required type="number" class="form-control" id="floatingEmail" name="product_price" placeholder="product total">
                                            <label for="floatingEmail">Qty</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <div class="form-floating selectoptioninputval mb-3">
                                                <input id="priceproduct" required type="number" class="form-control" id="floatingEmail" name="product_price" placeholder="product total">
                                                <label for="floatingEmail">	Price</label>
                                            </div>
                                        </div>
                                    </div>
                                       {{-- add discount --}}
                                       <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <div class="form-floating selectoptioninputval mb-3">
                                                <input id="discount_pro" required type="number" class="form-control" id="floatingEmail" name="product_price" placeholder="product total">
                                                <label for="floatingEmail">Discount</label>
                                            </div>
                                        </div>
                                    </div>
                                     {{--  add discount --}}
                                   {{-- add totalproduct --}}
                                       <div class="col-md-6" id="totalwhenhid">
                                        <div class="form-floating mb-3">
                                            <div class="form-floating mb-3">
                                                <input id="totalproduct" required type="number" class="form-control" id="floatingEmail" name="product_price" placeholder="product total">
                                                <label for="floatingEmail">total</label>
                                            </div>
                                        </div>
                                    </div>
                                  {{-- add totalproduct --}}
                                  {{-- add totalproduct --}}
                                       <div class="col-md-6" id="totalpos">
                                        <div class="form-floating mb-3">
                                            <div class="form-floating mb-3">
                                                <input id="totalposval" required type="number" class="form-control" id="floatingEmail" name="product_price" placeholder="product total">
                                                <label for="floatingEmail"> total</label>
                                            </div>
                                        </div>
                                    </div>
                                  {{-- add totalproduct --}}
                                    {{-- <div class="col-md-4 add_category_div">
                                        <div class="form-floating">
                                            <input type="text" required class="form-control" id="floatingPassword" name="new_category" placeholder="New Category Name">
                                            <label for="floatingPassword">New Category Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 py-2 cancel_category_btn">

                                        <a class="btn btn-danger cancel-category-btn">x</a>
                                    </div> --}}

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input required id="barcodeproduct" class="form-control" type="text" id="floatingcode" name="product_code" placeholder="Product code">
                                            <label for="floatingcode">Barcode product</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <button type="button" id="btn_submit" class="btn btn-primary"> Submit</button>
                                        <button type="button" id="btn_submit_deforvalues" class="btn btn-primary">Submit</button>
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
