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
                        {{Form::open(['route'=>'products.store','method'=>'post','class'=>'form-horizontal'])}}
                        <table class="table" id="educationInfo" class="educationInfo">
                            <tr>
                                <th width="2%"><input type="checkbox" /></th>
                                <td width="12%">
                                    {{Form::select('category[]',category(),null,['class'=>'form-control','required','placeholder'=>"Select Group",'onchange'=>"getSubGroup(this.value)"])}}
                                </td>
                                <td width="15%">
                                    {{Form::select('sub_group[]',subGroup(),null,['id'=>'sub_group','class'=>'form-control','required','placeholder'=>"Select Sub Group"])}}
                                </td>
                                <td width="13%">
                                    {{Form::select('brand[]',brand(),null,['class'=>'form-control','required','placeholder'=>"Select Brand"])}}
                                </td>
                                <td width="20%">
                                    {{Form::text('name[]',null,['class'=>'form-control','required',"autocomplete"=>"off", 'placeholder'=>"Product Name"])}}
                                </td>
                                <td width="20%">
                                    {{Form::text('depriciation_period[]',null,['class'=>'form-control','id'=>'depriciation_period', "autocomplete"=>"off",'placeholder'=>"Depriciation Period(Years)"])}}
                                </td>
                                <td width="20%">
                                    {{Form::number('depriciation_amount[]',null,['class'=>'form-control','required','placeholder'=>'Depriciation Amount'])}}
                                </td>
                            </tr>
                        </table>
                        <div class="actionBar">
                            <a onclick="tableAddRow('educationInfo')" class="btn pull-right">
                                <button type="button" class="btn btn-success" id="addNew"><i class="fa fa-plus-circle"></i></button>
                            </a>
                            <a onclick="tableDeleteRow('educationInfo')" class="btn pull-right">
                                <button type="button" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
                            </a>
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
    var count=1;

    function getDetails(id,value)
    {
        $.ajax({
            method: "POST",
            url: "{{route('products.details')}}",
            data: { name: value },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function( data ) {
            if(data) {
                $("#buy_qty").val(data.buy_qty);
            }
        });
    }

    $(document).ready(function () {

        highlight_nav('product_management', 'create_product');

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

    function getSubGroup(goupId) {
        $.ajax({
            method: "POST",
            url: "{{route('products.subGroup')}}",
            data: { goupId: goupId },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function( data ) {
            if(data) {
                $("#buy_price_"+id).val(data.buy_price);
                $("#short_list_qty_"+id).val(data.short_list_qty);
            }
        });
    }
</script>
@endpush

