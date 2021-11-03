<div class="fixed-sidebar-left">
    <ul class="nav navbar-nav side-nav nicescroll-bar">
        <li class="navigation-header">
            <span>Main</span> 
            <i class="zmdi zmdi-more"></i>
        </li>

        <li>
            <a href="{{route('home')}}" class="home">
                <div class="pull-left">
                    <i class="zmdi zmdi-home mr-20"></i>
                    <span class="right-nav-text">Home</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>

        <li><hr class="light-grey-hr mb-10"/></li>
        @can('Administration')
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" class="administration" data-target="#administration">
                <div class="pull-left">
                    <i class="zmdi zmdi-male mr-20"></i>
                    <span class="right-nav-text">Administration</span>
                </div>
                <div class="pull-right">
                    <i class="zmdi zmdi-caret-down"></i>
                </div>
                <div class="clearfix"></div>
            </a>
            <ul id="administration" class="collapse collapse-level-1 two-col-list">
                @can('Role Management')
                <li>
                    <a href="{{route('role.index')}}" class="role">Manage User Roles</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('Settings')
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" class="settings" data-target="#settings">
                <div class="pull-left">
                    <i class="zmdi zmdi-settings mr-20"></i>
                    <span class="right-nav-text">App Settings</span>
                </div>
                <div class="pull-right">
                    <i class="zmdi zmdi-caret-down"></i>
                </div>
                <div class="clearfix"></div>
            </a>
            <ul id="settings" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="cat_list" href="{{route('categories.index')}}">Manage Group</a>
                </li>
                <li>
                    <a class="subcat_list" href="{{route('subgroup.index')}}">Manage Sub Group</a>
                </li>
                <li>
                    <a class="brand_list" href="{{route('brand.index')}}">Manage Brand</a>
                </li>
                <li>
                    <a class="supplier_list" href="{{route('supplier.index')}}" >Manage Supplier</a>
                </li>
            </ul>
        </li>
        @endcan

        @can('System User Management')
        <li>
            <a href="{{route('system-users.index')}}" class="user_management">
                <div class="pull-left">
                    <i class="zmdi zmdi-account mr-20"></i>
                    <span class="right-nav-text">User Management</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        @endcan
        
        @can('Product Management')
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" class="product_management" data-target="#product_management">
                <div class="pull-left">
                    <i class="zmdi zmdi-cake mr-20"></i>
                    <span class="right-nav-text">Product Management</span>
                </div>
                <div class="pull-right">
                    <i class="zmdi zmdi-caret-down"></i>
                </div>
                <div class="clearfix"></div>
            </a>
            <ul id="product_management" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="products" href="{{route('products.index')}}">Products</a>
                </li>
                <li>
                    <a class="create_product" href="{{route('products.create')}}">Create Products</a>
                </li>
                
            </ul>
        </li>
        @endcan

        @can('Stock Management')
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" class="stock_management" data-target="#stock_management">
                <div class="pull-left">
                    <i class="zmdi zmdi-shopping-cart-plus mr-20"></i>
                    <span class="right-nav-text">Stock Management</span>
                </div>
                <div class="pull-right">
                    <i class="zmdi zmdi-caret-down"></i>
                </div>
                <div class="clearfix"></div>
            </a>
            <ul id="stock_management" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="stock_in" href="{{route('stock-in.index')}}">Stock In List</a>
                </li>
                <li>
                    <a class="stock_out" href="{{route('stock-out.index')}}">Stock Out List</a>
                </li>
                <li>
                    <a class="returns" href="{{route('returns.index')}}">Product Returns</a>
                </li>
                <li>
                    <a class="send_to_repair" href="{{route('send-to-repair.index')}}">Send to Repair</a>
                </li>
                <li>
                    <a class="receive_from_vendor" href="{{route('return-from-vendor.index')}}">Return From Vendor</a>
                </li>
            </ul>
        </li>
        @endcan

        

        @can('Kitchen Management')
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" class="kitchen_management" data-target="#kitchen_management">
                <div class="pull-left">
                    <i class="zmdi zmdi-money mr-20"></i>
                    <span class="right-nav-text">Kitchen Management</span>
                </div>
                <div class="pull-right">
                    <i class="zmdi zmdi-caret-down"></i>
                </div>
                <div class="clearfix"></div>
            </a>
            <ul id="kitchen_management" class="collapse collapse-level-1 two-col-list">
                <li>
                    <a class="kitchen_invoice" href="{{route('kitchen.index')}}">Kitchen Invoice List</a>
                </li>
                <li>
                    <a class="kitchen" href="{{route('kitchen.create')}}">Create New Kitchen Invoice</a>
                </li>
            </ul>
        </li>
        @endcan

        @can('Report Manager')
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" class="reports" data-target="#reports">
                <div class="pull-left">
                    <i class="zmdi zmdi-chart mr-20"></i>
                    <span class="right-nav-text">Reports</span>
                </div>
                <div class="pull-right">
                    <i class="zmdi zmdi-caret-down"></i>
                </div>
                <div class="clearfix"></div>
            </a>
            <ul id="reports" class="collapse collapse-level-1 two-col-list">
                {{--<li>
                    <a class="all_invoice" href="{{route('sell.index')}}">All Invoice</a>
                </li>
                <li>
                    <a class="product_wise_sell" href="{{route('report.productWiseSell')}}">Product Wise Sell</a>
                </li>
                <li>
                    <a class="day_wise_sell" href="{{route('report.dayWiseSell')}}">Day Wise Sell</a>
                </li>
                <li>
                    <a class="daily_report" href="{{route('report.daily')}}">Daily Reports</a>
                </li-->
                {{--<li>
                    <a class="monthly_report" href="{{route('report.monthly')}}">Monthly Reports</a>
                </li>--}}

            </ul>
        </li>
        @endcan
        

<!--        @can('Settings')
        <li>
            <a href="{{route('settings.index')}}" class="settings">
                <div class="pull-left">
                    <i class="zmdi zmdi-settings mr-20"></i>
                    <span class="right-nav-text">Settings</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        @endcan-->
    </ul>
</div>