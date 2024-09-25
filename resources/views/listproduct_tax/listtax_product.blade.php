@include ('partials/head');
<script src="{{asset('assets/vendor/jQuery3.7/jQuery.js')}}"></script>

    <!-- CDN for chosen plugin -->
<script src="{{asset('assets/vendor/chosen/chosen.js')}}"     crossorigin="anonymous"
          referrerpolicy="no-referrer"></script>

    <!-- CDN for multiselect jquery plugin -->
  <script src="{{asset('assets/vendor/multiselect/multi-select.min.js')}}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- CDN for CSS of chosen plugin -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
            // add condition ver


          // strate number condition
                       $(function(){


                        // hide spinner
                        $("#hidespinnercon").hide();
                            // hide element in jquery
                            $("#pricetaxproduct").hide();
                            $("#qtyproducttax").hide();
                            $("#taxproductdiscount").hide();
                            $("#totalproducttax").hide();
                        // $("#addtaxproduct").hide();
                            $("#showcategory").hide();
                            $("#showsupplier").hide();
                            // hide barcode in jquery
                            $("#hidebarcode").hide();
                            $("#selecttax").chosen({
                                    // This option restricts the number
                                    // of items for selection
                                    max_selected_options: 4,
                                    // This option keeps the dropdown
                                    // open till the selection
                                    hide_results_on_select: false,

                                });
                            // Event listener for Chosen plugin's change event
                            $(".form-floating #selecttax").on('change chosen:hiding_dropdown', function(evt, params) {
                                // Check if the dropdown is closed
                                if (params.deselected) {
                                    // Clear the selected data when the dropdown is closed
                                  $(this).val([]).trigger('chosen:updated');
                                  var add_tax_import =$(".formstockin_import #taxproduct_stock_import").val();
                                // add function in data
                                $.post('/add_producttax/insert_data_tax', {
                                  add_tax_import:add_tax_import
                                   }, function(result) {
                                    $.each(result, function(index, item) {
                                    //    Access properties of each item in the array
                                    //  console.log('ID: ' + item.product_name);
                                    //add price
                                $("#priceproducttax").val(parseFloat(item.stockin_price)).prop('disabled', true);
                                    $("#pricetaxproduct").show();
                                        //end price
                                        $("#qtyproducttax").show();
                                        $("#qtyproducttaxval").val(parseFloat(item.stockin_qty)).prop('disabled', true);
                                        // add qty
                                        // add discount
                                            $("#taxproductdiscount").show();
                                        // end discount
                                        // add total
                                        $("#totaltroductaxval").val(parseFloat(item.total_product)).prop('disabled', true);
                                            $("#totalproducttax").show();
                                        // end total
                                        var dis=  $("#taxproductexport").val();
                                          var disproduct=dis/100;
                                          var dis=  $("#totaltroductaxval").val(parseFloat(item.total_product)-parseFloat(item.total_product)*(disproduct));
                                        // add tax
                                            $("#addtaxproduct").show();
                                            $("#showcategory").show();
                                        // end tax
                                        // add category
                                    $("#categorytaxproduct").val(item.category_name).prop('disabled', true);
                                        $("#catedtaxproduct").val(item.catid);
                                        //   $("#categorytaxproduct").text(item.category_name);
                                        // end category
                                        // add supplies
                                        $("#showsupplier").show();
                                        $("#suppliestaxproduct").val(item.supplier_name).prop('disabled', true);
                                        $("#supplietaxid").val(item.id);
                                        // end supplies
                                    // add barcode product
                                        $("#hidebarcode").show();
                                        $("#barcodetaxproduct").val(item.barcode_import).prop('disabled', true);
                                        // hide datehide e
                                    $('#datehideelemt').val(item.dateexpire);
                                    // end barcode product



                                    });
                            });
                                // end function in data

                                }


                            });
               // create function tax product
               function  displaySumOfSelected(){

                       var selecttax=$(".form-floating #selecttax option:selected").val();
                      var qtyproducttaxval=$("#qtyproducttaxval").val();
                      var priceproducttax=$("#priceproducttax").val();
                               var selectedValues = [];
                                    // Find all selected options in the select element
                            $("#selecttax option:selected").each(function () {
                                // Push the value of each selected option into the array
                                selectedValues.push(parseFloat($(this).val()));
                            });

                            // Calculate the sum of selected values
                            var sum = selectedValues.reduce(function (a, b) {
                                return a + b;
                            }, 0);

                            // Display the result
                       var taxproductoneqty=parseFloat(priceproducttax)+(sum*parseFloat(priceproducttax));
                       var totaproductallqty= taxproductoneqty*parseFloat(qtyproducttaxval);
                       var priceproducttax=$("#priceproducttax").val(taxproductoneqty);
                       var totaltroductaxval=$("#totaltroductaxval").val(totaproductallqty);


                    }

                    // create function tax in properties  %
                    function  displaytaxproduct(){

                       var selecttax=$(".form-floating #selecttax option:selected").val();
                      var qtyproducttaxval=$("#qtyproducttaxval").val();
                      var priceproducttax=$("#priceproducttax").val();
                               var selectedValues = [];
                                    // Find all selected options in the select element
                            $("#selecttax option:selected").each(function () {
                                // Push the value of each selected option into the array
                                selectedValues.push(parseFloat($(this).val()));
                            });

                            // Calculate the sum of selected values
                            var sum = selectedValues.reduce(function (a, b) {
                                return a + b;
                            }, 0);
                          return sum;
                    }
                    // end function tax in properties
                 // add stock in laravel
                 // add even change in function
                 $("#taxproductexport").on('change keydown keyup',function(){
                var dis=  $("#taxproductexport").val();
                var disproduct=dis/100;
                    var priceproducttax=$("#priceproducttax").val();
                   var qtyproducttaxval=$("#qtyproducttaxval").val();

                  var total=priceproducttax*qtyproducttaxval*disproduct;
                   var distotalpro=priceproducttax*qtyproducttaxval-total;
                    var totaltroductaxval=$("#totaltroductaxval").val(distotalpro);

                 });


                    // end chage in function
                    $(".form-floating #selecttax").on("change",function(){

                     displaySumOfSelected();

                    })
                     // Listen for the dropdown close event

                 $(".formstockin_import #taxproduct_stock_import").on('change paste keyup',function(){
                       var add_tax_import =$(".formstockin_import #taxproduct_stock_import").val();
                    if(add_tax_import=="0"){
                            $("#pricetaxproduct").hide();
                            $("#qtyproducttax").hide();
                            $("#taxproductdiscount").hide();
                            $("#totalproducttax").hide();
                        // $("#addtaxproduct").hide();
                            $("#showcategory").hide();
                            $("#showsupplier").hide();
                            // hide barcode in jquery
                            $("#hidebarcode").hide();
                            //  $("#image-respovise").removeClass("col-md-6 form-floating");
                    }else{
                        $.post('/add_producttax/insert_data_tax', {
                       add_tax_import:add_tax_import
                         }, function(result) {
                              $.each(result, function(index, item) {
                            //    Access properties of each item in the array
                            //  console.log('ID: ' + item.product_name);
                            //add price
                           $("#priceproducttax").val(parseFloat(item.stockin_price)).prop('disabled', true);
                             $("#pricetaxproduct").show();
                                 //end price
                                   $("#qtyproducttax").show();
                                   $("#qtyproducttaxval").val(parseFloat(item.stockin_qty)).prop('disabled', true);
                                 // add qty
                                 // add discount
                                     $("#taxproductdiscount").show();
                                 // end discount
                                 // add total
                                   $("#totaltroductaxval").val(parseFloat(item.total_product)).prop('disabled', true);
                                    $("#totalproducttax").show();
                                 // end total
                                 // add tax
                                      $("#addtaxproduct").show();
                                    $("#showcategory").show();
                                 // end tax
                                 // add category
                             $("#categorytaxproduct").val(item.category_name).prop('disabled', true);
                                 $("#catedtaxproduct").val(item.catid);
                                //   $("#categorytaxproduct").text(item.category_name);
                                 // end category
                                // add supplies
                                 $("#showsupplier").show();
                                 $("#suppliestaxproduct").val(item.supplier_name).prop('disabled', true);
                                 $("#supplietaxid").val(item.id);
                                // end supplies
                               // add barcode product
                                $("#hidebarcode").show();
                                $("#barcodetaxproduct").val(item.barcode_import).prop('disabled', true);
                               // end barcode product
                               $('#datehideelemt').val(item.dateexpire);
                                          var imagename =(item.image_productstockin);
                                    //    $("#imagedata").val(imagename);

                                                        // show image
                                  //      var imagestockin=    $("#imagedata").val();

                                        var imageUrl = "{{ asset('upload/stockin_image') }}/" + imagename;
                                        $('#image_file').attr('src', imageUrl);
                                          $("#image-respovise").append("<img id='image_file'>");
                                             //    $("#image-respovise").addClass("col-md-6 form-floating");
                                                           
                                        // end image
                            });
                       });
                    }
                 });
                 // add button in
                $("#btn_save").click(function(){
                  var nameproductinsert= $(".formstockin_import #taxproduct_stock_import").val();
                   var priceproducttax=$("#priceproducttax").val();
                   var qtyproducttaxval=$("#qtyproducttaxval").val();
                   var discountroductaxval=$("#taxproductexport").val();
                   var totaltroductaxval=$("#totaltroductaxval").val();
                   // add tax
                   var dateexpire=  $('#datehideelemt').val();
                         var y=    $("#imagedata").val();

                 //  var selecttax=$(".form-floating #selecttax").val();
                   // end tax
                   var catedtaxproduct=$("#catedtaxproduct").val();
                   var supplietaxid=$("#supplietaxid").val();
                   var barcodetaxproduct=$("#barcodetaxproduct").val();
                    var texproductselect= displaytaxproduct();
                     // go to database in laravel
                        $.post('/add_producttax/insert_data_tax/product/insert', {
                            nameproductinsert:nameproductinsert,
                            priceproducttax:priceproducttax,
                            qtyproducttaxval:qtyproducttaxval,
                            discountroductaxval:discountroductaxval,
                            totaltroductaxval:totaltroductaxval,
                            catedtaxproduct:catedtaxproduct,
                            supplietaxid:supplietaxid,
                            barcodetaxproduct:barcodetaxproduct,
                            texproductselect:texproductselect,
                            dateexpire:dateexpire
                            }, function(result) {
                              if(result==1){
                            // set time in jquery
                                     $("#hidespinnercon").show("fast").delay(1000).hide("fast", function() {
                                    // Hide the spinner and then refresh the page after 5 seconds
                                    setTimeout(function() {
                                       window.location.href = "{{ route('list.stock.in.import')}}";
                                    }, 1000); // 5000 milliseconds = 5 seconds
                                });
                             /// else time in jquery  //
                              }
                            });
                       // end to database in laravel

                });
                // add
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
            $('#taxproductexport').on('keydown paste copy', function(event) {
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
          });
               // end number condition

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
                    <li class="breadcrumb-item active">Add new product</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card">
                               {{-- start  lazy loading  --}}
                               <div class="row justify-content-center" id="hidespinnercon">
                                <div class="col-12 text-center">
                                  <div class="spinner-grow text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                  </div>
                                </div>
                              </div>
                             {{-- end lazy loading  --}}
                            <div class="card-body">
                                <h5 class="card-title">Add New Product</h5>
                                       <!-- Floating Labels Form -->
                                <form class="row g-3" method="post" action="{{route('category.add')}}">
                                    @csrf
                                    <div class="col-md-12">
                                        <div class="form-floating formstockin_import">
                                           <select class="form-select" id="taxproduct_stock_import" id="validationselectoptioncate" required>
                                        <option selected value="0"> Add category</option>
                                         @foreach($product_stockin as $itemproduct)
                                        <option value="{{ $itemproduct->stockin_imporn}}"> {{ $itemproduct->stockin_imporn}}</option>
                                         @endforeach
                                        </select>
                                        <label for="validationselectoptioncate" class="form-label">Product Import category</label>
                                        </div>
                                    </div>
                                   {{-- srate qty product --}}
                                     {{-- add custom image  add import --}}
                                 <div  id="image-respovise">


                                </div>
                              {{-- end custom  image import --}}

                                     <div class="col-md-6" id="pricetaxproduct">
                                        <div class="form-floating">
                                            <input type="text" id="priceproducttax" class="form-control" placeholder="add product import" id="validationCustombarcode" required>
                                            <label for="floatingEmail">price</label>
                                        </div>
                                    </div>
                                   {{-- end ty product export  --}}
                                    {{-- srate price product --}}
                                     <div class="col-md-6" id="qtyproducttax">
                                        <div class="form-floating">
                                            <input  type="text" id="qtyproducttaxval" class="form-control" placeholder="add product import" id="validationCustombarcode" required>
                                            <label for="floatingEmail">Qty</label>
                                        </div>
                                    </div>
                                   {{-- end  price export  --}}
                                    {{-- srate dis product --}}
                                     <div class="col-md-6" id="taxproductdiscount">
                                        <div class="form-floating">
                                            <input type="text" id="taxproductexport" id="discountroductaxval"  data-min_max data-min="0" data-max="100" data-toggle="just_number" class="form-control" placeholder="add product import" id="validationCustombarcode" required>
                                            <label for="floatingEmail">discount</label>
                                        </div>
                                    </div>
                                   {{-- end  dis export  --}}
                                       <input type="hidden" id="imagedata">
                                    {{-- srate total  product --}}
                                     <div class="col-md-6" id="totalproducttax">
                                        <div class="form-floating">
                                            <input type="text" id="totaltroductaxval" class="form-control" placeholder="add product import" id="validationCustombarcode" required>
                                            <label for="floatingEmail">Total</label>
                                        </div>
                                    </div>
                                   {{-- end  total export  --}}
                                    {{-- srate tax  product --}}
                                     <div class="col-md-12" id="addtaxproduct">
                                        <div class="form-floating">
                                             <select class="form-select"  id="selecttax" multiple id="validationselectoptioncate" required>
                                                @foreach($taxproduct as $itemtax)
                                                <option value="{{ $itemtax->price_tax}}">{{ $itemtax->nametax}}|| {{ $itemtax->price_tax*100}}%</option>
                                                @endforeach
                                                </select>
                                        </div>
                                    </div>
                                   {{-- end  tax export  --}}
                                      {{-- srate supplies  product --}}
                                     <div class="col-md-6" id="showcategory">
                                        <div class="form-floating">
                                               <input type="text" id="categorytaxproduct" class="form-control" placeholder="add product import" id="validationCustombarcode" required>
                                               <input type="number" id="catedtaxproduct" hidden>
                                               <label for="floatingEmail">Category</label>
                                        </div>
                                    </div>
                                   {{-- end  supplies export  --}}
                                    {{-- srate category  product --}}
                                     <div class="col-md-6" id="showsupplier">
                                        <div class="form-floating">
                                           <input type="text" id="suppliestaxproduct" class="form-control" placeholder="add product import" id="validationCustombarcode" required>
                                               <input type="number" id="supplietaxid" hidden>
                                               <label for="floatingEmail">supplies</label>
                                        </div>
                                    </div>
                                   {{-- end  category export  --}}
                                    {{-- srate barcode   product --}}
                                     <div class="col-md-12" id="hidebarcode">
                                        <div class="form-floating">
                                           <input type="text" id="barcodetaxproduct" class="form-control" placeholder="add product import" id="validationCustombarcode" required>
                                               <label for="floatingEmail">barcode Product</label>
                                        </div>
                                    </div>
                                   {{-- end  category export  --}}
                                   {{-- add hide elelement input form  --}}
                                    <input type="hidden" id='datehideelemt'>
                                    <p id='thon'></p>
                                   {{-- end hide element input form --}}
                                    <div class="text-center">
                                        <button type="button" id="btn_save" class="btn btn-primary">Submit</button>
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
