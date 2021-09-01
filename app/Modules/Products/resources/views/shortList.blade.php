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
                        {{Form::open(['route'=>'products.shortList','method'=>'get'])}}
                        
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::select('category',category(),request('category'),['class'=>'form-control select2','placeholder'=>'Select Category'])}}
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::select('company',companies(),request('company'),['class'=>'form-control select2','placeholder'=>'Select Company'])}}
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('products.shortList')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">Total Shorts - {{$shortLists->count()}} </h6>
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
                                        <th>Company Name</th>
                                        <th>Available Qty</th>
                                        <th>Short List Qty</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if($shortLists->count()>0)
                                    @foreach($shortLists as $product)
                                    <tr>
                                        <td>{{$product->name ?? ''}}</td>
                                        <td>{{$product->category ?? ''}}</td>
                                        <td>{{$product->company ?? ''}}</td>
                                        <td>{{$product->available_qty ?? ''}}</td>
                                        <td>{{$product->short_list_qty ?? ''}}</td>
                                        
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
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
    highlight_nav('product_management', 'short_list');
    });

</script>
@endpush

