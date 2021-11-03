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
                        {{Form::open(['route'=>'products.index','method'=>'get'])}}
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('name',request('name'),['class'=>'form-control','placeholder'=>'Product Name'])}}
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::select('category',category(),request('category'),['class'=>'form-control select2','placeholder'=>'Select Category'])}}
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::select('sub_category',subGroup(),request('sub_category'),['class'=>'form-control select2','placeholder'=>'Select Sub-category'])}}
                        </div>
                        {{--<div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::select('company',companies(),request('company'),['class'=>'form-control select2','placeholder'=>'Select Company'])}}
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::select('status',productStatus(),request('status'),['class'=>'form-control select2','placeholder'=>'Select Status'])}}
                        </div>--}}
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_from',request('date_from'),['class'=>'form-control datepicker','placeholder'=>'Date From','autocomplete'=>"off"])}}
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_to',request('date_to'),['class'=>'form-control datepicker','placeholder'=>'Date To','autocomplete'=>"off"])}}
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('products.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">Total Products - {{$products->total()}} </h6>
                </div>
                <div class="pull-right">
                    <a href="{{route('products.create')}}" class="btn btn-sm btn-primary">Add Product</a>
                    {{--<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#bulk_upload">Bulk Product Upload</button>
                     @include('Products::bulk_upload')
                     --}}
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
                                        <th>Group</th>
                                        <th>Sub Group</th>
                                        <th>Brand</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($products->count()>0)
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name ?? ''}}</td>
                                        <td>{{$product->category->name ?? ''}}</td>
                                        <td>{{$product->subGroup->name ?? ''}}</td>
                                        <td>{{$product->brand->name ?? ''}}</td>
                                        <td>{{$product->created_at->format('d M, Y') ?? ''}}</td>
                                        <td>
                                            <a href="{{url('products/'.$product->id)}}" class="btn btn-sm btn-primary">View</a>
                                            {{--<button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#show_{{$product->id}}">View</button>--}}
                                            {{--@include('Products::show')--}}
                                            <button type="button" class="btn btn-outline btn-sm btn-primary" data-toggle="modal" data-target="#edit_{{$product->id}}">Edit</button>
                                            @include('Products::edit')

                                            {{--<button class="btn btn-sm btn-danger" onclick="showConfirmSweetAlert('delete-form-{{$product->id}}')">Delete</button>
                                            {{Form::model($product,['route'=>['products.destroy',$product->id],'method'=>'delete','id'=>'delete-form-'.$product->id,'name'=>'delete-form-'.$product->id])}}
                                            {{Form::close()}} --}}
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>

                            @if($products->count()>0)
                            {{$products->appends($_REQUEST)->render()}}
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
        highlight_nav('product_management', 'products');
        
    });

</script>
@endpush

