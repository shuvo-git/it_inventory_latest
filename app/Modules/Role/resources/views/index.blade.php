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
                    <h6 class="panel-title txt-dark">Roles - {{$roles->count()}} </h6>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create">Create Role</button>
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
                                        <th style="width: 200px">Name</th>
                                        <th>Permissions</th>
                                        <th style="width: 200px">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if($roles->count()>0)
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->name ?? ''}}</td>
                                        
                                        <td>
                                           @if($role->permissions)
                                           @foreach($role->permissions as $permission)
                                           <span class="label label-success mb-1" style="display:inline-block;">{{$permission->name ?? ''}}</span>
                                           @endforeach
                                           @endif
                                        </td>
                                        
                                        <td>
                                           <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_{{$role->id}}">Edit</button>

                                            @include('Role::edit')
                                            
                                            <button class="btn btn-sm btn-danger" onclick="showConfirmSweetAlert('delete-form-{{$role->id}}')">Delete</button>
                                            {{Form::open(['route'=>['role.destroy',$role->id],'method'=>'delete','id'=>'delete-form-'.$role->id,'name'=>'delete-form-'.$role->id])}}

                                            {{Form::close()}}
                                            
                                            
                                        </td>

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

@include('Role::create')
@endsection
@push('scripts')
<script>

    $(document).ready(function () {
        highlight_nav('administration', 'role');

    });

</script>
@endpush

