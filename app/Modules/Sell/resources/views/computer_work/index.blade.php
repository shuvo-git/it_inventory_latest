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
                        {{Form::open(['route'=>'computerWork.index','method'=>'get'])}}
                        
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_from',request('date_from'),['class'=>'form-control datepicker','placeholder'=>'Date From','autocomplete'=>"off"])}}
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_to',request('date_to'),['class'=>'form-control datepicker','placeholder'=>'Date To','autocomplete'=>"off"])}}
                        </div>

                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('computerWork.index')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">Computer Work</h6>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#create">New Work</button>
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
                                        <th>Note</th>
                                        <th>Total Amount</th>
                                        <th>Cost</th>
                                        <th>Profit</th>
                                        <th>Sell Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($computerWorks->count()>0)
                                    @foreach($computerWorks as $computerWork)
                                    <tr>
                                        <td>{{$computerWork->note ?? ''}}</td>
                                        <td>{{$computerWork->total_amount ?? ''}}</td>
                                        <td>{{$computerWork->cost ?? ''}}</td>
                                        <td>{{$computerWork->profit ?? ''}}</td>

                                        <td>{{$computerWork->created_at->format('Y-m-d') ?? ''}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#edit_{{$computerWork->id}}">Edit</button>

                                            @include('Sell::computer_work.edit')
                                        </td>

                                    </tr>
                                    @endforeach
                                    <tr style="background-color: aquamarine;color: black;">
                                        <td>Total</td>
                                        <td>{{$computerWorks->sum('total_amount')}}</td>
                                        <td>{{$computerWorks->sum('cost')}}</td>
                                        <td>{{$computerWorks->sum('profit')}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>

                            @if($computerWorks->count()>0)
                            {{$computerWorks->appends($_REQUEST)->render()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Sell::computer_work.create')
@endsection
@push('scripts')

<script>

    $(document).ready(function () {
    highlight_nav('sell_management', 'computer_work');
    });

</script>
@endpush

