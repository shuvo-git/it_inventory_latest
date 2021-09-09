<div class="form-wrap">
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="invoice_no" class="control-label mb-10">Invoice No : </label>
        {{Form::text('invoice_no',$StockIn->invoice_no,['class'=>'form-control','required','placeholder'=>'Invoice No.'])}}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="registration_no" class="control-label mb-10">Registration No : </label>
        {{Form::text('registration_no',$StockIn->registration_no,['class'=>'form-control','required','placeholder'=>'Registration No.'])}}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <label for="narration" class="control-label mb-10">Narration : </label>
        {{Form::text('narration',$StockIn->narration,['class'=>'form-control','required','placeholder'=>'Narration'])}}
    </div>
    <div class="col-md-2 col-sm-12 col-xs-12 form-group">
        <label for="supplier_id" class="control-label mb-10">Supplier : </label>
        {{Form::select('supplier_id',$supplierList,$StockIn->supplier_id,['id'=>'sub_group','class'=>'form-control','required'])}}
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <label for="purchase_date" class="control-label mb-10">Purchase Date : </label>
        {{Form::text('purchase_date',$StockIn->stockInDetails->date($StockIn->stockInDetails->purchase_date) ?? request('purchase_date'),
        ['class'=>'form-control datepicker','placeholder'=>'purchase Date','autocomplete'=>"off"])}}
    </div>
</div>
{{---------- TABLE ---------------------------------------------------------------------------}}

<table class="table" id="stockin_details_info">
    <tr>
        <th width="12%">
            Product
        </th>
        <th width="15%">
            Unit Price
        </th>
        <th width="13%">
            Warranty Period
        </th>
        <th width="20%">
           Expiry Date
        </th>
        <th width="13%">
            Unique ID/Tag
        </th>
    </tr>
    @if(isset($StockInDetails))
        @foreach ($StockInDetails as $StockInDetail)
        <tr>
            <td width="12%">
                {{Form::select('product_id[]',$productList,$StockInDetail->product_id,
                ['class'=>'form-control','required','placeholder'=>"Select Product"])}}
            </td>
            <td width="15%">
                {{Form::text('unit_price[]',$StockInDetail->unit_price,
                ['class'=>'form-control','required','placeholder'=>"Unit Price"])}}
            </td>
            <td width="13%">
                {{Form::text('warranty_period[]',$StockInDetail->warranty_period.' '.$StockInDetail->warranty_ymd,
                ['class'=>'form-control','required','placeholder'=>"Warranty Period"])}}
            </td>
            <td width="20%">
                {{Form::text('warranty_expiry_date[]',$StockInDetail->date($StockInDetail->warranty_expiry_date),
                ['class'=>'form-control','required','placeholder'=>"Warranty Period"])}}
            </td>
            <td width="13%">
                {{Form::text('unique_id[]',$StockInDetail->unique_id,
                ['class'=>'form-control','required','placeholder'=>"Unique ID/Tag"])}}
            </td>
        </tr>
        @endforeach
    @endif
</table>