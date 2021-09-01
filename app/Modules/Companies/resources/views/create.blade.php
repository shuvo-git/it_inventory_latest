<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel1">Add New Supplier</h5>
            </div>
            {{Form::open(['route'=>'companies.store','method'=>'post'])}}
            <div class="modal-body">

                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Supplier Name : <span style="color:red">*</span></label>
                    {{Form::text('name',null,['class'=>'form-control','required'])}}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Company Name : </label>
                    {{Form::text('sr_name',null,['class'=>'form-control'])}}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Supplier Mobile No : </label>
                    {{Form::text('sr_mobile_no',null,['class'=>'form-control'])}}
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

