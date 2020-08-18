<!doctype html>
<html lang="en">

<head>
  <?php  $force_https = getenv('SERVER_ADDR') != '127.0.0.1'; ?>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link href="{{asset('/css/style.css?v=1.4')}}" rel="stylesheet">
  
 
  <title>Distressed Children & Infants International — Sponsor a child in Bangladesh</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="{{URL::to('/')}}">
        <img src="{{asset('images/dci-Logo.png')}}" class="img-fluid site-logo" alt="DCI-Logo">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <?php 
            $url = URL::to('/gift-of-sight/upload/photography');
            if ($email = request('email')) {
                $url .= '?email=' . urlencode($email);
            }
            $reg_url =  URL::to('/gift-of-sight').'#main-registration-form';

          
          ?>          

          <li class="nav-item active">
            <a class="nav-link" href="{{ $reg_url }}">Register</a>
          </li>


          <li class="nav-item active">
            <a class="nav-link"  href="{{ $url }}">Submit Entries</a>
          </li>


        </ul>
      </div>
    </div>
  </nav>

@yield('content')
@include('footer')
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>

    <script>
        var DCI_STRIPE_KEY = "{{ config('services.stripe.key') }}";
        var EMAIL_CHECK = "{{ route('email_check') }}";
        var EntitySubmission= "{{ route('submission_validity') }}";
    </script>
    <script type="text/javascript" src="{{asset('/js/custom.js?v=1.5')}}"></script>
    <script>
      $('.delete_modal').on('click', function(){
         let file_attr = $(this).attr('data-fime_name');
         $('#file_name_id').val(file_attr);
         $('#image_value').html(file_attr);
      });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
</body>

</html>
