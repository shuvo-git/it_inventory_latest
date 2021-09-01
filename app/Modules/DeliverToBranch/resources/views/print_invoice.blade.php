<table width="100%">
	<thead>
		<tr>
			<td width="60%">
				<h4 class="txt-dark">Order # {{$order->invoice_no}}</h4>
			</td>
			<td>
				<p style="float: right; text-align: right;">Date: {{$order->created_at->format('m-d-Y') ?? ''}}</p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<address class="mb-15">
					<strong>{{$settings->company_name}}</strong><br/>
					Address: {{$settings->address}}<br/>
					Mobile: {{$settings->mobile_no}}<br/>
					Email: {{$settings->email}}
				</address>
			</td>
		</tr>
	</thead>
</table>
<h5>Details: </h5>
<table border="1" cellspacing="0" cellpadding="3" width="100%" border-collapse="collapse">
	<tr>
		<th>Item</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Discount</th>
		<th>Totals</th>
	</tr>
	@foreach($order->details as $od)
	<tr>
		<td>{{$od->product->name ?? ''}}</td>
		<td>{{$od->unit_price ?? ''}}</td>
		<td>{{$od->qty ?? ''}}</td>
		<td>{{$od->discount ?? ''}}</td>
		<td>{{$od->grand_total ?? ''}}</td>
	</tr>
	@endforeach
	<tr class="txt-dark">
		<td colspan="4" align="right"><strong>Total</strong></td>
		<td>{{$order->grand_price ?? ''}}</td>
	</tr>
</table>