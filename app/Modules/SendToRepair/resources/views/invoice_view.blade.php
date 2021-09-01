@extends('layouts.app')
@section('content')
<style>
    @media print {
  .printPageButton {
    display: none;
  }
}
</style>
<!-- Row -->
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Order Date: {{$order->created_at->format('m-d-Y') ?? ''}}</h6>
                </div>
                <div class="pull-right">
                    <h6 class="txt-dark">Order # {{$order->invoice_no}}</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="txt-dark head-font inline-block capitalize-font mb-5">Customer Details:</span>
                            <address class="mb-15">
                                <span class="address-head mb-5">{{$order->customer_name ?? 'N/A'}}</span>
                               {{$order->customer_mobile ?? 'N/A'}} <br>
                            </address>
                        </div>
                        <div class="col-xs-6 text-right">
                            <span class="txt-dark head-font inline-block capitalize-font mb-5">Shop Details:</span>
                            <address class="mb-15">
                                <span class="address-head mb-5">Bejoy Medicine Corner</span>
                                East Rampura, TV Road, Dhaka-1219<br>
                                01977800533<br>
                            </address>
                        </div>
                    </div>

                    

                    <div class="seprator-block"></div>

                    <div class="invoice-bill-table">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Discount</th>
                                        <th>Totals</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->details as $od)
                                    <tr>
                                        <td>{{$od->product->name ?? ''}}</td>
                                        <td>{{$od->unit_price ?? ''}}</td>
                                        <td>{{$od->qty ?? ''}}</td>
                                        <td>{{$od->discount ?? ''}}</td>
                                        <td>{{$od->grand_total ?? ''}}</td>
                                    </tr>
                                    @endforeach
                                    <tr class="txt-dark">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>
                                        <td>{{$order->grand_price ?? ''}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="button-list pull-right">
                            <button type="button"  class="btn btn-primary btn-outline btn-icon left-icon printPageButton" onclick="javascript:window.print();"> 
                                <i class="fa fa-print"></i><span> Print</span> 
                            </button>
                            <a href="{{route('sell.create')}}" class="btn btn-success printPageButton">Back To Sell</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Row -->

@endsection
@push('scripts')
<script>

    $(document).ready(function () {
        highlight_nav('reports', 'all_invoice');
    });

</script>
@endpush