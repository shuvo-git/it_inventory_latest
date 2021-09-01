<div class="modal fade" id="create"  role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel1">Add New Work</h5>
            </div>
            {{Form::open(['route'=>'computerWork.store','method'=>'post'])}}
            <div class="modal-body">

                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Total Amount : <span style="color:red">*</span></label>
                    {{Form::number('total_amount',null,['class'=>'form-control','required'])}}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Cost : <span style="color:red">*</span></label>
                    {{Form::number('cost',null,['class'=>'form-control','required'])}}
                </div>
              
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Note : <span style="color:red">*</span></label>
                    {{Form::textarea('note',null,['class'=>'form-control'])}}
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

