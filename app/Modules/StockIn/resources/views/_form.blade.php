<div class="form-wrap">
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="invoice_no" class="control-label mb-10">Invoice No : <span style="color:red">*</span></label>
        {{Form::text('invoice_no',null,['class'=>'form-control','required','placeholder'=>'Invoice No.'])}}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="registration_no" class="control-label mb-10">Registration No : <span style="color:red">*</span></label>
        {{Form::text('registration_no',null,['class'=>'form-control','required','placeholder'=>'Registration No.'])}}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <label for="narration" class="control-label mb-10">Narration : </label>
        {{Form::text('narration',null,['class'=>'form-control','required','placeholder'=>'Narration'])}}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="supplier_id" class="control-label mb-10">Supplier : <span style="color:red">*</span></label>
        {{Form::select('supplier_id',$supplierList,null,['id'=>'sub_group','class'=>'form-control','required'])}}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <label for="purchase_date" class="control-label mb-10">Purchase Date : <span style="color:red">*</span></label>
        {{Form::text('purchase_date',$StockIn->stockInDetails->purchase_date ?? request('purchase_date'),
        ['class'=>'form-control datepicker','placeholder'=>'purchase Date','autocomplete'=>"off"])}}
    </div>
</div>
{{---------- TABLE ---------------------------------------------------------------------------}}

<table class="table" id="stockin_details_info">
    @if(isset($StockInDetails))
        @foreach ($StockInDetails as $StockInDetail)
        <tr>
            {{ Form::hidden('id[]',$StockInDetail->id ) }}
            <th width="2%"><input type="checkbox" /></th>
            <td width="12%">
                {{Form::select('product_id[]',$productList,$StockInDetail->product_id,
                ['class'=>'form-control','required','placeholder'=>"Select Product"])}}
            </td>
            <td width="15%">
                {{Form::text('unit_price[]',$StockInDetail->unit_price,
                ['class'=>'form-control','required','placeholder'=>"Unit Price"])}}
            </td>
            <td width="13%">
                {{Form::text('warranty_period[]',$StockInDetail->warranty_period,
                ['class'=>'form-control','required','placeholder'=>"Warranty Period"])}}
            </td>
            <td width="20%">
                {{Form::select('warranty_ymd[]',$ymdList,$StockInDetail->warranty_ymd,
                ['class'=>'form-control','required',"autocomplete"=>"off", 'placeholder'=>"Warranty in (year / month / day)"])}}
            </td>
            <td width="13%">
                {{Form::text('unique_id[]',$StockInDetail->unique_id,
                ['class'=>'form-control','required','placeholder'=>"Unique ID/Tag"])}}
            </td>
        </tr>
        @endforeach
    @else
    <tr>
        <th width="2%"><input type="checkbox" /></th>
        <td width="12%">
            {{Form::select('product_id[]',$productList,null,
            ['class'=>'form-control','required','placeholder'=>"Select Product"])}}
        </td>
        <td width="15%">
            {{Form::text('unit_price[]',null,
            ['class'=>'form-control','required','placeholder'=>"Unit Price"])}}
        </td>
        <td width="13%">
            {{Form::text('warranty_period[]',null,
            ['class'=>'form-control','required','placeholder'=>"Warranty Period"])}}
        </td>
        <td width="20%">
            {{Form::select('warranty_ymd[]',$ymdList,null,
            ['class'=>'form-control','required',"autocomplete"=>"off", 'placeholder'=>"Warranty in (year / month / day)"])}}
        </td>
        <td width="13%">
            {{Form::text('unique_id[]',null,
            ['class'=>'form-control','required','placeholder'=>"Unique ID/Tag"])}}
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