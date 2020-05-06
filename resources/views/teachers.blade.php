@extends('layouts.products')
@section('title', 'Teachers Payment page')
@section('content')

<div class="col-md-8 col-xs-12 mb-5">
<div class="card">
    <div class="card-header">
        <h3 class="text-center">Teachers</h3>

        <img src="/img/teachers.jpg" alt="" style="width:100%">
     </div>
     <div class="card-body">
        {!! Form::open(['action' => 'PaymentController@teachersPayment', 'method' => 'POST']) !!}
        <div class="form-group">
            {{ Form::label('firstName', '  First Name') }}
            {{ Form::text('firstName', '', ['class' => 'form-control', 'required']) }}
        @error('firstName') <li class="text-danger">{{$message}}</li> @enderror
        </div>
        <div class="form-group">
            {{ Form::label('lastName', '  Last Name') }}
            {{ Form::text('lastName', '', ['class' => 'form-control', 'required']) }}
            @error('lastName') <li class="text-danger">{{$message}}</li> @enderror

        </div>
        <div class="form-group">
            {{ Form::label('email', '  Email Address') }}
            {{ Form::email('email', '', ['class' => 'form-control', 'required']) }}
            @error('email') <li class="text-danger">{{$message}}</li> @enderror

        </div>
         <div class="form-group">
            {{ Form::label('region', 'Region') }}
            {{ Form::select('region', ['Region 1' => 'Region 1' , 'Region 2' => 'Region 2' , 'Region 3' => 'Region 3' ,
            'Region 4 ' => 'Region 4', 'Region 5' => 'Region 5' , 'Region 6' => 'Region 6', 'Region 7' => 'Region 7',
            'Region 8' => 'Region 8', 'Region 9' => 'Region 9' ,  'Region 10' => 'Region 10' , 'Region 11' => 'Region 11' ,
            'Region 12' => 'Region 12', 'Region 13' => 'Region 13' , 'Region 14' => 'Region 14' , 'Region 15' => 'Region 15' ,
            'Region 16' => 'Region 16' , 'Region 17' => 'Region 17' , 'Region 18' => 'Region 18' , 'Region 19' => 'Region 19' ,
            'Region 20' => 'Region 20' , 'Region 21' => 'Region 21' , 'Region 22' => 'Region 22' , 'Region 23' => 'Region 23' ,
            'Region 24' => 'Region 24' , 'Region 25' => 'Region 25' , 'Region 26' => 'Region 26' , 'Region 27' => 'Region 27' ,
            'Region 28' => 'Region 28' , 'Region 29' => 'Region 29' , 'Region 30' => 'Region 30' , 'West Coast' => 'West Coast' ], '', ['class' => 'form-control', 'required']) }}
            @error('region') <li class="text-danger">{{$message}}</li> @enderror
           </div>
           @php

           @endphp
        <div class="form-group">
            {{ Form::label('province', '  Province') }}
            {{ Form::text('province', '', ['class' => 'form-control', 'required']) }}
            @error('province') <li class="text-danger">{{$message}}</li> @enderror

           </div>
        <div class="form-group">
            {{ Form::label('number', '  Phone Number') }}
            {{ Form::text('number', '', ['class' => 'form-control', 'required']) }}
            @error('number') <li class="text-danger">{{$message}}</li> @enderror

        </div>
        <div class="form-group">
            {{ Form::label('number_of_forms', '  Number of forms') }}
            {{ Form::number('number_of_forms', '', ['class' => 'form-control', 'required']) }}
            @error('number_of_forms') <li class="text-danger">{{$message}}</li> @enderror

           </div>
        <div class="form-group">
            {{ Form::label('number_of_teachers', '  Number of Teachers') }}
            {{ Form::number('number_of_teachers', '', ['class' => 'form-control', 'oninput' => 'calculates()', 'required', 'id' => 'number_of_teachers'], ) }}
            @error('number_of_teachers') <li class="text-danger">{{$message}}</li> @enderror

           </div>
           <div class="form-group">
               <h4 class="">Per Teacher is <span class="text-danger">&#8358;500.</span> </h4>

           </div>

        <div class="form-group">
           {{ Form::submit('Pay now', ['class' => 'btn btn-block btn-primary']) }}
       </div>

      {!! Form::close() !!}
</div>
<div class="card-footer text-center"><span>Total Amount: &#8358</span><span class="" id="result"></span></div></div>

</div>
@endsection
