<div class="modal fade" id="show_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel1">Product Details - {{$product->name}}</h5>
            </div>
            
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td>Name</td>
                        <td>{{$product->name?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Company Name</td>
                        <td>{{$product->company->name?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Buy Quantity</td>
                        <td>{{$product->buy_qty ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Used Quantity</td>
                        <td>{{$product->sell_qty ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Available Quantity</td>
                        <td>{{$product->available_qty ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Buy Price</td>
                        <td>{{$product->buy_price ?? ''}}(Per Unit)</td>
                    </tr>
                    {{--<tr>
                        <td>Short List Quantity</td>
                        <td>{{$product->short_list_qty ?? ''}}</td>
                    </tr>
                    
                        <tr>
                            <td>Sell Price</td>
                            <td>{{$product->sell_price ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Group</td>
                            <td>{{$product->group ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Details</td>
                            <td>{{$product->details ?? ''}}</td>
                        </tr>
                        <tr>
                            <td>Exp Date</td>
                            <td>{{$product->exp_date ?? ''}}</td>
                        </tr>
                    --}}
                    <tr>
                        <td>Created At</td>
                        <td>{{$product->created_at ?? ''}}</td>
                    </tr>
                    <tr>
                        <td>Last Updated At</td>
                        <td>{{$product->updated_at ?? ''}}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

           
        </div>
    </div>
</div>