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
                    <label for="recipient-name" class="control-label mb-10">Category : <span style="color:red">*</span></label>
                    {{Form::select('category',category(),$product->category->id ?? null,['class'=>'form-control select2','required'])}}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Supplier : <span style="color:red">*</span></label>
                    {{Form::select('company',companies(),$product->company->id ?? null,['class'=>'form-control select2','required'])}}
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Name : <span style="color:red">*</span></label>
                    {{Form::text('name',null,['class'=>'form-control','required'])}}
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">AVAILABLE Quantity: <span style="color:red">*</span></label>
                    {{Form::number('available_qty',null,['class'=>'form-control','required'])}}
                </div>

                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Product Unit: <span style="color:red">*</span></label>
                    {{Form::select('unit',productUnit(),null,['class'=>'form-control','required'])}}
                </div>
                
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Buy Price (Per Unit): <span style="color:red">*</span></label>
                    {{Form::text('buy_price',null,['class'=>'form-control','required'])}}
                </div>
                {{--
                <div class="form-group">
                    <label for="recipient-name" class="control-label mb-10">Short List Quantity: </label>
                    {{Form::number('short_list_qty',null,['class'=>'form-control'])}}
                </div>

                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label mb-10">Sell Price (Per Unit): <span style="color:red">*</span></label>
                            {{Form::text('sell_price',null,['class'=>'form-control','required'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="control-label mb-10">Group: </label>
                        {{Form::text('group',null,['class'=>'form-control'])}}
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="control-label mb-10">Details: </label>
                        {{Form::text('details',null,['class'=>'form-control'])}}
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="control-label mb-10">Exp Date : </label>
                        {{Form::text('exp_date',null,['class'=>'form-control datepicker'])}}
                    </div>
                    --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

                {{Form::close()}}
            </div>
        </div>
    </div>