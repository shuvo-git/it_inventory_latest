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
                        {{Form::open(['route'=>'report.daily','method'=>'get'])}}
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            {{Form::text('date',request('date'),['class'=>'form-control datepicker','placeholder'=>'Select Date','autocomplete'=>"off"])}}
                        </div>

                        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
                            <a href="{{route('report.daily')}}" class="btn btn-sm btn-danger">Clear</a>
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
                    <h6 class="panel-title txt-dark">Daily Summary </h6>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#set_balance">Set Balance</button>
                    @include('Reports::set_balance')
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
                                        <th>Sale Date</th>
                                        <th>Last Day Balance</th>
                                        <th>Total Sale</th>
                                        <!-- <th>Total Loan</th>
                                        <th>Total Loan Paid</th>
                                        <th>Total Due Received</th>
                                        <th>Total Due</th> -->
                                        <th>Total Purchase</th>
                                        <th>Total Expense</th>
                                        <th>Cash</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{$sellDate}}</td>
                                        <td>{{number_format($lb = round($lastDayBalance ?? 0))}}</td>
                                        <td>{{number_format($ts = round($dailySells->sum('total_sell') ?? 0))}}</td>
                                        {{--<td>{{number_format($lr = round($loans->sum('credit_amount') ?? 0))}}</td>
                                        <td>{{number_format($lp = round($loans->sum('debit_amount') ?? 0))}}</td>
                                        <td>{{number_format($dr = round($dues->sum('debit_amount') ?? 0))}}</td>
                                        <td>{{number_format($du = round($dues->sum('credit_amount') ?? 0))}}</td>--}}
                                        <td>{{number_format($pe = round($purchaseExpenses->sum('amount') ?? 0))}}</td>
                                        <td>{{number_format($te = round($otherExpenses->sum('amount') ?? 0))}}</td>
                                        <td>
                                            {{number_format($lb+$ts-$pe-$te)}}
                                            <!-- +$lr+$dr-$lp-$du -->
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Daily Report</h6>
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
                                        <th>Product</th>
                                        <th>Sale Date</th>
                                        <th>Total Sale</th>
                                        <!-- <th>Total Profit</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($dailySells->count()>0)
                                    @foreach($dailySells as $report)
                                    <tr>
                                        <td>{{$report->saleProduct->name ?? ''}}</td>
                                        <td>{{$report->sell_date ?? ''}}</td>
                                        <td>{{number_format(round($report->total_sell ?? 0))}}</td>
                                        {{--<td>{{number_format(round($report->total_profit ?? 0))}}</td>--}}
                                    </tr>
                                    @endforeach
                                    <tr style="background-color: aquamarine;color: black;">
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{number_format(round($dailySells->sum('total_sell')))}}</td>
                                        {{--<td>{{number_format(round($dailySells->sum('total_profit')))}}</td>--}}
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
    
    {{-- <div class="col-lg-6">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Today's Dues</h6>
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
                                        <th>Customer Name</th>
                                        <th>Note</th>
                                        <th>Due Amount</th>
                                        <th>Due Received Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($dues->count()>0)
                                    @foreach($dues as $report)
                                    <tr>
                                        <td>{{$report->customer->name ?? ''}}</td>
                                        <td>{{$report->note ?? ''}}</td>
                                        <td>{{number_format($da = round($report->credit_amount ?? 0))}}</td>
                                        <td>{{number_format($dr = round($report->debit_amount ?? 0))}}</td>
                                    @endforeach
                                    <tr style="background-color: aquamarine;color: black;">
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{number_format($ca = round($dues->sum('credit_amount')))}}</td>
                                        <td>{{number_format($da =round($dues->sum('debit_amount')))}}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="col-lg-6">
        <div class="panel panel-default card-view" style="min-height: 335px">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Today's Purchase</h6>
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
                                        <th>Purchase Category</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_amount = 0;
                                    $grand_total = 0;
                                    ?>
                                    @if($purchaseExpenses->count()>0)
                                    @foreach($purchaseExpenses as $report)
                                    <?php
                                    $total_amount = 0;
                                    ?>
                                    <tr>
                                        <td>{{$report->category->name ?? ''}}</td>
                                        <td>{{$report->buy_qty ?? ''}}</td>
                                        <td>{{$report->unit ?? ''}}</td>
                                        <td>
                                            <?php
                                            $total_amount = $report->buy_qty * $report->buy_price;
                                            $grand_total = $grand_total + $total_amount;
                                            ?>
                                            {{number_format(round($total_amount ?? 0))}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr style="background-color: aquamarine;color: black;">
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{number_format(round($grand_total))}}</td>
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
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default card-view" style="min-height: 335px">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Expense</h6>
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
                                        <th>Category</th>
                                        <th>Note</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($otherExpenses->count()>0)
                                    @foreach($otherExpenses as $report)
                                    <tr>
                                        <td>{{$report->category->name ?? ''}}</td>
                                        <td>{{$report->note ?? ''}}</td>
                                        <td>{{number_format(round($report->amount ?? 0))}}</td>
                                    </tr>
                                    @endforeach
                                    <tr style="background-color: aquamarine;color: black;">
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{number_format(round($otherExpenses->sum('amount')))}}</td>
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
{{--
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Today's Loan</h6>
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
                                        <th>Loan Provider</th>
                                        <th>Note</th>
                                        <th>Loan Taken</th>
                                        <th>Loan Paid</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($loans->count()>0)
                                    @foreach($loans as $loan)
                                    <tr>
                                        <td>{{$loan->provider->name ?? ''}}</td>
                                        <td>{{$loan->note ?? ''}}</td>
                                        <td>{{number_format($ca = round($loan->credit_amount ?? 0))}}</td>
                                        <td>{{number_format($da = round($loan->debit_amount ?? 0))}}</td>
                                    </tr>
                                    @endforeach
                                    <tr style="background-color: aquamarine;color: black;">
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{number_format($ca = round($loan->sum('credit_amount')))}}</td>
                                        <td>{{number_format($da = round($loan->sum('debit_amount')))}}</td>
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

</div>--}}


@endsection
@push('scripts')

<script>

    $(document).ready(function () {
        highlight_nav('reports', 'daily_report');
    });

</script>
@endpush

