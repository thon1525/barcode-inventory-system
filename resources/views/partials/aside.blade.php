<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">
            Main
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{url('index')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-item">
            <a class="nav-link " href="{{url('pos')}}">
                <i class="bi bi-grid"></i>
                <span>POS</span>
            </a>
        </li><!-- End Dashboard Nav -->
        <li class="nav-heading">
            Features
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#product-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="product-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('product/add_product')}}">
                        <i class="bi bi-circle"></i><span>Add New Product</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('product/manage_product')}}">
                        <i class="bi bi-circle"></i><span>Manage Product</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#category-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="category-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('category/add_category')}}">
                        <i class="bi bi-circle"></i><span>Add New Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('category/manage_category')}}">
                        <i class="bi bi-circle"></i><span>Manage Category</span>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#supplier-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Supplier</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="supplier-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('supplier/add_supplier')}}">
                        <i class="bi bi-circle"></i><span>Add New supplier</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('supplier/manage_supplier')}}">
                        <i class="bi bi-circle"></i><span>Manage supplier</span>
                    </a>
                </li>

            </ul>
        </li>
        {{-- add new stock in --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#stock-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Stock Product</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="stock-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('/product/stock_in')}}">
                        <i class="bi bi-circle"></i><span>Add New Stock In</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/product/stock_in/product/manage_stock_in')}}">
                        <i class="bi bi-circle"></i><span>Manage Stock In</span>
                    </a>
                </li>

            </ul>
        </li>
        {{-- add new tax product import product --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#taxproduct" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Add Tax</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="taxproduct" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('/view/tax')}}">
                        <i class="bi bi-circle"></i><span>Add Tax</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/view/manage/tax')}}">
                        <i class="bi bi-circle"></i><span>Manage Tax</span>
                    </a>
                </li>

            </ul>
        </li>
         {{-- srtate  new coupon--}}
           <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#couponpro" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>coupon</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="couponpro" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('/coupon/list')}}">
                        <i class="bi bi-circle"></i><span>Add New  coupon</span>
                    </a>
                </li>
            </ul>
        </li>
          {{-- end stock in coupon new coupon--}}

        {{-- add new Promotion--}}
         <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#promotion" data-bs-toggle="collapse" href="{{url('/promotion')}}">
                <i class="bi bi-menu-button-wide"></i><span>Promotions</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="promotion" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('/promotion')}}">
                        <i class="bi bi-circle"></i><span>Manage hello promotions</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            {{-- end add new tax product import product --}}
            {{-- sart product add import product in ecommerce --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#product-import" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>import product</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="product-import" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('/import_product/add_product')}}">
                        <i class="bi bi-circle"></i><span>Add New import product</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('/import_product/add_product/view_product')}}">
                        <i class="bi bi-circle"></i><span>Manage import Product</span>
                    </a>
                </li>

            </ul>
        </li>
    {{-- add new stock in import product --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#stock-in-imort" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Stock Product Import</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="stock-in-imort" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('/stock_in/manage_product_stock_in')}}">
                        <i class="bi bi-circle"></i><span>Manage Stock In product import</span>
                    </a>
                </li>
            </ul>
        </li>
        {{-- add new stock in import  import product --}}
         {{-- add new in list product  tax --}}
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#list_taxproduct" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span> list tax product</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="list_taxproduct" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url('/add_producttax')}}">
                        <i class="bi bi-circle"></i><span>Add list tax</span>
                    </a>
                    <a href="{{url('/manage/product/view_tax')}}">
                        <i class="bi bi-circle"></i><span>manage tax</span>
                    </a>
                </li>

            </ul>
        </li>
      {{-- end new in list product  tax --}}
      {{-- add new stock in import product --}}
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#Scrapedataecom" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>Show view data </span><i
                class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="Scrapedataecom" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{url('/view/see/show_data')}}">
                    <i class="bi bi-circle"></i><span>View product other web</span>
                </a>
            </li>
        </ul>
    </li>
    {{-- add new stock in import  import product --}}
     {{-- add new stock in import set product  --}}
     <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#productset" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>show product</span><i
                class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="productset" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{url('/view/export/set_product')}}">
                    <i class="bi bi-circle"></i><span>Set product</span>
                </a>
            </li>
        </ul>
    </li>
    {{-- add new stock in import  import set product --}}
        {{-- end product add import product in ecommerce --}}
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{url('pos/manage')}}">
                <i class="bi bi-file-earmark"></i>
                <span>POS Details</span>
            </a>
        </li>

        {{--

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>F.A.Q</span>
            </a>
        </li><!-- End F.A.Q Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-contact.html">
                <i class="bi bi-envelope"></i>
                <span>Contact</span>
            </a>
        </li><!-- End Contact Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-blank.html">
                <i class="bi bi-file-earmark"></i>
                <span>Blank</span>
            </a>
        </li><!-- End Blank Page Nav --> --}}

    </ul>

</aside><!-- End Sidebar-->
