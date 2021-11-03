@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">{{$pageInfo["title"]}}</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    
                        {{Form::open(['route'=>'return-from-vendor.store','method'=>'post'])}}
                            @include('ReturnFromVendor::_form')
                        {{Form::close()}}
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script>
    

    $(document).ready(function () 
    {
        highlight_nav('stock_management', 'receive_from_vendor');

        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });


    function remove(id) {
        $("#remove_"+id).remove();
    }


    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    function getInVendorProductDetails(event,id) {
        $.ajax({
            method: "POST",
            url: "{{ url('get-in-vendor-product') }}",
            data: { product_id: id , supplier_id: $("#supplier_id").val()},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function( data ) {
            if(data) 
            {
                console.log(data);
                $(event.target).parent().next().children(0).html(data)  ;
                //$('#stockin_details_id').empty().append(data);
            }
        });
    }
</script>
@endpush