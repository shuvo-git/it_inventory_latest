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
                        {{Form::open(['route'=>'companies.index','method'=>'get'])}}
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('name',request('name'),['class'=>'form-control','placeholder'=>'Supplier Name'])}}
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('sr_name',request('sr_name'),['class'=>'form-control','placeholder'=>'Company Name'])}}
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('sr_mobile_no',request('sr_mobile_no'),['class'=>'form-control','placeholder'=>'Supplier Mobile No'])}}
                        </div>

                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('companies.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">Supplier - {{$companies->count()}} </h6>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create">Add Supplier</button>
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
                                        <th>Company Name</th>
                                        <th>Supplier Mobile No.</th>
                                        <th>Created At</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if($companies->count()>0)
                                    @foreach($companies as $company)
                                    <tr>
                                        <td>{{$company->name ?? ''}}</td>
                                        <td>{{$company->sr_name ?? ''}}</td>
                                        <td>{{$company->sr_mobile_no ?? ''}}</td>

                                        <td>{{$company->created_at ?? ''}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_{{$company->id}}">Edit</button>

                                            @include('Companies::edit')

                                            <button class="btn btn-sm btn-danger" onclick="showConfirmSweetAlert('delete-form-{{$company->id}}')">Delete</button>
                                            {{Form::model($company,['route'=>['companies.destroy',$company->id],'method'=>'delete','id'=>'delete-form-'.$company->id,'name'=>'delete-form-'.$company->id])}}
                                            {{Form::close()}}
                                        </td>

                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>

                            @if($companies->count()>0)
                            {{$companies->appends($_REQUEST)->render()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Companies::create')
@endsection
@push('scripts')

<script>

    $(document).ready(function () {
    highlight_nav('settings', 'company_management');
    });

</script>
@endpush

