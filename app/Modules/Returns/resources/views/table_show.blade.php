<div class="form-wrap">
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <label for="branch_or_division_id" class="control-label mb-10">Division / Branch : <span style="color:red">*</span></label>
        {{Form::text('branch_or_division_id',null,['class'=>'form-control','required','placeholder'=>'Name'])}}
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
        <label for="return_date" class="control-label mb-10">Return Date : <span style="color:red">*</span></label>
        {{Form::text('return_date',$Return->date($Return->return_date) ?? request('return_date'),
        ['class'=>'form-control datepicker','placeholder'=>'Return Date','autocomplete'=>"off"])}}
    </div>
</div>
{{---------- TABLE ---------------------------------------------------------------------------}}

<table class="table" id="stockin_details_info">
    <tr>
        <td width="10%">
            Product
        </td>
        <td width="15%">
            Product Unique ID
        </td>
        <td width="25%">
            Reason for returning
        </td>
    </tr>
    @if(isset($ReturnDetails))
        @foreach ($ReturnDetails as $ReturnDetail)
        <tr>
            <td width="10%">
                {{Form::text('product_id[]',$ReturnDetail->stock_in_detail->product->name,
                ['class'=>'form-control','required','placeholder'=>"Product"])}}
            </td>
            <td width="15%">
                {{Form::text('product_unique_id[]',$ReturnDetail->stock_in_detail->unique_id,
                ['class'=>'form-control','required','placeholder'=>"Product Unique ID"])}}
            </td>
            <td width="25%">
                {{Form::text('reason[]',$ReturnDetail->reason,
                ['class'=>'form-control','required','placeholder'=>"Reason for returning"])}}
            </td>
        </tr>
        @endforeach
    @endif
</table>