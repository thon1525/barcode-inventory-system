@include ('partials/head');
<script src="{{asset('assets/vendor/jQuery3.7/jQuery.js')}}"></script>
<script>
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
            // add condition ver
     $(document).ready(function(){
           //  var x=$('#tabledate #trdata:eq()').val();
      ///      var y=    $('#nameproduct').val();


       //  var productName = $('#nameproduct').data("product-name");
     //    alert(productName);
      //   var namedata=$('#tabledate .data-row:eq()').text();
            // You can now use productName in your JavaScript code
     //  $('#tabledate tr').each(function() {
    // 'this' refers to the current <tr> element in the loop
         //  var y=    $('#nameproduct').val();

        //  $(this).prepend('<td class="o"></td>');
       //      $(this).find('.o').text(y);
    //     });

$(document).ready(function(){
            var name=    $("#nameproduct").val();
            var barcode =$("#barcode").val();
            var product_img=$("#product_img").val();

         var imageUrl = "{{ asset('upload/products') }}/" + product_img;
          $('#cocaname').attr('src', imageUrl);
        var product_price=$("#product_price").val();
       var resultText = name + '<br>' + barcode;
     $("#cocaproduct").html(resultText);

   $("#priceproduct").text(product_price+"ml");
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
            <div class="row">
                @if(session()->has('message'))
                <div class="alert alert-success align-items-center d-flex justify-content-between">

                    <div>
                        {{ session('message') }}

                    </div>
                    <div><a style="font-weight: 700;" class="btn btn-success" href="{{url('product/add_product')}}">Add
                            new
                            product</a></div>

                </div>
                @endif
                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card overflow-auto">

                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">All Category </h5>

                                    {{-- <a href="{{url('product/grid_view')}}" class="btn btn-success ">Grid View <i class="bi bi-grid-3x2"></i></a> --}}

                                </div>


                                   {{-- new table date  --}}
                                     {{-- hide
                                               @foreach($listproduct as $itempro)

                                                   @foreach($showone as $obj)

                                                   @foreach($showdrink as $maill)

                                            <div class="container text-center">
                                                <div class="row">
                                                <div class="col"></div>
                                                <div class="col-3">

                                                </div>
                                                <div class="col-3">
                                                    <img
                                                    src="{{url('upload/products/'.$obj->product_img)}}"
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                <div class="col-3">
                                                    <img
                                                    src="{{url('upload/products/'.$maill->product_img)}}"
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                </div>

                                                <div class="row">
                                                <div class="col-4 offset-6">
                                                <p>hello title in html</p>
                                                </div>
                                                </div>

                                                <div class="row border">
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                <div class="col-3 border" style="background-color: #94949a;"> product {{$itempro->product_name}} <br> {{$itempro->product_code}}</div>
                                                <div class="col-3 border" style="background-color: #94949a;">product {{$obj->product_name}} <br> {{$obj->product_code}}</div>
                                                <div class="col-3 border" style="background-color: #94949a;">product {{$maill->product_name}} <br> {{$maill->product_code}}</div>

                                                <div class="col-3 border">One of three columns </div>
                                                <div class="col-3 border">{{$itempro->product_price}}ml</div>
                                                <div class="col-3 border">{{$obj->product_price}}ml</div>
                                                <div class="col-3 border">{{$maill->product_price}} ml</div>

                                                <div class="col-3 border">One of three columns</div>
                                                <div class="col-3 border"></div>
                                                <div class="col-3 border"></div>
                                                <div class="col-3 border"></div>
                                                </div>

                                                <br>
                                                <br>
                                                <div class="row">
                                                <div class="col-3 offset-3">
                                                    <img
                                                    src="https://media.geeksforgeeks.org/wp-content/uploads/box-model-1.png"
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                <div class="col-3">
                                                    <img
                                                    src="https://www.scaler.com/topics/images/properties-of-css-box-model.webp"
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                </div>
                                                <div class="row"><div class="col-2">hello title </div></div>
                                                <div class="row border">
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                <div class="col-3 border" style="background-color: #94949a;"></div>

                                                <div class="col-3 border">One of three columns</div>
                                                <div class="col-3 border">200ml</div>
                                                <div class="col-3 border">500ml</div>
                                                <div class="col-3 border"></div>

                                                <div class="col-3 border">One of three columns</div>
                                                <div class="col-3 border"></div>
                                                <div class="col-3 border"></div>
                                                <div class="col-3 border"></div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endforeach
                                            @endforeach
                                            <br>
                                            <div class="row">
                                                <div class="col-3 offset-3">
                                                    <img
                                                    src="https://media.geeksforgeeks.org/wp-content/uploads/box-model-1.png"
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                <div class="col-3">
                                                    <img
                                                    src="https://www.scaler.com/topics/images/properties-of-css-box-model.webp"
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                </div>
                                                <div class="row"><div class="col-2">hello title </div></div>
                                                <div class="row border">
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                @foreach($showmail as $itemobj)
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                 @endforeach
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                <div class="col-3 border" style="background-color: #94949a;"></div>

                                                <div class="col-3 border">One of three columns</div>
                                                @foreach($showmail as $itemobj)
                                                <div class="col-3 border">{{$itemobj->product_price}}</div>
                                                @endforeach
                                                <div class="col-3 border">500ml</div>
                                                <div class="col-3 border"></div>

                                                <div class="col-3 border">One of three columns</div>
                                                <div class="col-3 border"></div>
                                                <div class="col-3 border"></div>
                                                <div class="col-3 border"></div>
                                                </div>
                                                --}}
                                <!-- small modal -->


                                     {{-- <tr class="data-row" data-product-name="{{ $value->product_name }}">
                                        <th class="title">{{ $value->product_name }}</th>
                                  </tr> --}}
                                      {{-- @foreach($showmail as $value)
                                  {{$value->product_name}}
                                   <input type="hidden" id="nameproduct" data-product-name="{{ $value->product_name }}" value='{{$value->product_name}}'>

                                 @endforeach --}}

                                 {{-- <table class="table table-bordered" id="tabledate">

                                   <tr id="trdata">

                                    </tr>
                                    </table>
                            </div> --}}

                          {{-- add new product --}}
                              <img id="img_path_" width="24" height="24" src=".." class="img-fluid" >
                                        <div class="container text-center">
                                                <div class="row">
                                                <div class="col"></div>
                                                <div class="col-3">
                                                    <img
                                                    id="cocaname"
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                <div class="col-3">
                                                    <img
                                                    src=""
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                <div class="col-3">
                                                    <img
                                                    src=""
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                </div>

                                                <div class="row">
                                                <div class="col-4 offset-6">
                                                <p>hello title in html</p>
                                                </div>
                                                </div>

                                                <div class="row border">
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                <div class="col-3 border" id="cocaproduct" style="background-color: #94949a;"> product </div>
                                                <div class="col-3 border"  style="background-color: #94949a;">product <br></div>
                                                <div class="col-3 border" style="background-color: #94949a;">product  <br></div>

                                                <div class="col-3 border">One of three columns </div>
                                                <div class="col-3 border" id="priceproduct">ml</div>
                                                <div class="col-3 border">ml</div>
                                                <div class="col-3 border"> ml</div>

                                                <div class="col-3 border">One of three columns</div>
                                                <div class="col-3 border"></div>
                                                <div class="col-3 border"></div>
                                                <div class="col-3 border"></div>
                                                </div>

                                                <br>
                                                <br>
                                                <div class="row">
                                                <div class="col-3 offset-3">
                                                    <img
                                                    src="https://media.geeksforgeeks.org/wp-content/uploads/box-model-1.png"
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                <div class="col-3">
                                                    <img
                                                    src="https://www.scaler.com/topics/images/properties-of-css-box-model.webp"
                                                    class="img-fluid"
                                                    alt="..."
                                                    />
                                                </div>
                                                </div>
                                                <div class="row"><div class="col-2">hello title </div></div>
                                                <div class="row border">
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                <div class="col-3 border" style="background-color: #94949a;">One of three columns</div>
                                                <div class="col-3 border" style="background-color: #94949a;"></div>

                                                <div class="col-3 border">One of three columns</div>
                                                <div class="col-3 border">200ml</div>
                                                <div class="col-3 border">500ml</div>
                                                <div class="col-3 border"></div>

                                                <div class="col-3 border">One of three columns</div>
                                                <div class="col-3 border"></div>
                                                <div class="col-3 border"></div>
                                                <div class="col-3 border"></div>
                                                </div>
                                            </div>

                         {{-- add new product --}}
                         {{-- hide form JavaScript --}}
                                       @foreach($showmail as $value)
                                   <input type="hidden" id="nameproduct" value='{{$value->product_name}}'>
                                     <input type="hidden" id="barcode"  value='{{$value->product_code}}'>
                                       <input type="hidden" id="product_img"  value='{{$value->product_img}}'>


                                 @endforeach

                         {{-- end form JavaScript --}}
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
