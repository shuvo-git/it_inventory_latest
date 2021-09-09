<div class="modal fade" id="edit_{{$product->id}}"  role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel1">Edit Product - {{$product->name}}</h5>
            </div>
            {{Form::model($product,['route'=>['products.update',$product->id],'method'=>'put'])}}
            <div class="modal-body">

                <div class="form-group">
                    <label for="Category" class="control-label mb-10">Category : <span style="color:red">*</span></label>
                    {{Form::select('category',category(),$product->category->id ?? null,['class'=>'form-control select2','required'])}}
                </div>

                <div class="form-group">
                    <label for="Sub Category" class="control-label mb-10">Sub Category : <span style="color:red">*</span></label>
                    {{Form::select('sub_category',subGroup(),$product->subGroup->id ?? null,['class'=>'form-control select2','required'])}}
                </div>
                
                
                
                <div class="form-group">
                    <label for="name" class="control-label mb-10">Name : <span style="color:red">*</span></label>
                    {{Form::text('name',null,['class'=>'form-control','required'])}}
                </div>

                <div class="form-group">
                    <label for="brand" class="control-label mb-10">Brand: <span style="color:red">*</span></label>
                    {{Form::select('brand',brand(),$product->brand->id ?? null,['class'=>'form-control','required'])}}
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