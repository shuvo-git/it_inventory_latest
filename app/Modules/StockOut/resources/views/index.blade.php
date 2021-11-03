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
                        {{Form::open(['route'=>'stock-out.index','method'=>'get'])}}
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('supplier_id',request('supplier_id'),['class'=>'form-control','placeholder'=>'Supplier'])}}
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('stock-out.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">{{$pageInfo["title"]}} List - ({{$StockOuts->count()}})</h6>
                </div>
                <div class="pull-right">
                    <a href="{{route('stock-out.create')}}" class="btn btn-sm btn-primary">Create New {{$pageInfo["title"]}}</a>
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
                                        <th>Challan No</th>
                                        <th>Branch/Division</th>
                                        <th>Requisition No</th>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if($StockOuts->count()>0)
                                    @foreach($StockOuts as $StockOut)
                                    <tr>
                                        <td>{{$StockOut->challan_no ?? ''}}</td>
                                        <td>{{$StockOut->branch->br_name ?? ''}}</td>
                                        <td>{{$StockOut->requisition_no ?? ''}}</td>
                                        <td>{{$StockOut->date($StockOut->delivery_date) ?? ''}}</td>
                                        <td>{{$StockOut->product->name ?? ''}}</td>
                                        <td>{{$StockOut->quantity ?? ''}}</td>
                                        <td>
                                            <a href="{{url('stock-out/'.$StockOut->id)}}" class="btn btn-sm btn-primary">View</a>
                                            {{--<button class="btn btn-sm btn-danger" onclick="showConfirmSweetAlert('delete-form-{{$StockOut->id}}')">Delete</button>
                                            {{Form::model($StockOut,['route'=>['stock-out.destroy',$StockOut->id],'method'=>'delete','id'=>'delete-form-'.$StockOut->id,'name'=>'delete-form-'.$StockOut->id])}}
                                            {{Form::close()--}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($StockOuts->count()>0)
                            {{$StockOuts->appends($_REQUEST)->render()}}
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
        highlight_nav('stock_management', 'stock_out');
    });
</script>
@endpush

