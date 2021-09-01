<div class="modal fade" id="create"  role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel1">New Return</h5>
            </div>
            {{Form::open(['route'=>'return.store','method'=>'post'])}}
            <div class="modal-body">

                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Select Product : <span style="color:red">*</span></label>
                    {{Form::select('product_id',$products,null,['class'=>'form-control select2','placeholder'=>'Select Product','id'=>'product_id','required'])}}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Qty : <span style="color:red">*</span></label>
                    {{Form::number('qty',1,['class'=>'form-control','id'=>'qty','required'])}}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Discount : <span style="color:red">*</span></label>
                    {{Form::number('discount',0,['class'=>'form-control','id'=>'discount','required'])}}
                </div>
              
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Returnable Amount : <span style="color:red">*</span></label>
                    <span id="returnable" style="font-size: 40px;color: red;">0</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            {{Form::close()}}
        </div>
    </div>
</div>

