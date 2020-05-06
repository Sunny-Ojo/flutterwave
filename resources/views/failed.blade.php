


@extends('layouts.products')
@section('title', '  Payment succesful')
    @section('content')
    <div class="jumbotron col-md-8 text-center mt-4">
        <i class=" fa fa-exclamation-triangle   display-3 text-danger"></i>
        <h1>Sorry,</h1>
      <h4>  Your payment was not successful.</h4>
      <hr>
        <br>
                        <h4 class="text-danger">Nothing was Billed from your account</h4>
                     <p><b>Your transaction was not succesful</b></p>
                        <a href="/rccgjuniorchurch.org/events.html" class="btn btn-warning">Home</a>
</div>

@endsection
