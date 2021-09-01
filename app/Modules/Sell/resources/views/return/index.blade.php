@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Filter </h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">
                        {{Form::open(['route'=>'return.index','method'=>'get'])}}
                        
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('product',request('product'),['class'=>'form-control','placeholder'=>'Product Name'])}}
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_from',request('date_from'),['class'=>'form-control datepicker','placeholder'=>'Date From','autocomplete'=>"off"])}}
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_to',request('date_to'),['class'=>'form-control datepicker','placeholder'=>'Date To','autocomplete'=>"off"])}}
                        </div>

                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('return.index')}}" class="btn btn-sm btn-danger">Clear</a>
                            <button type="submit" class="btn btn-sm btn-success">
                                <span class="btn-text">submit</span>
                            </button>

                        </div>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Return Products</h6>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create">New Return</button>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Category</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total Price</th>
                                        <th>Discount</th>
                                        <th>Return Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($returnItems->count()>0)
                                    @foreach($returnItems as $returnItem)
                                    <tr>
                                        <td>{{$returnItem->product->name ?? ''}}</td>
                                        <td>{{$returnItem->product->category->name ?? ''}}</td>
                                        <td>{{$returnItem->qty ?? ''}}</td>
                                        <td>{{$returnItem->unit_price ?? ''}}</td>
                                        <td>{{$returnItem->total_price ?? ''}}</td>
                                        <td>{{$returnItem->discount ?? ''}}</td>
                                        <td>{{$returnItem->returnable_amount ?? ''}}</td>
                                        <td>{{$returnItem->created_at->format('Y-m-d') ?? ''}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_{{$returnItem->id}}">Edit</button>

                                           
                                        </td>

                                    </tr>
                                    @endforeach
                                    <tr style="background-color: aquamarine;color: black;">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{$returnItems->sum('total_price')}}</td>
                                        <td>{{$returnItems->sum('discount')}}</td>
                                        <td>{{$returnItems->sum('returnable_amount')}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>

                            @if($returnItems->count()>0)
                            {{$returnItems->appends($_REQUEST)->render()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Sell::return.create')
@endsection
@push('scripts')

<script>
    $(document).ready(function () {
        highlight_nav('product_management', 'return');
    });
    
    var buy_price=0;
    $("#product_id").change(function () {
        var id = $("#product_id").val();
        if (id == '')
        {
            buy_price=0;
            setReturnableAmount();
            return;
        }

        $.ajax({
            method: "POST",
            url: "{{route('products.product-details')}}",
            data: {id: id},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
                .done(function (data) {
                    console.log(data);
                    buy_price = data.buy_price;
                    setReturnableAmount();
                });
    });

$("#qty").bind('change keyup', function(e){
    setReturnableAmount();
});
$("#discount").bind('change keyup', function(e){
    setReturnableAmount();
});
function setReturnableAmount()
{
    var qty = $("#qty").val();
    var dis = $("#discount").val();
    
    var returnAble = buy_price*qty-dis;
    $("#returnable").html(returnAble);
}
</script>
@endpush

