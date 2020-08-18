@extends('template')
@section('content')
  <div class="successful-register-section">
    <h1>Thank you!</h1>
    <p>
     Your registration is not completed successfully. Please Registration again
    </p>
    <button type="button" class="btn btn-lg btn-primary"> <a class="nav-link"  href="{{URL::to('/')}}"  style="color: white">Registration</a></button>
  </div>
@stop