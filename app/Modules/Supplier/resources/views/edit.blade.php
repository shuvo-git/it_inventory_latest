<div class="modal fade" id="edit_{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel1">Edit Supplier - {{$supplier->supplier_name}}</h5>
            </div>
            {{Form::model($supplier,['route'=>['supplier.update',$supplier->id],'method'=>'put'])}}
            <div class="modal-body">

                <div class="form-group">
                    <label for="supplier_name" class="control-label mb-10">Supplier Name : <span style="color:red">*</span></label>
                    {{Form::text('supplier_name',null,['class'=>'form-control','required'])}}
                </div>

                <div class="form-group">
                    <label for="supplier_contact_person" class="control-label mb-10">Supplier Contact Person : 
                        <span style="color:red">*</span></label>
                    {{Form::text('supplier_contact_person',null,['class'=>'form-control','required'])}}
                </div>

                <div class="form-group">
                    <label for="supplier_contact_no" class="control-label mb-10">Supplier Contact No : 
                        <span style="color:red">*</span></label>
                    {{Form::text('supplier_contact_no',null,['class'=>'form-control','required'])}}
                </div>

                <div class="form-group">
                    <label for="supplier_address" class="control-label mb-10">Supplier Address
                        <span style="color:red">*</span></label>
                    {{Form::text('supplier_address',null,['class'=>'form-control','required'])}}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

            {{Form::close()}}
        </div>
    </div>
</div>