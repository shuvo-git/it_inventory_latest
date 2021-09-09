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
                        {{Form::open(['route'=>'returns.index','method'=>'get'])}}
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('supplier_id',request('supplier_id'),['class'=>'form-control','placeholder'=>'Supplier'])}}
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('returns.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">{{$pageInfo["title"]}} List - ({{$Returns->count()}})</h6>
                </div>
                <div class="pull-right">
                    <a href="{{route('returns.create')}}" class="btn btn-sm btn-primary">Create New {{$pageInfo["title"]}}</a>
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
                                        <th>Branch</th>
                                        <th>Delivery Person</th>
                                        <th>Mobile</th>
                                        <th>Date</th>
                                        <th>Remarks</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if($Returns->count()>0)
                                    @foreach($Returns as $Return)
                                    <tr>
                                        <td>{{$Return->branch->br_name ?? ''}}</td>
                                        <td>{{$Return->delivery_person ?? ''}}</td>
                                        <td>{{$Return->delivery_person_mobile_no ?? ''}}</td>
                                        <td>{{$Return->date($Return->return_date) ?? ''}}</td>
                                        <td>{{$Return->remarks ?? ''}}</td>
                                        <td>
                                            {{--<a href="{{url('returns/'.$Return->id.'/edit')}}" class="btn btn-sm btn-primary">Edit</a>--}}
                                            <a href="{{url('returns/'.$Return->id)}}" class="btn btn-sm btn-primary">View</a>

                                            {{--@include('StockIn::edit') --}}

                                            <button class="btn btn-sm btn-danger" onclick="showConfirmSweetAlert('delete-form-{{$Return->id}}')">Delete</button>
                                            
                                            {{Form::model($Return,['route'=>['returns.destroy',$Return->id],'method'=>'delete','id'=>'delete-form-'.$Return->id,'name'=>'delete-form-'.$Return->id])}}

                                            {{Form::close()}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($Returns->count()>0)
                            {{$Returns->appends($_REQUEST)->render()}}
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
    $(document).ready(function () 
    {
        highlight_nav('stock_management', 'stock_in');
    });
</script>
@endpush

