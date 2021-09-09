<div class="form-wrap">
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="challan_no" class="control-label mb-10">Challan No : <span style="color:red">*</span></label>
        {{Form::text('challan_no',null,['class'=>'form-control','required'])}}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <label for="branch_or_division_id" class="control-label mb-10">Branch / Division <span style="color:red">*</span></label>
        {{Form::select('branch_or_division_id',$branchDivList,null,['id'=>'sub_group','class'=>'form-control','required'])}}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="requisition_no" class="control-label mb-10">Requisition No : <span style="color:red">*</span></label>
        {{Form::text('requisition_no',null,['class'=>'form-control','required'])}}
    </div>

    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="delivery_date" class="control-label mb-10">Delivery Date : <span style="color:red">*</span></label>
        {{Form::text('delivery_date',request('delivery_date'),['class'=>'form-control datepicker',
        'placeholder'=>'Delivery Date','autocomplete'=>"off"])}}
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <label for="narration" class="control-label mb-10">Narration : </label>
        {{Form::text('narration',null,['class'=>'form-control'])}}
    </div>
</div>
{{---------- TABLE ---------------------------------------------------------------------------}}

<table class="table" id="stockin_details_info">
    @if(isset($StockOutDetails))
        @foreach ($StockOutDetails as $StockOutDetail)
        <tr>
            {{ Form::hidden('id[]',$StockInDetail->id ) }}
            <th width="2%"><input type="checkbox" /></th>
            <td width="20%">
                {{Form::select('product_id[]',$productList,$StockInDetail->product_id,
                ['class'=>'form-control','required','onchange'=>"getProductDetails(event,this.value)"])}}
            </td>
            <td width="20%">
                {{Form::select('stockin_details_id[]',null,null,
                ['id'=>'stockin_details_id','class'=>'form-control','required'])}}
            </td>
            
        </tr>
        @endforeach
    @else
    <tr>
        <th width="2%"><input type="checkbox" /></th>
        <td width="20%">
            {{Form::select('product_id[]',$productList,null,
            ['class'=>'form-control','required','onchange'=>"getProductDetails(event,this.value)"])}}
        </td>
        <td width="20%">
            {{Form::select('stockin_details_id[]',$stockInDetailsList,null,
            ['id'=>'stockin_details_id','class'=>'form-control','required'])}}
        </td>
    </tr>
    @endif
</table>
<div class="actionBar">
<a onclick="tableAddRow('stockin_details_info')" class="btn pull-right">
    <button type="button" class="btn btn-success" id="addNew"><i class="fa fa-plus-circle"></i></button>
</a>
<a onclick="tableDeleteRow('stockin_details_info')" class="btn pull-right">
    <button type="button" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button>
</a>
</div>

<div class="form-group mb-0"> 
<div class="col-md-offset-6 col-md-6">
    <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
</div>
</div>