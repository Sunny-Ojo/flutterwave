@extends('layouts.products')
@section('title', 'Teachers Payment page')
@section('content')

<div class="col-md-12 col-xs-12 mb-5">
<div class="card">
    <div class="card-header text-center">
        <h4>Billing Details</h4>
     </div>
     <div class="card-body">
        <div class="container">
		<table class="row table-bordered p-3">
			<thead class="col-12 ">
				<tr class="row">
					<th class="col-6">Quantity of Forms</th>
					<th class="col-6">Total Amount</th>
				</tr>
			</thead>
			<tbody class="col-12">
				<tr class="row">
					<td class="col-6">{{$forms}}</td>
					<td class="col-6">{{$total}}</td>

				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="card-footer text-center"><a href="/children/payment" class="btn btn-lg btn-info">Pay &#8358; {{$total}}</a></div>

</div>
</div>
@endsection
