@extends('template')
@section('content')
  <div class="successful-register-section">
    <h1>Thank you!</h1>
    <p>
      You have successfully entered into the contest.Please use your email address to upload pictures now
    </p>

    <?php 
      $url = URL::to('/gift-of-sight/upload/photography');
      if ($email = request('email')) {
          $url .= '?email=' . urlencode($email);
      }
    
    ?>

    <button type="button" class="btn btn-lg btn-primary"> <a class="nav-link"  href="{{ $url }}"  style="color: white">START UPLOADING</a></button>
  </div>
@stop
