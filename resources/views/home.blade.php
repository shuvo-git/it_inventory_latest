@extends('layouts.app')

@section('content')
<div class="pt-25">
    <div class="row">
        @if($totalProducts->count()>0)
        {{--
        @foreach($totalProducts as $total)
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim">{{number_format($total->total ?? 0)}}</span></span>
                                        <span class="weight-500 uppercase-font block font-13">Total {{$total->category->name ?? ''}}</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        @if($total->category_id == 1)
                                        <img style="height: 55px;" src="{{asset('img/icon/medicine_icon.png')}}">
                                        @elseif($total->category_id == 2)
                                        <img style="height: 55px;" src="{{asset('img/icon/medicine_acc_icon.png')}}">
                                        @else
                                        <img style="height: 55px;" src="{{asset('img/icon/accessories_icon.webp')}}">
                                        @endif
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="panel panel-default card-view pa-0">
                <div class="panel-wrapper collapse in">
                    <div class="panel-body pa-0">
                        <div class="sm-data-box">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim">{{number_format($totalProducts->sum('total') ?? 0)}}</span></span>
                                        <span class="weight-500 uppercase-font block font-13">Total Buy</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <img style="height: 55px;" src="{{asset('img/icon/total.webp')}}">
                                    </div>
                                </div>	
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection


@push('scripts')
<!-- Morris Charts CSS -->
<link href="{{asset('vendors/bower_components/morris.js/morris.css')}}" rel="stylesheet" type="text/css"/>
<!-- Progressbar Animation JavaScript -->
<script src="{{asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js')}}"></script>

<!-- Sparkline JavaScript -->
<!-- Morris Charts JavaScript -->
<!-- ChartJS JavaScript -->
<script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendors/bower_components/raphael/raphael.min.js')}}"></script>

<script src="{{asset('vendors/bower_components/morris.js/morris.min.js')}}"></script>
<script>

$(document).ready(function () {
highlight_nav('home', 'home');
});
</script>
@endpush