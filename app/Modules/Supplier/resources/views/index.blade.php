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
                        {{Form::open(['route'=>'supplier.index','method'=>'get'])}}
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('supplier_name',request('supplier_name'),['class'=>'form-control','placeholder'=>$pageInfo["title"].' Name'])}}
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('supplier.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">{{$pageInfo["title"]}} List - {{$suppliers->count()}} </h6>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create">Create New {{$pageInfo["title"]}}</button>
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
                                        <th>Supplier Name</th>
                                        <th>Contact Person</th>
                                        <th>Contact No</th>
                                        <th>Address</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if($suppliers->count()>0)
                                    @foreach($suppliers as $supplier)
                                    <tr>
                                        <td>{{$supplier->supplier_name ?? ''}}</td>
                                        <td>{{$supplier->supplier_contact_person ?? ''}}</td>
                                        <td>{{$supplier->supplier_contact_no ?? ''}}</td>
                                        <td>{{$supplier->supplier_address ?? ''}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_{{$supplier->id}}">Edit</button>

                                            @include('Supplier::edit')

                                            <button class="btn btn-sm btn-danger" onclick="showConfirmSweetAlert('delete-form-{{$supplier->id}}')">Delete</button>
                                            {{Form::model($supplier,['route'=>['supplier.destroy',$supplier->id],'method'=>'delete','id'=>'delete-form-'.$supplier->id,'name'=>'delete-form-'.$supplier->id])}}

                                            {{Form::close()}}
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>

                            @if($suppliers->count()>0)
                            {{$suppliers->appends($_REQUEST)->render()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Supplier::create')
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        highlight_nav('settings', 'supplier_list');
    });
</script>
@endpush

