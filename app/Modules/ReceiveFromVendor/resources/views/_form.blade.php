<div class="form-wrap">
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <label for="supplier_id" class="control-label mb-10">Supplier : <span style="color:red">*</span></label>
        {{Form::select('supplier_id',$supplierList,null,
        ['id'=>'sub_group','class'=>'form-control','required'])}}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="delivery_person" class="control-label mb-10">Delivery Person : <span style="color:red">*</span></label>
        {{Form::text('delivery_person',null,['class'=>'form-control','required','placeholder'=>'Name'])}}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="delivery_person_mobile_no" class="control-label mb-10">Mobile No : <span style="color:red">*</span></label>
        {{Form::text('delivery_person_mobile_no',null,['class'=>'form-control','required','placeholder'=>'Mobile No'])}}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <label for="remarks" class="control-label mb-10">Remarks : </label>
        {{Form::text('remarks',null,['class'=>'form-control','required','placeholder'=>'Remarks'])}}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="send_date" class="control-label mb-10">Send Date : <span style="color:red">*</span></label>
        {{Form::text('send_date',$StockIn->stockInDetails->send_date ?? request('send_date'),
        ['class'=>'form-control datepicker','placeholder'=>'Send Date','autocomplete'=>"off"])}}
    </div>
</div>
{{---------- TABLE ---------------------------------------------------------------------------}}

<table class="table" id="stockin_details_info">
    @if(isset($StockInDetails))
        @foreach ($StockInDetails as $StockInDetail)
        <tr>
            {{ Form::hidden('id[]',$StockInDetail->id ) }}
            <th width="2%"><input type="checkbox" /></th>
            <td width="10%">
                {{Form::select('product_id[]',$productList,null,
                ['class'=>'form-control','required','onchange'=>"getProductDetails(event,this.value)"])}}
            </td>
            <td width="10%">
                {{Form::select('product_unique_id[]',$deliveredProductList,null,
                ['class'=>'form-control','required'])}}
            </td>
            <td width="10%">
                {{Form::select('conditions[]',$conditionList,null,
                ['class'=>'form-control','required','onchange'=>"getProductDetails(event,this.value)"])}}
            </td>
            <td width="20%">
                {{Form::text('reason[]',null,
                ['class'=>'form-control','required','placeholder'=>"Reason for returning"])}}
            </td>
        </tr>
        @endforeach
    @else
    <tr>
        <th width="2%"><input type="checkbox" /></th>
        <td width="10%">
            {{Form::select('product_id[]',$productList,null,
            ['class'=>'form-control','required','onchange'=>"getProductDetails(event,this.value)"])}}
        </td>
        <td width="10%">
            {{Form::select('product_unique_id[]',$deliveredProductList,null,
            ['class'=>'form-control','required','onchange'=>"getProductExpiry(event,this.value)"])}}
        </td>
        <td width="10%">
            {{Form::text('expiry_date[]',null,
            ['class'=>'form-control','required','placeholder'=>"Expiry Date"])}}
        </td>
        <td width="20%">
            {{Form::text('problem_desc[]',null,
            ['class'=>'form-control','required','placeholder'=>"Problem Description"])}}
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