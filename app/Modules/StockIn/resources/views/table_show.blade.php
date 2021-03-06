<div class="panel panel-success card-view" style="border:1px solid #2ecd99">
    <div class="panel-body form-wrap">
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
                <th width="12%">
                    Product
                </th>
                <th width="15%">
                    Unit Price
                </th>
                <th width="13%">
                    Warranty Period
                </th>
                <th width="10%">
                Expiry Date
                </th>
                <th width="13%">
                    Unique ID/Tag
                </th>
                <th width="5%">
                    Status
                </th>
                <th width="5%">
                    Action
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
                    <td width="10%">
                        {{Form::text('warranty_expiry_date[]',$StockInDetail->date($StockInDetail->warranty_expiry_date),
                        ['class'=>'form-control','required','placeholder'=>"Warranty Period"])}}
                    </td>
                    <td width="13%">
                        {{Form::text('unique_id[]',$StockInDetail->unique_id,
                        ['class'=>'form-control','required','placeholder'=>"Unique ID/Tag"])}}
                    </td>
                    <td width="5%">
                        @switch($StockInDetail->status)
                            @case(App\Classes\StockStatus::$IN_STOCK)
                                <span class="label label-success pull-right">in-stock</span>
                                @break
                            @case(App\Classes\StockStatus::$BR_DAMAGED)
                                <span class="label label-success pull-right">damaged</span>
                                @break
                        
                            @default
                                @break
                        @endswitch
                    </td>
                    <td width="5%">
                        <button class="btn btn-outline btn-sm btn-primary" onclick="updateProductStatus('{{$StockInDetail->id}}')">Update Stock Status</button>
                    </td>
                </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>

<div class="button-list pull-right">
    <a href="{{route('stock-in.index')}}" class="btn btn-primary btn-outline btn-icon left-icon">
        <i class="fa fa-long-arrow-left"></i><span> Back</span> 
    </a>         
</div>
<div class="clearfix"></div>