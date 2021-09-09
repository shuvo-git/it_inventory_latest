<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel1">Create New {{$pageInfo["title"]}}</h5>
            </div>
            {{Form::open(['route'=>'supplier.store','method'=>'post'])}}
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            {{Form::close()}}
        </div>
    </div>
</div>

