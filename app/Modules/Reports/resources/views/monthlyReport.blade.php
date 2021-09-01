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
                        {{Form::open(['route'=>'report.monthly','method'=>'get'])}}
                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            {{Form::text('year',request('year'),['class'=>'form-control datepicker-year','placeholder'=>'Select Year','autocomplete'=>"off"])}}
                        </div>
                        

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('report.monthly')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">Monthly Wise Report-Year-{{request('year') ?? date('Y')}}</h6>
                </div>
                <div class="pull-right">
                    
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
                                        <th>Month</th>
                                        <th>Total Sell</th>
                                        <th>Total Profit</th>
                                        <th>Total Purchase</th>
                                        <th>Total Expense</th>
                                        <th>Total Due</th>
                                        <th>Profit / Loss</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($reports)>0)
                                    <?php $ts=$tp=$tmp=$te=$td=$tps=0;?>
                                    @foreach($reports as $report)
                                    <tr>
                                        <td>{{$report['month'] ?? 'N/A'}}</td>
                                        <td>{{$report['total_sell'] ?? 0}}</td>
                                        <td>{{$report['total_profit'] ?? 0}}</td>
                                        <td>{{$report['medicine_purchase'] ?? 0}}</td>
                                        <td>{{$report['total_expense'] ?? 0}}</td>
                                        <td>{{$report['total_due'] ?? 0}}</td>
                                        <?php
                                                $exp = $report['total_expense'] ?? 0;
                                                $profit = $report['total_profit'] ?? 0;
                                                $ps = $profit - $exp;
                                            ?>
                                        @if($ps <0)
                                        <td style="background: #f94b4b;color: white;font-size: 16px;">
                                            {{$ps}}
                                        </td>
                                        @else
                                        <td style="background: #16a928;color: white;font-size: 16px;">
                                            {{$ps}}
                                        </td>
                                        @endif
                                    </tr>
                                    
                                    <?php
                                        $ts += $report['total_sell'] ?? 0;
                                        $tp += $report['total_profit'] ?? 0;
                                        $tmp += $report['medicine_purchase'] ?? 0;
                                        $te += $report['total_expense'] ?? 0;
                                        $td += $report['total_due'] ?? 0;
                                        $tps +=$ps; 
                                        ?>
                                    @endforeach
                                    <tr style="background-color: aquamarine;color: black;">
                                        <td>Total</td>
                                        <td>{{$ts}}</td>
                                        <td>{{$tp}}</td>
                                        <td>{{$tmp}}</td>
                                        <td>{{$te}}</td>
                                        <td>{{$td}}</td>
                                        @if($tps <0)
                                        <td style="background: #f94b4b;color: white;font-size: 16px;">
                                            {{$tps}}
                                        </td>
                                        @else
                                        <td style="background: #16a928;color: white;font-size: 16px;">
                                            {{$tps}}
                                        </td>
                                        @endif
                                    </tr>
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
    highlight_nav('reports', 'monthly_report');
    
    $('.datepicker-year').datepicker({
             format: 'yyyy',
             viewMode: "years",
             minViewMode: "years",
             todayHighlight: true,
             orientation: "bottom left",
             autoclose: true,
           });
    });

</script>
@endpush

