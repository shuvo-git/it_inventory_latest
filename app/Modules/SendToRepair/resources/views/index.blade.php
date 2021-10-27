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
                        {{Form::open(['route'=>'send-to-repair.index','method'=>'get'])}}
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
                            <a href="{{route('send-to-repair.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">{{ $pageInfo['title'] }} - {{$Repairs->total()}} </h6>
                </div>
                <div class="pull-right">
                    <a href="{{route('send-to-repair.create')}}" class="btn btn-sm btn-primary">Create New {{ $pageInfo['title'] }}</a>
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
                                        <th>SL.</th>
                                        <th>Supplier</th>
                                        <th>Delivery Person Name</th>
                                        <th>Mobile No.</th>
                                        <th>Purchase Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if($Repairs->count()>0)
                                    @foreach($Repairs as $key=>$Repair)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$Repair->getSupplier->supplier_name ?? ''}}</td>
                                        <td>{{$Repair->delivery_person ?? ''}}</td>
                                        <td>{{$Repair->delivery_person_mobile_no ?? ''}}</td>
                                        <td>{{\Carbon\Carbon::parse($Repair->send_date)->format('d M, Y') ?? ''}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#show_{{$Repair->id}}"><i class="fa fa-eye"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($Repairs->count()>0)
                            {{$Repairs->appends($_REQUEST)->render()}}
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

