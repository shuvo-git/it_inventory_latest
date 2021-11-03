<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-4">
                            <span class="txt-dark head-font inline-block capitalize-font mb-5">Product Name:</span>
                            <address class="mb-15">
                                {{$product->name ?? ''}}
                            </address>
                        </div>
                        <div class="col-xs-4">
                            <span class="txt-dark head-font capitalize-font mb-5">Product Group:</span>
                            <address>{{$product->category->name ?? ''}}</address>
                        </div>
                        <div class="col-xs-4">
                            <span class="txt-dark head-font capitalize-font mb-5">Product Subgroup:</span>
                            <address>{{$product->subGroup->name ?? ''}}</address>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-4">
                            <span class="txt-dark head-font inline-block capitalize-font mb-5">Brannd:</span>
                            <address class="mb-15">
                                {{$product->brand->name ?? ''}}
                            </address>
                        </div>
                        <div class="col-xs-4">
                            <span class="txt-dark head-font capitalize-font mb-5">Created At:</span>
                            <address>{{$product->created_at->format('d M, Y') ?? ''}}</address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <span class="txt-dark head-font inline-block capitalize-font mb-5">Available Quantity:</span>
                            <address class="mb-15">
                                {{$product->available_qty ?? ''}}
                            </address>
                        </div>
                        <div class="col-xs-4">
                            <span class="txt-dark head-font capitalize-font mb-5">Depriciation Period(Year):</span>
                            <address>{{$product->depriciation_period ?? ''}}</address>
                        </div>
                        <div class="col-xs-4">
                            <span class="txt-dark head-font capitalize-font mb-5">Depriciation Amount(Taka):</span>
                            <address>{{$product->depriciation_amount ?? ''}}</address>
                        </div>
                    </div>
                    
                    <div class="seprator-block"></div>
                    
                    <div class="invoice-bill-table">
                        
                        <div class="button-list pull-right">
                            <a href="{{route('products.index')}}" class="btn btn-success mr-10">Back</a>
                            <button type="button" class="btn btn-primary btn-outline btn-icon left-icon" onclick="javascript:window.print();"> 
                                <i class="fa fa-print"></i><span> Print</span> 
                            </button>
                        </div>
                        <div class="clearfix"></div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->