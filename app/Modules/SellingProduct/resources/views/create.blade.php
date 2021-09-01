@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Add New Products</h6>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">
                        {{Form::open(['route'=>'selling-product.store','method'=>'post','class'=>'form-horizontal'])}}

                        <div class="form-group">
                            <div class="col-sm-2">
                                {{Form::select('category[]',sellingCategory(),null,['class'=>'form-control select2','required','placeholder'=>"Sell Category"])}}
                            </div>
                            <div class="col-sm-3">
                                {{Form::text('name[]',null,['class'=>'form-control','id'=>'typeahead_0','required',"autocomplete"=>"off",'placeholder'=>"Name"])}}
                            </div>
                            <div class="col-sm-3">
                                {{Form::text('details[]',null,['class'=>'form-control','id'=>'details_0','placeholder'=>'Details'])}}
                            </div>
                            <div class="col-sm-2">
                                {{Form::text('sell_price[]',null,['class'=>'form-control','id'=>'sell_price_0','required','placeholder'=>'Sell Price'])}}
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-success" id="addNew"><i class="fa fa-plus-circle"></i></button>
                            </div>
                        </div>
                        <div class="addNew">

                        </div>

                        <div class="form-group mb-0"> 
                            <div class="col-md-offset-6 col-md-6">
                                <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                            </div>
                        </div>

                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script>

    function getProductDetails(id,value)
    {
        $.ajax({
            method: "POST",
            url: "{{route('selling-product.details')}}",
            data: { name: value },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function( data ) {
            if(data)
            {
                $("#details_"+id).val(data.details);
                $("#sell_price_"+id).val(data.sell_price);
            }
        });
    }

    $('#typeahead_0').bind('typeahead:select', function(ev, suggestion) {
        getDetails(0,suggestion);
    });

    $(document).ready(function () {
        highlight_nav('product_management', 'selling_product');

        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });

    var count=1;

    $("#addNew").click(function () {
        $(".addNew").append(makeHtml());
        $('#typeahead_'+count).typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'sellingProducts',
            limit: 5,
            source: substringMatcher(products)
        });

        $('#typeahead_'+count).bind('typeahead:select', function(ev, suggestion) {
            getDetails(count,suggestion);
        });
    });

    function remove(id) {
        $("#remove_"+id).remove();
    }

    function makeHtml()
    {
        return html= '<div class="form-group" id="remove_'+count+'">'+
        '<div class="col-sm-2">'+
        '{{Form::select('category[]',sellingCategory(),null,['class'=>'form-control select2','required','placeholder'=>'Sell Category'])}}'+
        '</div>'+
        '<div class="col-sm-3">'+
        '<input type="text" name="name[]" class="form-control" id="typeahead_'+count+'" required autocomplete="off" placeholder="Name">'+
        '</div>'+

        '<div class="col-sm-3">'+
        '<input type="text" name="details[]" class="form-control" id="details_'+count+'" placeholder="Details">'+
        '</div>'+
        
        '<div class="col-sm-2">'+
        '<input type="text" name="sell_price[]" class="form-control" id="sell_price_'+count+'" required placeholder="Sell Price">'+
        '</div>'+
        
        '<div class="col-sm-2">'+
        '<button type="button" class="btn btn-danger" onclick="remove('+count+')"><i class="fa fa-minus-circle"></i></button>'+
        '</div>'+
        '</div>';
        count++;
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

    var products = <?= products() ?>;
    $('#typeahead_0').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'products',
        limit: 5,
        source: substringMatcher(products)
    });
</script>
@endpush

