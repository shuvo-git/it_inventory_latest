@extends('layouts.app')

@section('content')


<div class="row">
    {{Form::open(['route'=>'sell.store','method'=>'post','class'=>'form-horizontal'])}}
    <div class="col-lg-8">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">POS</h6>
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">


                        <div class="form-group">
                            <div class="col-sm-12">
                                {{Form::select('category',sellingCategory(),null,['class'=>'form-control select2','required','placeholder'=>"Select Category", 'id'=>"productCategory", 'onchange'=>"getCategoryProducts(this.value)"])}}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                {{Form::select('product',$products,null,['class'=>'form-control select2','id'=>'productSelection','placeholder'=>"Select Product"])}}
                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Discount</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="addNewProduct">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div class="pull-left">
                    <h6 class="panel-title txt-dark">Invoice</h6>
                </div>

                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="form-wrap">


                        <div class="form-group">
                            <div class="col-sm-6">
                                {{Form::text('customer_name',null,['class'=>'form-control','placeholder'=>"Customer Name"])}}
                            </div>
                            <div class="col-sm-6">
                                {{Form::number('customer_mobile_no',null,['class'=>'form-control','placeholder'=>'Customer Mobile No'])}}
                            </div>
                        </div>
                        <div class="form-group">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="text-right font-18">Total Price</td>
                                    <td class="text-right" style="width: 50%;"><span style="font-size: 24px" id="totalPrice">0</span></td>
                                </tr>
                                <tr>
                                    <td class="text-right font-18">Discount</td>
                                    <td class="text-right" style="width: 50%;"><span style="font-size: 24px" id="totalDiscount">0</span></td>
                                </tr>
                                <tr>
                                    <th class="text-right font-18">Grand Total</th>
                                    <th class="text-right" style="width: 50%;"><span style="font-size: 24px" id="grandTotal">0</span></th>
                                </tr>
                            </table>
                        </div>

                        <input type="hidden" name="save_and_print" id="save_and_print_value" value="0">
                        <div class="form-group mb-0"> 
                            <div class="mr-10" style="float: right">
                                <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">Save</span></button>
                                <button type="submit" id="save_and_print" class="btn btn-primary btn-anim"><i class="icon-printer"></i><span class="btn-text">Save & Print</span></button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    {{Form::close()}}
</div>

@endsection
@push('scripts')

<script>

    var products = [];
    var count = 0;
    $("#save_and_print").click(function(e){
        $("#save_and_print_value").val(1);
    });

    function getCategoryProducts(category_id){
        $.ajax({
            method: "POST",
            url: "{{route('sell.category-products')}}",
            data: {category_id: category_id},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function (data) {
            // var obj = JSON.parse(data);
            // console.log(obj);
            // $('#productSelection').html('').select2({data: [{id: '', text: ''}]});
            // $('#productSelection').select2('data', null);
            $('#productSelection').empty().trigger("change");
            // $('#productSelection').select2({data:obj});
            // var obj = jQuery.parseJSON(data);

            // console.log(obj);
            $.each(data, function(key,value) {
                if(key == 0)
                    $("#productSelection").append(new Option('Select Product', '', true, true));

                $("#productSelection").append(new Option(value.product, value.id, false, false));
            });
        });
    }

    $("#productSelection").change(function () {
        var id = $("#productSelection").val();
        if (id == '' || id == undefined)
        {
            return false;
        }

        if (typeof products[id] !== 'undefined') {
            alert('Product Already Selected');
            $("#productSelection").val('').trigger('change');
            return;
        }

        $.ajax({
            method: "POST",
            url: "{{route('sell.product-details')}}",
            data: {id: id},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        })
        .done(function (data) {
            data.discount = 0;

            console.log(data);

            products[data.id] = data;
            console.log(products);
            var html = '<tr id="remove_' + count + '">' +
            '<td><span>' + data.name + '</span><input type="hidden" id="product_id_' + count + '" name="product_id[]" value="' + data.id + '"></td>' +
            '<td><span>' + data.sell_price + '</span> <input type="hidden" name="sell_price[]" id="sell_price_' + count + '" value="' + data.sell_price + '"></td>' +
            '<td><input style="width: 100px" type="number" id="product_qty_' + count + '" onkeyup="qtyChange(' + count + ')" onchange="qtyChange(' + count + ')" class="form-control" name="qty[]" value="1"></td>' +
            '<td><input style="width: 100px" type="text" id="product_discount_' + count + '" onkeyup="setDiscount(' + count + ')" class="form-control" name="discount[]" value="0"></td>' +
            '<td><span id="product_total_' + count + '">' + data.sell_price + '</span></td>' +
            '<td><button type="button" onclick="remove(' + count + ')" class="btn btn-danger"><i class="fa fa-minus"></i></button></td>' +
            '</tr>';
            $("#addNewProduct").append(html);
            $("#productSelection").val('').trigger('change');
            qtyChange(count);
            count++;
        });
    });

    function qtyChange(id)
    {
        var productId = $("#product_id_" + id).val();
        var qty = $("#product_qty_" + id).val();
        if (qty == '')
        {
            qty = 0;
        }
        if(products[productId].available_qty < qty)
        {
            alert("Maximum available qty is "+products[productId].available_qty);
            $qty = products[productId].available_qty;
            $("#product_qty_" + id).val($qty);
        }
        
        products[productId].qty = parseInt(qty);
        updateInvoice(id, productId, 'add');
    }
    function setDiscount(id)
    {
        var productId = $("#product_id_" + id).val();
        var discount = $("#product_discount_" + id).val();
        if (discount == '')
        {
            discount = 0;
        }
        if(products[productId].qty * products[productId].sell_price <= parseFloat(discount))
        {
            alert("Discount may not greater the total price");
            $("#product_discount_" + id).val(0);
            discount = 0;
        }
        products[productId].discount = parseFloat(discount);
        updateInvoice(id, productId, 'add');
    }
    function remove(id)
    {
        var productId = $("#product_id_" + id).val();
        delete products[productId];
        $("#remove_" + id).remove();
        updateInvoice(id, productId, 'remove');
    }

    function updateInvoice(id, productId, type)
    {
        //console.log(id, productId, type);
        var totalPrice = 0;
        var totalDiscount = 0;
        var grandTotal = 0;
        $.each(products, function (key, value) {
            if (typeof value !== 'undefined')
            {
                totalPrice += value.qty * value.sell_price;
                totalDiscount += value.discount;
            }
        });

        grandTotal += totalPrice - totalDiscount;
        $("#totalPrice").html(totalPrice.toFixed(2));
        $("#totalDiscount").html(totalDiscount.toFixed(2));
        $("#grandTotal").html(grandTotal.toFixed(2));

        if (type == 'add')
        {
            var pTotal = products[productId].qty * products[productId].sell_price - products[productId].discount;
            $("#product_total_" + id).html(pTotal);
        }

    }
    $(document).ready(function () {
        highlight_nav('sell_management', 'sell');

        $(window).keydown(function (event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
    });
</script>
@endpush

