@extends('layouts.app')

@section('content')
<!--<div class="row heading-bg">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h5 class="txt-dark">System Users</h5>
    </div>
     Breadcrumb
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#"><span>speciality pages</span></a></li>
            <li class="active"><span>blank page</span></li>
        </ol>
    </div>
     /Breadcrumb
</div>-->


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
                        {{Form::open(['route'=>'report.productWiseSell','method'=>'get'])}}
                        {{--<div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::select('category',category(),request('category'),['class'=>'form-control','placeholder'=>'Select Category','autocomplete'=>"off"])}}
                        </div>--}}
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_from',request('date_from'),['class'=>'form-control datepicker','placeholder'=>'Date From','autocomplete'=>"off"])}}
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_to',request('date_to'),['class'=>'form-control datepicker','placeholder'=>'Date To','autocomplete'=>"off"])}}
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('report.productWiseSell')}}" class="btn btn-sm btn-danger">Clear</a>
                            <button type="submit" class="btn btn-sm btn-success">
                                <span class="btn-text">Filter</span>
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
                    <h6 class="panel-title txt-dark">Product Wise Sells</h6>
                </div>
                <div class="pull-right">
                   
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
                                        <th>Name</th>
                                        <th>Total Qty</th>
                                        <th>Total Price</th>
                                        <th>Total Discount</th>
                                        <th>Grand Total</th>
                                        <!-- <th>Total Profit</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($sells->count()>0)
                                    @foreach($sells as $order)
                                    <tr>
                                        <td>{{$order->name ?? ''}}</td>
                                        <td>{{$order->qty ?? ''}}</td>
                                        <td>{{$order->total_price ?? ''}}</td>
                                        <td>{{$order->discount ?? ''}}</td>
                                        <td>{{$order->grand_total ?? ''}}</td>
                                        {{--<td>{{$order->profit ?? ''}}</td>--}}
                                        
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($sells->count()>0)
                            {{$sells->appends($_REQUEST)->render()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script>

    $(document).ready(function () {
    highlight_nav('reports', 'product_wise_sell');
    });

</script>
@endpush

