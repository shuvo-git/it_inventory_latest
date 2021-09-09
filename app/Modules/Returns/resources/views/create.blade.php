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
                    
                        {{Form::open(['route'=>'returns.store','method'=>'post'])}}
                            @include('Returns::_form')
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
        highlight_nav('product_management', 'products');

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

    function getProductDetails(event,id) {
        $.ajax({
            method: "POST",
            url: "{{ url('get-delivered-stocks') }}",
            data: { product_id: id },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function( data ) {
            if(data) {
                console.log(data);
                $(event.target).parent().next().children(0).html(data)  ;
                //$('#stockin_details_id').empty().append(data);
            }
        });
    }
</script>
@endpush