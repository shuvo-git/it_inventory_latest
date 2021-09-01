<div class="modal fade" id="bulk_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel1">Product Bulk Uploads</h5>
            </div>
            {{Form::open(['route'=>'products.bulkUpload','method'=>'post','files'=>true])}}
            <div class="modal-body">

                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Company : <span style="color:red">*</span></label>
                    {{Form::file('file',['class'=>'form-control','required'])}}
                    <a href="{{url("doc/products.csv")}}" class="btn btn-warning">Download Sample</a>
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