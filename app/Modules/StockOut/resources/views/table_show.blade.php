<div class="panel panel-success card-view" style="border:1px solid #2ecd99">
    <div class="panel-body form-wrap">
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label for="challan_no" class="control-label mb-10">Challan No : <span style="color:red">*</span></label>
            {{Form::text('challan_no',$StockOut->challan_no,['class'=>'form-control','required'])}}
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <label for="branch_or_division_id" class="control-label mb-10">Branch / Division <span style="color:red">*</span></label>
            {{Form::text('branch_or_division_id',$StockOut->branch->br_name,['class'=>'form-control','required'])}}
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label for="requisition_no" class="control-label mb-10">Requisition No : <span style="color:red">*</span></label>
            {{Form::text('requisition_no',$StockOut->requisition_no,['class'=>'form-control','required'])}}
        </div>

        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label for="delivery_date" class="control-label mb-10">Delivery Date : <span style="color:red">*</span></label>
            {{Form::text('delivery_date',$StockOut->date($StockOut->delivery_date),['class'=>'form-control datepicker',
            'placeholder'=>'Delivery Date','autocomplete'=>"off"])}}
        </div>

        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <label for="narration" class="control-label mb-10">Narration : </label>
            {{Form::text('narration',$StockOut->narration,['class'=>'form-control'])}}
        </div>
    </div>
</div>
{{---------- TABLE ---------------------------------------------------------------------------}}
<div class="panel panel-default border-panel card-view"  style="border:1px solid #2ecd99">
    <div class="panel-heading">
        <div class="pull-left">
            <h6 class="panel-title txt-dark">Details</h6>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <table class="table" id="stockin_details_info">
            <tr>
                <th width="20%">
                    Product
                </th>
                <th width="20%">
                    Unique Product ID
                </th>
            </tr>
            @if(isset($StockOutDetails))
                @foreach ($StockOutDetails as $StockOutDetail)
                <tr>
                    <td width="20%">
                        {{Form::text('product_id[]',$StockOutDetail->stock_in_detail->product->name,
                        ['class'=>'form-control'])}}
                    </td>
                    <td width="20%">
                        {{Form::text('stockin_details_id[]',$StockOutDetail->stock_in_detail->unique_id,
                        ['class'=>'form-control'])}}
                    </td>
                </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>

<div class="button-list pull-right">
    <a href="{{route('stock-out.index')}}" class="btn btn-primary btn-outline btn-icon left-icon">
        <i class="fa fa-long-arrow-left"></i><span> Back</span> 
    </a>         
</div>
<div class="clearfix"></div>