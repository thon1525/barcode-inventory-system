@include ('partials/head');
<script src="{{asset('assets/vendor/jQuery3.7/jQuery.js')}}"></script>
  <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
         $(function(){
            // hello when
            function totalstockin(){
                var stockinprice=$(".dev-chage #funchage").val();
               var stockin_qty=$(".form-floating #productqty").val();
               var totalstockin_import=stockinprice*stockin_qty;
               var total=parseFloat(totalstockin_import);
               var editproducttotal=$("#editproducttotal").val(total);
            }
            // change price
    $(".dev-chage #funchage").on('change keydown keyup', function(){
        totalstockin();
    });
      // change aqt
      $(".form-floating #productqty").on('change keydown keyup', function(){
        totalstockin();
    });


            //  end change price
                   // hide forder catgory
                   $("#categorynotedit").hide();
                   $("#categoryupdatecategory").hide();
                   $("#hidespinner").hide();
                   // end forder hide category

                   // start forder hide suppleri
                   $("#suppliernotedit").hide();
                   $("#supplierupdate").hide();
                   // end hide suppleri
                   $("#suppliernotedit").hide();
                      var supplier_import_id=$(".supplier_import option:selected").val();
                      // category_id supplier_import_id
                      $("#categorystockinimport").prop('disabled', false);
                      var supplier_iduser=$(".supplier_iduser option:selected").val();
                      // strate add event change category in laravel
                      $(".categoruser_id #eventcatege").on('change',function(){
                        var categoruser_id=$(".categoruser_id option:selected").val();
                        var category_id = $(".form-select-option option:selected").val();
                        // values =0
                        var change_val=$(".categoruser_id #eventcatege").val();
                         if(change_val=="0"){
                            $("#ontionvalcate").show();
                            $("#categorynotedit").hide();
                            $("#categoryupdatecategory").hide();
                         }else{

                            $("#ontionvalcate").hide();
                            $("#categorynotedit").hide();
                            $("#categoryupdatecategory").hide();
                              if(category_id==categoruser_id){
                                $("#categorynotedit").show();
                                $("#categoryupdatecategory").hide();
                              }else{
                                $("#categorynotedit").hide();
                                $("#categoryupdatecategory").show();
                              }
                         }
                        if(category_id==categoruser_id){
                          $("#hidecatename").hide();
                          // vales hide when val =0
                          $("#ontionvalcate").hide();
                          $("#categorynotedit").show();
                       //   $("#categoryupdatecategory").show();
                          $("#categoryupdatecategory").hide();
                          if(category_id){
                          $("#categoryhideedti").show();
                          $("#categoryupdatecategory").hide();
                          $("#hidecatename").show();
                           $("#categorynotedit").show();

                          }
                            }else{
                                $("#categoryhideedti").hide();

                            }

                      });
                      // end add event change category in laravel
                      // srate event change supplier in laravel jquery
                      $(".supplier_iduser #supplierval").on('change', function(){
                        var supplier_import_id=$(".supplier_import option:selected").val();
                        var supplier_iduser=$(".supplier_iduser option:selected").val();
                        // select val in jquery ==0
                        var change_val_supplier=$(".supplier_iduser #supplierval").val();
                        if(change_val_supplier=="0"){
                            $("#ontionsuppulier").show();
                            $("#suppliernotedit").hide();
                            $("#supplierupdate").hide();

                        }else{
                            $("#ontionsuppulier").hide();
                            $("#suppliernotedit").hide();
                            $("#supplierupdate").show();
                        }
                        if(supplier_import_id==supplier_iduser){
                         $("#hidesupplie").hide();
                         $("#suppliernotedit").show();
                         $("#supplierupdate").hide();
                         if(supplier_iduser){
                            $("#hidesupplie").show();
                            $("#supplieuser_id").show();
                            $("#suppliernotedit").show();
                            $("#supplierupdate").hide();
                         }
                       }else{
                        $("#supplieuser_id").hide();

                       }
                      })
                     // end event change supplier in laravel jquery
                $("#btnsave_stockin").click(function(){
                        var stockinmport=    $("#stockinmport").val();
                        var stockinprice=$("#stockinprice").val();
                        var stockin_qty=$("#stockin_qty").val();
                        var stockinbarcode=$("#stockinbarcode").val();
                        var showproducts= $("#showproducts").val();
                        // create image for encrypted for jquery
                        var category_id = $(".form-select-option option:selected").val();
                        var supplier_iduser=$(".supplier_iduser option:selected").val();
                       var imagename=$("#productchange")[0];
                        var image = $("#productchange")[0].files[0];
                        // image and supplier and supplier_id is true 
                       if(imagename.files.length===0&& supplier_iduser!=='0'&&supplier_iduser!=='0'){
                        var valstockinid=$("#valstockinid").val();
                        var stockinmport= $("#stockinmport").val();
                        var stockinprice=$(".dev-chage #funchage").val();
                        var stockin_qty=$(".form-floating #productqty").val();
                        var stockinbarcode=$("#stockinbarcode").val();
                          // add function database edite in laravel jquery
                        var categoruser_id=$(".categoruser_id option:selected").val();
                        var supplier_iduser=$(".supplier_iduser option:selected").val();
                        var editproducttotal=$("#editproducttotal").val();
                        var datestare=$("#datestare").val();
                      
                        //create event image
                                 // add post function jquery
                           $.post('/stock_in/manage_product_stock_in/update_stockin/view/edit/update',{
                            valstockinid:valstockinid,
                            stockinmport:stockinmport,
                            stockinprice:stockinprice,
                            stockin_qty:stockin_qty,
                            stockinbarcode:stockinbarcode,
                            categoruser_id:categoruser_id,
                            supplier_iduser:supplier_iduser,
                            editproducttotal:editproducttotal,
                           datestare:datestare, 
                            }, function(result) {
                              if(result==1){
                                $("#hidespinner").show("fast").delay(1000).hide("fast", function() {
                                    // Hide the spinner and then refresh the page after 5 seconds
                                    setTimeout(function() {
                                       window.location.href = "{{ route('list.stock.in.import')}}";
                                    }, 1000); // 5000 milliseconds = 5 seconds
                                });
                              
                              }
                            
                            });
                         }
                          var currentDate = new Date();
                          var formattedDate = currentDate.getFullYear() +
                              ('0' + (currentDate.getMonth() + 1)).slice(-2) +
                              ('0' + currentDate.getDate()).slice(-2) +
                              ('0' + currentDate.getHours()).slice(-2) +
                              ('0' + currentDate.getMinutes()).slice(-2) +
                              ('0' + currentDate.getSeconds()).slice(-2);
                              var filename =formattedDate+image.name;
                         
                        // where edit true
                     
                     

                            // add function database edite in laravel jquery
                            var categoruser_id=$(".categoruser_id option:selected").val();
                            var supplier_iduser=$(".supplier_iduser option:selected").val();
                      // end function database edite in laravel jquery
                
                      // category option val 0
                    if(categoruser_id=="0"){
                        // false value not sent
                        var stockinmport=    $("#stockinmport").val();
                        var stockinprice=$("#stockinprice").val();
                        var stockin_qty=$("#stockin_qty").val();
                        var stockinbarcode=$("#stockinbarcode").val();
                          // add function database edite in laravel jquery
                        var categoruser_id=$(".categoruser_id option:selected").val();
                        var supplier_iduser=$(".supplier_iduser option:selected").val();
                    }else{
                        // true sen
                        var stockinmport=    $("#stockinmport").val();
                        var stockinprice=$("#stockinprice").val();
                        var stockin_qty=$("#stockin_qty").val();
                        var stockinbarcode=$("#stockinbarcode").val();
                          // add function database edite in laravel jquery
                        var categoruser_id=$(".categoruser_id option:selected").val();
                        var supplier_iduser=$(".supplier_iduser option:selected").val();
                    }
                    
                       // supplier option val 0
                       if(supplier_iduser=="0"){
                        var stockinmport=    $("#stockinmport").val();
                        var stockinprice=$("#stockinprice").val();
                        var stockin_qty=$("#stockin_qty").val();
                        var stockinbarcode=$("#stockinbarcode").val();
                          // add function database edite in laravel jquery
                        var categoruser_id=$(".categoruser_id option:selected").val();
                        var supplier_iduser=$(".supplier_iduser option:selected").val();
                       }else{
                             // true sen
                        var stockinmport=    $("#stockinmport").val();
                        var stockinprice=$("#stockinprice").val();
                        var stockin_qty=$("#stockin_qty").val();
                        var stockinbarcode=$("#stockinbarcode").val();
                          // add function database edite in laravel jquery
                        var categoruser_id=$(".categoruser_id option:selected").val();
                        var supplier_iduser=$(".supplier_iduser option:selected").val();
                       }
                           // category option val 0 ===  // supplier option val 0
                      if(categoruser_id!=="0"&&supplier_iduser!=="0"){
                        var valstockinid=$("#valstockinid").val();
                        var stockinmport= $("#stockinmport").val();
                        var stockinprice=$(".dev-chage #funchage").val();
                        var stockin_qty=$(".form-floating #productqty").val();
                        var stockinbarcode=$("#stockinbarcode").val();
                          // add function database edite in laravel jquery
                        var categoruser_id=$(".categoruser_id option:selected").val();
                        var supplier_iduser=$(".supplier_iduser option:selected").val();
                        var editproducttotal=$("#editproducttotal").val();
                        var datestare=$("#datestare").val();
                        //create event image
                       
                        var reader = new FileReader();
                        reader.onload = function (e) {
                                var imageData = e.target.result.split(',')[1];
                                
                           // add post function jquery
                           $.post('/stock_in/manage_product_stock_in/update_stockin/view/edit/update',{
                            valstockinid:valstockinid,
                            stockinmport:stockinmport,
                            stockinprice:stockinprice,
                            stockin_qty:stockin_qty,
                            stockinbarcode:stockinbarcode,
                            categoruser_id:categoruser_id,
                            supplier_iduser:supplier_iduser,
                            editproducttotal:editproducttotal,
                            imagename:filename,
                           imagefile:imageData, 
                           datestare:datestare, 
                            }, function(result) {
                              if(result==1){
                                $("#hidespinner").show("fast").delay(1000).hide("fast", function() {
                                    // Hide the spinner and then refresh the page after 5 seconds
                                    setTimeout(function() {
                                       window.location.href = "{{ route('list.stock.in.import')}}";
                                    }, 1000); // 5000 milliseconds = 5 seconds
                                });
                              
                              }
                             //alert(result);
                            });
                        }
                        reader.readAsDataURL(image);
                      }

                })
    //    hello encroption for jquery

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
   // end function encryption for jquery
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
                    <li class="breadcrumb-item active">Manage hello Category</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <input type="hidden" id="filename">
       
        <section class="section dashboard">
            <div class="row">
                    <div class="col-3 offset-9"><a style="font-weight: 700;" class="btn btn-success" href="{{url('product/add_product')}}">Add
                            new
                            product</a></div>
                </div>

                <!-- Left side columns -->
                <div class="col-lg-12" id="cardhidetable">
                    <div class="row">
                        <div class="card overflow-auto">

                            <div class="card-body">
                                       {{-- Spinners --}}
                                <div class="text-center" id="hidespinner">
                                    <div class="spinner-border text-dark" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                      </div>
                                  </div>
                                {{-- end Spinners --}}
                                <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">All Category </h5>

                                    {{-- <a href="{{url('product/grid_view')}}" class="btn btn-success ">Grid View <i class="bi bi-grid-3x2"></i></a> --}}
                                </div>
                                    @foreach($stockinendit as $objstockin)
                                     <input type="hidden" id="datestare" value="{{$objstockin->image_productstockin}}">
                                     <div class="d-flex justify-content-center mb-3">
                                    @if (!empty($objstockin->image_productstockin))
                                    <img src="{{url('upload/stockin_image/'.$objstockin->image_productstockin)}}" id="product" width="400px" height="400px" alt="Profile" >
                                    @else
                                    <img src="{{url('upload/noimage.jpg') }}" alt="Profile"  id="product" width="400px" height="400px" >

                                     @endif
                                </div>

                              <form class="row g-3" method="post" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="col-md-12 ">
                                        <div class="form-floating">
                                            <input type="text"  class="form-control data-barcode-name is-valid" value="{{$objstockin->stockin_imporn}}" name="stockinproduct" id="stockinmport" placeholder="Product Name">
                                            <label for="floatingName">name product stock in </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating dev-chage">
                                           <input type="text" id="funchage"  data-min_max data-min="0" data-max="1000000000000000" data-toggle="just_number"  class="form-control is-valid" value="{{$objstockin->stockin_price}}" name="stockinprice" id="stockinprice" placeholder="Product Name">
                                            <label for="floatingName">price product</label>
                                        </div>
                                    </div>
                                      <div class="col-md-6">
                                        <div class="form-floating">
                                           <input type="text" id="productqty"  data-min_max data-min="0" data-max="1000000000000000" data-toggle="just_number"  class="form-control is-valid" value="{{$objstockin->stockin_qty}}"  id="stockin_qty" placeholder="Product Name">
                                            <label for="floatingName">qty product</label>
                                        </div>
                                    </div>
                                    {{-- add totoproduct now --}}
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                           <input type="text" id="editproducttotal" class="form-control is-valid" Disabled value="{{$objstockin->total_product}}" placeholder="Product Name">
                                            <label for="floatingName">qty product</label>
                                        </div>
                                    </div>
                                    {{-- end totprodut else --}}
                                   {{-- hide form --}}
                                   <input type="hidden" value="{{$objstockin->id_stock_in_import}}" id="valstockinid" >
                                   {{-- end hide form --}}
                                     <div class="col-md-6" id="categoryhideedti">
                                             <div class="form-floating form-select-option mb-3">
                                            <select class="form-select is-valid" required id="floatingSelect" id="categorystockinimport" name="categorystockin" aria-label="Category">
                                                <option value="{{$objstockin->catid}}">
                                                    {{ $objstockin->category_name}}
                                                </option>
                                            </select>
                                            <label for="floatingSelect">Category</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6" id="supplieuser_id">
                                        <div class="form-floating supplier_import mb-3">
                                       <select class="form-select is-valid"  disabled required id="supplier_stock_in" id="floatingSelect" name="category_id" aria-label="Category">
                                        <option value="{{$objstockin->id}}"> {{$objstockin->supplier_name}} </option>
                                       </select>
                                       <label for="floatingSelect">Supplier</label>
                                     </div>
                                    </div>
                                    {{-- add category in product import  --}}
                                    @if ($catename)
                                    <div class="col-md-6" id="hidecatename">
                                        <div class="form-floating categoruser_id  mb-3">
                                       <select class="form-select is-valid" required id="eventcatege" id="floatingSelect" name="category_id" aria-label="Category">
                                        <option selected value="0">pleases select category</option>
                                        @foreach($catename as $itemobj)
                                        <option value="{{$itemobj->catid}}"> {{$itemobj->category_name}} </option>
                                        @endforeach
                                       </select>
                                       <label for="floatingSelect">Category</label>
                                     </div>
                                      <p id="ontionvalcate"  class="text-danger">pleases select category</p>
                                      <p id="categorynotedit"  class="text-success">you not edit category</p>
                                      <p id="categoryupdatecategory"  class="text-success">you update category</p>
                                    </div>
                                    @endif
                                 {{-- end category in product import  --}}
                                   {{-- add supplie in product import  --}}
                                   @if ($supplieproductimage)
                                   <div class="col-md-6" id="hidesupplie">
                                       <div class="form-floating supplier_iduser mb-3">
                                      <select class="form-select is-valid" id="supplierval" required id="floatingSelect"  aria-label="Category">
                                        <option selected value="0">pleases select supplier</option>
                                       @foreach($supplieproductimage as $itemsupplie)
                                       <option value="{{$itemsupplie->id}}"> {{$itemsupplie->supplier_name}} </option>
                                       @endforeach
                                      </select>
                                      <label for="floatingSelect">Supplier</label>
                                    </div>
                                    <p id="ontionsuppulier"  class="text-danger">pleases select suppulier</p>
                                    <p id="suppliernotedit"  class="text-success">you not edit suppulier</p>
                                    <p id="supplierupdate"  class="text-success">you update suppulier</p>
                                   </div>
                                   @endif
                                        <hr>
                                       {{-- end supplie in product import  --}}
                                       {{-- srate in category in product --}}
                                            <div class="col-md-6">
                                            <label for="product">Product Import Image</label>
                                          <input name="product_change" type="file" class="form-control" id="productchange">
                                        </div>
                                                 <div class="text-center mb-3">
                                                @if (!empty($objstockin->image_productstockin))
                                                <img src="{{url('upload/stockin_image/'.$objstockin->image_productstockin)}}" id="showproducts" width="100px" height="100px" alt="Profile" >
                                                    @else
                                                <img src="{{url('upload/noimage.jpg') }}" alt="Profile"  id="showproducts" width="100px" height="100px" >

                                                @endif
                                            </div>
                                            </div>
                                         {{-- srate in category in product --}}
                                 <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control is-valid" value="{{$objstockin->barcode_import}}" id="stockinbarcode" placeholder="Product Name">
                                            <label for="floatingName">name product stock in </label>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="button"  id="btnsave_stockin"class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                </form><!-- End floating Labels Form -->

                                    @endforeach
                                <!-- small modal -->
                            </div>
                        </div>

                           <script type="text/javascript">
                    $(document).ready(function(){
                      $('#productchange').change(function(e){
                        var reader = new FileReader();

                        reader.onload = function(e){
                      $('#showproducts').attr('src', e.target.result);

                        }
                          reader.readAsDataURL(e.target.files['0']);
                          $("#filename").val(e.target.files['0'].name);
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
