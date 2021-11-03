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
                        {{Form::open(['route'=>'stock-in.index','method'=>'get'])}}
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('supplier_id',request('supplier_id'),['class'=>'form-control','placeholder'=>'Supplier'])}}
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('stock-in.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">{{$pageInfo["title"]}} List - ({{$StockIns->count()}})</h6>
                </div>
                <div class="pull-right">
                    <a href="{{route('stock-in.create')}}" class="btn btn-sm btn-primary">Create New {{$pageInfo["title"]}}</a>
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
                                        <th>Invoice No</th>
                                        <th>Registration No</th>
                                        <th>Narration</th>
                                        <th>Supplier</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if($StockIns->count()>0)
                                    @foreach($StockIns as $StockIn)
                                    <tr>
                                        <td>{{$StockIn->invoice_no ?? ''}}</td>
                                        <td>{{$StockIn->registration_no ?? ''}}</td>
                                        <td>{{$StockIn->narration ?? ''}}</td>
                                        <td>{{$StockIn->getSupplier->supplier_name ?? ''}}</td>
                                        <td>
                                            {{--<a href="{{url('stock-in/'.$StockIn->id.'/edit')}}" class="btn btn-sm btn-primary">Edit</a>--}}
                                            <a href="{{url('stock-in/'.$StockIn->id)}}" class="btn btn-sm btn-primary">View</a>

                                            {{--@include('StockIn::edit') --}}

                                            {{--<button class="btn btn-sm btn-danger" onclick="showConfirmSweetAlert('delete-form-{{$StockIn->id}}')">Delete</button>
                                            
                                            {{Form::model($StockIn,['route'=>['stock-in.destroy',$StockIn->id],'method'=>'delete','id'=>'delete-form-'.$StockIn->id,'name'=>'delete-form-'.$StockIn->id])}}

                                            {{Form::close()}} --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($StockIns->count()>0)
                            {{$StockIns->appends($_REQUEST)->render()}}
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
        highlight_nav('stock_management', 'stock_in');
    });
</script>
@endpush

