<div class="panel panel-success card-view" style="border:1px solid #2ecd99">
    <div class="panel-body form-wrap">
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <label for="branch_or_division_id" class="control-label mb-10">Supplier : </label>
            {{Form::text('branch_or_division_id',$retVendor->supplier->supplier_name,
            ['class'=>'form-control','required','placeholder'=>'Name'])}}
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label for="delivery_person" class="control-label mb-10">Delivery Person : </label>
            {{Form::text('delivery_person',$retVendor->delivery_person_name,
            ['class'=>'form-control','required','placeholder'=>'Name'])}}
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label for="delivery_person_mobile_no" class="control-label mb-10">Mobile No : </label>
            {{Form::text('delivery_person_mobile_no',$retVendor->delivery_person_phn_no,
            ['class'=>'form-control','required','placeholder'=>'Mobile No'])}}
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
            <label for="remarks" class="control-label mb-10">Remarks : </label>
            {{Form::text('remarks',$retVendor->remarks,['class'=>'form-control','required','placeholder'=>'Remarks'])}}
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 form-group">
            <label for="return_date" class="control-label mb-10">Return Date : </label>
            {{Form::text('return_date',$retVendor->date($retVendor->return_date) ?? request('return_date'),
            ['class'=>'form-control datepicker','placeholder'=>'Return Date','autocomplete'=>"off"])}}
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
                <td width="10%">
                    Product
                </td>
                <td width="10%">
                    Product Unique ID
                </td>
                <td width="10%">
                    Condition
                </td>
                <td width="20%">
                    Remarks
                </td>
            </tr>
            @if(isset($retVendorDetails))
                @foreach ($retVendorDetails as $k=>$retVendorDetail)
                <tr>
                    <td width="10%">
                        {{Form::text('product_id[]',$retVendorDetail->stockin_detail->product->name,
                        ['class'=>'form-control','required','placeholder'=>"Product"])}}
                    </td>
                    <td width="10%">
                        {{Form::text('product_unique_id[]',$retVendorDetail->stockin_detail->unique_id,
                        ['class'=>'form-control','required','placeholder'=>"Product Unique ID"])}}
                    </td>
                    <td width="10%">
                        {{Form::text('conditions[]',$conditionList[$retVendorDetail->condition],
                        ['class'=>'form-control'])}}
                    </td>
                    <td width="20%">
                        {{Form::text('reason[]',$retVendorDetail->remarks,
                        ['class'=>'form-control','required','placeholder'=>"Remarks"])}}
                    </td>
                </tr>
                @endforeach
            @endif
        </table>
    </div>

</div>


<div class="button-list pull-right">
    <a href="{{route('return-from-vendor.index')}}" class="btn btn-primary btn-outline btn-icon left-icon">
        <i class="fa fa-long-arrow-left"></i><span> Back</span> 
    </a>         
</div>
<div class="clearfix"></div>