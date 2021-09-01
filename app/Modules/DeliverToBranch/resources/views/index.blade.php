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
                        {{Form::open(['route'=>'sell.index','method'=>'get'])}}
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::number('invoice_no',request('invoice_no'),['class'=>'form-control','placeholder'=>'Invoice No'])}}
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::number('mobile',request('mobile'),['class'=>'form-control','placeholder'=>'Customer Mobile'])}}
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_from',request('date_from'),['class'=>'form-control datepicker','placeholder'=>'Date From','autocomplete'=>"off"])}}
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_to',request('date_to'),['class'=>'form-control datepicker','placeholder'=>'Date To','autocomplete'=>"off"])}}
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('sell.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">All Bills - {{$orders->total()}} </h6>
                </div>
                <div class="pull-right">
                    <a href="{{route('sell.create')}}" class="btn btn-sm btn-primary">New Bill</a>
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
                                        <th>Invoice No.</th>
                                        <th>Total Product</th>
                                        <th>Price</th>
                                        <th>Discount</th>
                                        <th>Grand Total</th>
                                        <th>Customer Mobile</th>
                                        <th>Purchase Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orders->count()>0)
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->invoice_no ?? ''}}</td>
                                        <td>{{$order->number_of_product ?? ''}}</td>
                                        <td>{{$order->total_price ?? ''}}</td>
                                        <td>{{$order->discount ?? ''}}</td>
                                        <td>{{$order->grand_price ?? ''}}</td>
                                        <td>{{$order->customer_mobile ?? ''}}</td>
                                        <td>{{$order->created_at->format('m-d-Y') ?? ''}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#show_{{$order->id}}"><i class="fa fa-eye"></i></button>
                                            
                                            <a href="{{route('sell.show',$order->id)}}" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-print"></i></a>
                                            @include('Sell::show')
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($orders->count()>0)
                            {{$orders->appends($_REQUEST)->render()}}
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
        highlight_nav('sell_management', 'all_invoice');
    });

</script>
@endpush

