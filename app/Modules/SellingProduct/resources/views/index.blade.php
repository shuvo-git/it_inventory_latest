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
                        {{Form::open(['route'=>'selling-product.index','method'=>'get'])}}
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('name',request('name'),['class'=>'form-control','placeholder'=>'Product Name'])}}
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::select('category',sellingCategory(),request('category'),['class'=>'form-control select2','placeholder'=>'Select Category'])}}
                        </div>
                        
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_from',request('date_from'),['class'=>'form-control datepicker','placeholder'=>'Date From','autocomplete'=>"off"])}}
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_to',request('date_to'),['class'=>'form-control datepicker','placeholder'=>'Date To','autocomplete'=>"off"])}}
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('selling-product.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <a href="{{route('selling-product.create')}}" class="btn btn-sm btn-primary">Add Product</a>
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
                                        <th>Category</th>
                                        <th>Details</th>
                                        <th>Sell Price</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if($products->count()>0)
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->name ?? ''}}</td>
                                        <td>{{$product->sellingCategory->name ?? ''}}</td>
                                        <td>{{$product->details ?? ''}}</td>
                                        <td>{{$product->sell_price ?? ''}}</td>
                                        <td>{{($product->status == 0) ? 'Unavailable':'Available'}}</td>
                                        <td>{{$product->created_at->format('Y-m-d') ?? ''}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_{{$product->id}}">Edit</button>

                                            @include('SellingProduct::edit')

                                            <button class="btn btn-sm btn-danger" onclick="showConfirmSweetAlert('delete-form-{{$product->id}}')">Delete</button>
                                            {{Form::model($product,['route'=>['selling-product.destroy',$product->id],'method'=>'delete','id'=>'delete-form-'.$product->id,'name'=>'delete-form-'.$product->id])}}
                                            {{Form::close()}}
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
    highlight_nav('product_management', 'selling_product');
    });

</script>
@endpush

