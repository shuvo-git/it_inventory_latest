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
                        {{Form::open(['route'=>'report.dayWiseSell','method'=>'get'])}}
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_from',request('date_from'),['class'=>'form-control datepicker','placeholder'=>'Date From','autocomplete'=>"off"])}}
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date_to',request('date_to'),['class'=>'form-control datepicker','placeholder'=>'Date To','autocomplete'=>"off"])}}
                        </div>

                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('report.dayWiseSell')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">Day Wise Report </h6>
                </div>
                <div class="pull-right">

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="table-wrap">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Sell Date</th>
                                        <th>Products</th>
                                        <th>Product Wise Sell</th>
                                        <th>Total Sale</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($sells->count()>0)
                                    @foreach($sells as $date=>$sell)
                                    <?php $i=1;?>
                                        @foreach($sell as $data)
                               
                                        <tr>
                                            @if($i)
                                            <td class="text-center" style="font-size: 20px" rowspan="{{$sell->count()}}">{{$date}}</td>
                                            
                                            @endif
                                            <td>{{$data->saleProduct->name ?? ''}}</td>
                                            <td>{{number_format($data->total_sell ?? 0)}}</td>
                                            @if($i)
                                            <td class="text-center" style="font-size: 20px" rowspan="{{$sell->count()}}">{{number_format($ts = $sell->sum('total_sell'))}}</td>
                                            @endif
                                            <?php $i=0;?>
                                        </tr>
                                        @endforeach
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
        highlight_nav('reports', 'day_wise_sell');
    });

</script>
@endpush

