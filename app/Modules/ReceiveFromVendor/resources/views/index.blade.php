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
                        {{Form::open(['route'=>'receive-from-vendor.index','method'=>'get'])}}
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
                            <a href="{{route('receive-from-vendor.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">{{ $pageInfo['title'] }} - {{$ReceiveFromVendors->total()}} </h6>
                </div>
                <div class="pull-right">
                    <a href="{{route('receive-from-vendor.create')}}" class="btn btn-sm btn-primary">Create New {{ $pageInfo['title'] }}</a>
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
                                    @if($ReceiveFromVendors->count()>0)
                                    @foreach($ReceiveFromVendors as $Repair)
                                    <tr>
                                        <td>{{$Repair->invoice_no ?? ''}}</td>
                                        <td>{{$Repair->number_of_product ?? ''}}</td>
                                        <td>{{$Repair->total_price ?? ''}}</td>
                                        <td>{{$Repair->discount ?? ''}}</td>
                                        <td>{{$Repair->grand_price ?? ''}}</td>
                                        <td>{{$Repair->customer_mobile ?? ''}}</td>
                                        <td>{{$Repair->created_at->format('m-d-Y') ?? ''}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#show_{{$Repair->id}}"><i class="fa fa-eye"></i></button>
                                            
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($ReceiveFromVendors->count()>0)
                            {{$ReceiveFromVendors->appends($_REQUEST)->render()}}
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
        highlight_nav('stock_management', 'send_to_repair');
    });

</script>
@endpush

