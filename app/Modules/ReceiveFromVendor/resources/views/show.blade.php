<div class="modal fade" id="show_{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="exampleModalLabel1">Sell Details - {{$order->invoice_no}}</h5>
            </div>
            
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sl.</th>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; ?>
                        @foreach($order->details as $detail)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$detail->product->name ?? 'N/A'}}</td>
                            <td>{{$detail->qty ?? 'N/A'}}</td>
                            <td>{{$detail->unit_price ?? 'N/A'}}</td>
                            <td>{{$detail->total_price ?? 'N/A'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

           
        </div>
    </div>
</div>