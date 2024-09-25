@include ('partials/head');
<script src="{{asset('assets/vendor/jQuery3.7/jQuery.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datejs/1.0/date.min.js"></script>
<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        // Define a function to create and render the chart using jQuery
        function createAndRenderChart() {
          // add values  to jquery
            var productcost=  $('#tableval tbody tr:first #productprice').val();
            var  priceproductchart = parseFloat(productcost.slice(0, 4));
            //.slice(0, -1)
            var priceproductchartdata=parseFloat((priceproductchart*10/100)+priceproductchart);
            // 20%
            priceproductcharttwo=parseFloat((priceproductchart*20/100)+priceproductchart);
            // 30%
            priceproductchartthree=parseFloat((priceproductchart*30/100)+priceproductchart);
            //40%
            priceproductchartfouth=parseFloat((priceproductchart*40/100)+priceproductchart);
               //50%
               priceproductchartfive=parseFloat((priceproductchart*50/100)+priceproductchart);
               // 60%
               priceproductchartsix=parseFloat((priceproductchart*60/100)+priceproductchart);
               // 70%
               priceproductchartseven=parseFloat((priceproductchart*70/100)+priceproductchart);
               // 80%
               priceproductcharteight=parseFloat((priceproductchart*80/100)+priceproductchart);
               //90%
               priceproductchartnine=parseFloat((priceproductchart*90/100)+priceproductchart);
               //100%
               priceproductchartten=parseFloat((priceproductchart*100/100)+priceproductchart);
            new ApexCharts(document.querySelector("#lineChart"), {
                series: [{
                    name: "Product profit",
                    data: [
                    priceproductchartdata.toFixed(2),
                    priceproductcharttwo.toFixed(2),
                    priceproductchartthree.toFixed(2),
                    priceproductchartfouth.toFixed(2),
                    priceproductchartfive.toFixed(2),
                    priceproductchartsix.toFixed(2),
                    priceproductchartseven.toFixed(2),
                    priceproductcharteight.toFixed(2),
                    priceproductchartnine.toFixed(2),
                    priceproductchartten.toFixed(2),
                ]
                }],
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'],
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ['10%', '20%', '30%', '40%', '50%', '60%', '70%', '80%', '90%','100%'],
                }
            }).render();

        }
       // create product
       $(function(){

                $('#hideelemntcol').hide();
                $('#hideelemntdate').hide();
                $('#hideelementchart').hide();
                $("#hideelementpersent").hide();
                $("#btnsavecreat").hide();
                $("#btnsavecreat").append("<button type='button' id='savedata'>Save</button>");
              // end show fucntion leader
              $("#savedata").addClass("btn btn-primary");
               var defaultselect='0';
                $('.form-floating #setproductsell').on('change',function(){
                   postdata();

                })
           // even select
           // create even
                  $('.form-floating #setproductsetpersent').on('change',function(){
                            persentnum();
                })
           // create function process chart with process admin
                       $(document).ready(function() {
                        var select = $('#setproductsetpersent');
                        for (var i = 0; i <= 10; i++) {

                            select.append($('<option>', {
                                value: (i*10),
                                text: i*10+'%'
                                        }));
                                    }
                              });
           // create function in jquery
             function persentnum(){
                                    var select = $('#setproductsetpersent').val();

                            if(select!='!'){
                               var optionproduct=  $('#tableval tbody tr:first #productprice').val();
                               var  setproduct = parseFloat(optionproduct.slice(0, 4));

                               var setproductpersent=setproduct*(select/100)+setproduct;
                               var alreadyproduct=setproductpersent.toFixed(2);

                            }else{

                            }


             }
           // end function in jquery
            function chartprocess(){

            }
           // end function process chart with process admim
           // Create fucntion create
           function postdata(){
                   var selectoptionpro=$('#setproductsell option:selected').val();
                //   var selectipotionval=$("#selectipotionval").val()
                    if(selectoptionpro==defaultselect){
                         $('#hideelemntcol').hide();
                         $('#hideelemntdate').hide();
                         $('#hideelementchart').hide();
                         $("#hideelementpersent").hide();
                         $("#btnsavecreat").hide();
                    }else{
                         // add function data in selelct
                           $.post('/view/export/set_product/condition', {
                                selectoptionpro:selectoptionpro
                                }, function(result) {
                                  // add result in laravel
                                        $.each(result, function(index,item) {
                                  //    $('#nameproduct').val(item.name_producttax);
                                             pushfunctiondata();
                                        // create function select in val in jquery
                                        function pushfunctiondata(){
                                            var firstRow = $('#tableval tbody tr:first #productname').text(item.name_producttax);
                                            $('#nameproductdate').text(item.name_producttax);
                                             $('#tableval tbody tr:first #productprice').text(item.price_producttax+"$");
                                               $('#tableval tbody tr:first #productprice').val(item.price_producttax);
                                             $('#tableval tbody tr:first #productqty').text(item.qty_producttax);
                                             $('#tableval tbody tr:first #productqty').val(item.qty_producttax);
                                             $('#tableval tbody tr:first #productdis').text(item.dis_producttax+'%');
                                             $('#tableval tbody tr:first #productdis').val(item.dis_producttax);
                                             $('#tableval tbody tr:first #producttotal').text(item.total_productta);
                                             $('#tableval tbody tr:first #producttotal').val(item.total_productta);
                                             // add category now table
                                             $('#tableval tbody tr:first #productcate').text(item.category_name);
                                            // $('#tableval tbody tr:first #productcate').val(item.catid);
                                              $("#categorycate").val(item.catid);
                                               // end category now table
                                              $("#texproduct").val(item.tax_product)

                                               $('#tableval tbody tr:first #productsupplies').text(item.supplier_name);
                                           // $('#tableval tbody tr:first #productsupplies').val(item.id);
                                              $("#supplieproduct").val(item.id);
                                               // add suppler in now tabble
                                               // add date in controller
                                               $('#tabbledate tbody tr:first #date_import').text(item.date);

                                               $('#tabbledate tbody tr:first #date_expire').text(item.dateexpire);
                                               // barcode sell in javascript
                                               $("#barcodeproduct").val(item.barcode_taxproduct);
                                        }

                                       });
                                          $('#hideelemntcol').show();
                                          $('#hideelemntdate').show();
                                         $('#hideelementchart').show();
                                         $("#hideelementpersent").show();
                                         $("#btnsavecreat").show();
                                         createAndRenderChart();

                                    // alert(tha);

                                     // create function to laravel


                                  // end result in laravel
                                });
                         // end function date in seleclect


                    }
           }
           //end  Create fucntion create

           function savedatabtn(){
            $("#savedata").click(function(){
            var optionselect=$("#setproductsetpersent").val();
            var productcost=  $('#tableval tbody tr:first #productprice').val();
            var productprice=parseFloat(productcost);
            var calpriceproduct=productprice*optionselect/100+productprice;
                var optiontakeproduct=calpriceproduct.toFixed(2);
                var nameproduct = $('#tableval tbody tr:first #productname').text();
            var qtypro=  $('#tableval tbody tr:first #productqty').text();
            var discount=   $('#tableval tbody tr:first #productdis').text();
            // pastfloat
           var  Category=  $("#categorycate").val();
           var supplier=   $("#supplieproduct").val();
           var datestart=    $('#tabbledate tbody tr:first #date_import').text();
           var expriredate=    $('#tabbledate tbody tr:first #date_expire').text();
           var barcode_taxproduct=   $("#barcodeproduct").val();
          var persentproduct= $('#tableval tbody tr:first #productdis').val();

            var totalproduct=parseFloat(qtypro)*parseFloat(optiontakeproduct);
             // history product
             var historyprice= productprice.toFixed(2);
             var historytotal=   $('#tableval tbody tr:first #producttotal').val();
             var historydiscount= $('#tableval tbody tr:first #productdis').val();

            var historytaxproduct=   $("#texproduct").val();
            var historyqtypro =   $('#tableval tbody tr:first #productqty').val();

            $.post('/view/export/set_product/condition/install/add', {
                optiontakeproduct:optiontakeproduct,
                nameproduct:nameproduct,
                qtypro:qtypro,
                totalproduct:totalproduct,
                Category:Category,
                supplier:supplier,
                datestart:datestart,
                expriredate:expriredate,
                barcode_taxproduct:barcode_taxproduct,
                persentproduct:persentproduct,
                    // create history product ok
                historyprice:historyprice,
                historytotal:historytotal,
                historydiscount:historydiscount,
                historytaxproduct:historytaxproduct,
                historyqtypro:historyqtypro,
                }, function(result) {
                  if(result==1){

                     $("#alersusecss").addClass("alert alert-success alert-dismissible fade show");
                     $("#alersusecss").text(" Already Products set");
                     $("#alersusecss").append('<button type="button" id="alertsucssect" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
               
                    $("#alertsucssect").click(function(){
                          window.location.href = "{{ route('view.set.porduct.export')}}";
                    });

                  }
                });
            });

           }
            savedatabtn();
       })


</script>
<body>

    <!-- ======= Header ======= -->
    @include ('partials/header');

    <!-- ======= Sidebar ======= -->
    @include ('partials/aside');
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add New Category</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('index')}}">Home</a></li>
                    <li class="breadcrumb-item active">Add new category</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <input type="hidden" id="categorycate">
                <input type="hidden" id="supplieproduct">
                <input type="hidden" id="datestarte">
                <input type="hidden" id="barcodeproduct">
                <input type="hidden" id="texproduct">

                <div id="alersusecss" role="alert"></div>
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">please set product for sell</h5>

                                <!-- Floating Labels Form -->
                                    <form class="row g-3 needs-validation">
                                 {{-- add product supplie import --}}
                                      <div class="col-12 form-floating">
                                        <select class="form-select" id="setproductsell" id="validationselectoptionsupplier" required>
                                        <option id="selectipotionval" selected value="0">Set prodduct for sell</option>
                                       @foreach($producttax as $nameproduct)
                                        <option value="{{$nameproduct->name_producttax}}"> {{$nameproduct->name_producttax}}</option>
                                         @endforeach
                                        </select>
                                        <label for="validationselectoptionsupplier" class="form-label">Product Import supplie</label>

                                </div>
                                   {{-- end product supplie import --}}

                                {{-- <div class="col-12 ">
                                    <button class="btn btn-primary offset-5" type="button" id="btn_saveimport">Submit form</button>
                                </div> --}}
                                </form>
                                 {{-- end add product import for ecommerce --}}
                            </div>
                        </div>

                    </div>
                </div><!-- End Left side columns -->

                         <!-- Left side columns -->
                <div class="col-lg-8 me-lg-2" id="hideelemntdate">
                    <div class="row">
                    <div class="card">
                        <div class="card-body">
                        <h5 class="card-title">Table with hoverable rows</h5>
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover" id="tableval">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">price product</th>
                                <th scope="col">qty product</th>
                                <th scope="col">discount product</th>
                                 <th scope="col">Total product</th>
                                <th scope="col">Category product</th>
                                 <th scope="col">supplie product</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td id="productname"></td>
                                <td id="productprice"></td>
                                <td id="productqty"></td>
                                <td id='productdis'></td>
                                 <td id='producttotal'></td>
                                <td id='productcate'></td>
                                <td id='productsupplies'></td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        </div>
                    </div>


                    </div>
                </div><!-- End Left side columns -->
                {{-- add cartd date  --}}
                <div class="col-lg-3" id="hideelemntcol">
                    <div class="row">
                    <div class="card">
                        <div class="card-body">
                        <h6 class="fw-bold card-title" id="nameproductdate"></h6>
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover" id="tabbledate">
                            <thead>
                            <tr>
                                <th scope="col">Date start </th>
                                <th scope="col">Date Ex</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td id="date_import"></td>
                                <td id='date_expire' class="text-danger"></td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        </div>
                    </div>


                    </div>
                </div><!-- End Left side columns -->
                {{-- end card date  --}}
                {{-- hide element for chart.js --}}
                    <div class="col-lg-12" id="hideelementchart">
                    <div class="row">
                    <div class="card">
                        <div class="card-body">
                        <!-- Table with hoverable rows -->
                          <div id="lineChart"></div>
                           <!-- End Line Chart -->
                        <!-- End Table with hoverable rows -->
                        </div>
                    </div>
                    </div>
                </div>
                {{-- end hide element for chart.js --}}
                            {{-- hide element for chart.js --}}
                 <div class="col-lg-12" id="hideelementpersent">
                    <div class="row">
                    <div class="card">
                      <div class="col-12 form-floating" id="selectpersent">
                            <select class="form-select" id="setproductsetpersent" id="validationselectoptionsupplier" required>
                            <option id="selectipotionpersent" selected value="!">Set prodduct for sell</option>
                            {{-- @foreach($producttax as $nameproduct)
                            <option value="{{$nameproduct->name_producttax}}"> {{$nameproduct->name_producttax}}</option>
                                @endforeach --}}

                            </select>
                            <label for="validationselectoptionsupplier" class="form-label">Product Import supplie</label>

                     </div>


                    </div>
                    </div>
                </div>



            </div>
              <div class="col-lg-6 offset-lg-6 col-sm-6 offset-sm-6 col-6 offset-6" id="btnsavecreat">

              </div>

        </section>

    </main><!-- End #main -->

    @include ('partials/footer');
