<div class="form-wrap">
    <div class="col-md-3 col-sm-12 col-xs-12 form-group">
        <label for="branch_or_division_id" class="control-label mb-10">Division / Branch : <span style="color:red">*</span></label>
        {{Form::select('branch_or_division_id',$branchDivList,null,
        ['id'=>'branch_or_division_id','class'=>'form-control','required'])}}
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
        {{Form::text('return_date',$StockIn->stockInDetails->return_date ?? request('return_date'),
        ['class'=>'form-control datepicker','placeholder'=>'Return Date','autocomplete'=>"off"])}}
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

<div class="button-list pull-right">
    <a href="{{route('returns.index')}}" class="btn btn-primary btn-outline btn-icon left-icon">
        <i class="fa fa-long-arrow-left"></i><span> Back</span> 
    </a>         
</div>
<div class="clearfix"></div>