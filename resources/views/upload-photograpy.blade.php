@extends('template')
@section('content')

  <section class="registration-section">
    <div class="container">
      <h2 class="text-center mb-4" style="font-size: 40px;">SUBMIT ENTRIES</h2>
      <form class="registration-form"  method="post" action="{{ route('photography') }}" enctype="multipart/form-data">
        @csrf
        <p class="my-5">
            If you have already made a payment and entered into the contest, enter your email address here to upload
            files.
        </p>
        @if(Session::has('error'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error') }}</p>
        @endif
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        <div class="form-group">
          <label for="name">Name*</label>
          <input type="text" placeholder="Abc" class="form-control contestantName" name="name" required>
        </div>
        <div class="form-group">
          <label for="emailAddress">Email*</label>
          <input type="email" placeholder="abc@example.com" class="form-control emailAddress" id="emailAddress1"
            aria-describedby="emailHelp" name="email" required value="@if(request('email')) {{ request('email') }} @endif">
        </div>
        <div class="my-4" id="category_div">
          <h5>Category*</h5>
          <div id="art_category" class="form-check form-check-inline mr-4" id="art_category" style="display: flex;">
            <input class="form-check-input custom-radio" type="radio" name="radioOptions" 
              value="1" required>
            <label class="form-check-label custom-radio-label" for="inlineRadio1">Art Entry
               <span class="art_spam" style="font-size: 16px;"> – <span class="art_count"> </span> out of 5 uploads left. </span> </label>
            </label>
          </div>
          <div id="photo_category" class="form-check form-check-inline mr-4" id="photo_category" style="display: flex;margin-top: 15px;">
            <input class="form-check-input custom-radio" type="radio" name="radioOptions" 
              value="2" required>
            <label class="form-check-label custom-radio-label" for="inlineRadio2">Photography Entry
               <span class="photo_spam" style="font-size: 16px;"> – <span class="photo_count"> </span> out of 5 uploads left. </span> </label>
            </label>    
          </div>
        </div>

        <div class="custom-file my-4">
          <label class="custom-file-label" for="customFile">Choose Your File(s) (Max 25MB)</label>
          <input type="file" class="custom-file-input" id="customFile" name="custom_file" required>
          <p class="submission_validate_count"> You submitted <span class="count"> </span> of 5 <span class="count_entry_type"></span></p> 

        </div>
        <div class="col" style="background: yellow;border-radius: 10px;">
          <p class="submission_contact_option"> You submitted <span class="count_option"> </span> of 5 <span class="count_entry_type"></span>. Please Contact <a href="mailto:dci@distressedchildren.org">dci@distressedchildren.org</a> For Further Assistance. </p>  
        </div>

        <div class="form-group" id="file_submit_button">

          <button type="submit" class="btn btn-primary btn-lg ml-auto d-block"  id="entity_submit_button" style="width: 200px;margin-top: 10px;">
            Submit
          </button>
        </div>
        <div class="form-group ">
          <div class="select_file_div" style="height:250px;width:400px;; max-width:100%">

          </div>
        </div>
      </form>
     
    </div>
  </section>
@stop