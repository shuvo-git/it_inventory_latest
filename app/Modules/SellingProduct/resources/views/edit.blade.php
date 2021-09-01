<div class="modal fade" id="edit_{{$product->id}}"  role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel1">Edit Product - {{$product->name}}</h5>
            </div>
            {{Form::model($product,['route'=>['selling-product.update',$product->id],'method'=>'put'])}}
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Category : <span style="color:red">*</span></label>
                    {{Form::select('category',sellingCategory(), $product->category->id ?? null,['class'=>'form-control select2','required'])}}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Name : <span style="color:red">*</span></label>
                    {{Form::text('name',null,['class'=>'form-control','required'])}}
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Details: </label>
                    {{Form::text('details',null,['class'=>'form-control'])}}
                </div>
                
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Sell Price (Per piece): <span style="color:red">*</span></label>
                    {{Form::text('sell_price',null,['class'=>'form-control','required'])}}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Status: </label>
                    {{Form::select('status',productStatus(), null,['class'=>'form-control select2','placeholder'=>'Select Status'])}}
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