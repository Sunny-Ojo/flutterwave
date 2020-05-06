@extends('layouts.products')
@section('title', '  Payment succesful')
    @section('content')
    <div class="jumbotron col-md-8 text-center mt-4">
        <i class="fa fa-check-circle display-3 text-success"></i>
        <h1>Thank you!!!</h1>
      <h4>  Your payment was successful.</h4>
      <hr>
        <br>
                        <h4 class="text-danger">Billing Details</h4>
                        {{-- please replace the amount with correct amount from the server --}}
                        <p>Total Amount paid: <b>4,000</b></p>
                       {{-- please replace the reference id  with correct ref from the server --}}
                        <p>Transaction reference Id: <b>RCCG</b></p>
                        <a href="/rccgjuniorchurch.org/events.html" class="btn btn-warning">Home</a>
</div>

@endsection
