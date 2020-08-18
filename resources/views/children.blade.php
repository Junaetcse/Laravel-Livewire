@extends('template')
@section('content')

  <section class="jumbotron jumbotron-fluid hero-section">
    <div class="gift-of-sight-section  ml-auto">
      <h1>Gift of sight</h1>
      <h2>Art and photography competition</h2>
      <h3>August 31,  11:59 PM EDT</h3>
      <p>Online Event</p>
      <a href="#main-registration-form" class="join-btn">Join</a>
    </div>
  </section>

  <section class="about-section text-center">
    <div class="container">
      <h2 class="my-0">about the competition</h2>
      <h3 class="mt-0 mb-4">Support the cause with a chance to win a cash prize</h3>
      <p class="mb-0">
        Distressed Children International’s Youth Volunteer team is organizing an Art & Photo competition. 
        You can join the contest from the comfort of your own computer or digital device. Four qualified judges will choose a winner for the cash prize.
        All proceeds made will be used to help children in need and will directly fund DCI’s Blindness Prevention Program.
        Thanks for entering and good luck!
      </p>
      <p class="mt-0">
        Note:&nbsp;<span style="color: #339966;">All entry are due by 11:59PM on August 31st EDT.</span>
      </p>
    </div>
  </section>

  <section class="entry-showcase" >
    <div class="container">
      <div class="row">
        <div class="col-lg mb-4">
          <div class="card p-2 mx-auto" style="max-width: 30rem;">
            <a href="#main-registration-form"><img src="images/image002.jpg" class="card-img-top" alt="Art-Entry Image"> </a>
            <div class="card-body text-center" style="background-color: #C6DFB6;">
              <h3 style="font-size: 35px;">Art Entry</h3>
              <p style="font-size: 25px; line-height: normal; margin: 0;">Up-to 5 entries</p>
              <p style="font-size: 35px; line-height: normal; margin: 0; font-weight: 500">$5.00</p>
            </div>
          </div>
         
          
        </div>
        <div class="col-lg">
          <div class="card p-2 mx-auto" style="max-width: 30rem;">
            <a href="#main-registration-form"><img src="images/image001.jpg" class="card-img-top" alt="Photography-Entry Image"> </a>
            <div class="card-body text-center" style="background-color: #FED86F;">
              <h3 style="font-size: 35px;">Photography Entry</h3>
              <p style="font-size: 25px; line-height: normal; margin: 0;">Up-to 5 entries</p>
              <p style="font-size: 35px; line-height: normal; margin: 0; font-weight: 500">$5.00</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg mb-4">
          <!-- <p style="margin-left: 30px;"><a href="{{ asset('pdf/competition_guidelines.pdf') }}" target="_blank">Rules for the competition</a></p> -->

        <ol class="guidelines-text">
          <strong style="font-size:1.3rem">Competition Guidelines</strong> 

          <li style="margin-top:10px;">
            1. It must represent something that exists in real life
          </li>
          <li>
            2. It must be something that YOU find beautiful. That’s right, the theme of the pieces are completely up to you.
            Find something that you love to see. It can be a person, place, landscape, animal, absolutely anything. There will be
            two brackets for competition; one for handmade art (paintings, drawings, etc.) and one for photographic entries.
            3. Judging for the competition will be done by Sally Grigas (Drawing and Painting Studio Art Instruction, Nashua
            NH).
          </li>
          <li>
            3. The winner for each bracket will be awarded $25 (This is subject to change. A greater number of participants will
            increase the award value, so tell all your friends about the competition. 5. A certificate under the winner’s name
            signed by Dr. Ehsan Hoque (Founder & Executive Director of DCI) and Dr. Brian DeBroff (President of DCI and
            Professor at Yale University) will also be awarded.
          </li>
          <li>
            4. We are always open to partnering with students, high schools, and community clubs to join a mission of
            common interests.
          </li>
          <li>
            5. For more information, please contact dci@distressedchildren.org and we will get back to you as soon as
            possible.
          </li>
          <li>
            6. All photos submitted to the competition are the property of DCI. By submitting your photo(s) you provide
            consent for DCI to use the photos on its website or in publications for purposes of raising awareness or fundraising
            for underprivileged children according to its discretion.
          </li>
          Please, share this post on your story! You may be the winner, so up your prize!          
        </ol>
        

        </div>
      </div>
 
    </div>
  </section>

  <section class="registration-section">

    
    <div class="container">
      <div class="row mx-lg-n5">
        <div class="col-lg px-lg-5 border-right-lg-only mb-5">
          <div class="col-lg px-lg-5">
          <h1 class="mb-4" style="font-size: 20px;">STEP 1</h1>
            <h2 class="mb-4" style="font-size: 30px;">ENTER THE CONTEST</h2>
            <form class="registration-form" id="main-registration-form">
              <div class="form-group">
                <label for="contestantName">Contestant Name *</label>
                <input type="text" class="form-control" id="contestantName" required>
              </div>
      
              <div class="form-group">
                <label for="emailAddress">Email *</label>
                <input type="email" placeholder="abc@example.com" class="form-control" id="emailAddress"
                  aria-describedby="emailHelp" required>
                <small id="emailHelp" class="form-text text-muted">
                  Email address that you need when you submit your file for the contest.
                </small>
              </div>
              <fieldset id="checkArray">
              <div class="custom-control form-control-lg custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="category_checkbox" id="artEntryCheckbox">
                <label class="custom-control-label" for="artEntryCheckbox" aria-describedby="artEntryHelp">
                  <b>Art Entry</b>
                </label>
                <small id="artEntryHelp" class="form-text text-muted">
                  You can submit at most 5 files
                </small>
              </div>
      
              <hr />
      
              <div class="custom-control form-control-lg custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="photographyEntryCheckbox" name="category_checkbox">
                <label class="custom-control-label" for="photographyEntryCheckbox" aria-descr.edby="photographyEntryHelp">
                 <b> Photography Entry</b>
                </label>
                <small id="photographyEntryHelp" class="form-text text-muted">
                  You can submit at most 5 files
                </small>
              </div>
      
              <hr />
              </fieldset>
              <div class="my-4">
                <h4 class="text-primary">Donation (Optional)</h4>
                <div class="form-check form-check-inline mr-4">
                  <input class="form-check-input custom-radio" type="radio" name="inlineRadioOptions" id="inlineRadiod5"
                    value="$5">
                  <label class="form-check-label custom-radio-label" for="inlineRadiod5">$5</label>
                </div>
                <div class="form-check form-check-inline mr-4">
                  <input class="form-check-input custom-radio" type="radio" name="inlineRadioOptions" id="inlineRadiod10"
                    value="$10">
                  <label class="form-check-label custom-radio-label" for="inlineRadiod10">$10</label>
                </div>
                <div class="form-check form-check-inline mr-4">
                  <input class="form-check-input custom-radio" type="radio" name="inlineRadioOptions" id="inlineRadiod15"
                    value="$15">
                  <label class="form-check-label custom-radio-label" for="inlineRadiod15">$15</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input custom-radio other_radio" type="radio" name="inlineRadioOptions" id="inlineRadiodother"
                    value="0">
                  <label class="form-check-label custom-radio-label" for="inlineRadiodother">
                    Other
                    <input type="number" min="0" step="1" class="form-control-inline" style="max-width: 100px;" id="other_donation_value">
                  </label>
                </div>
                <p class="mt-0">Please add additional donation, every dollar helps</p>
              </div>
      
              <div class="entry-summary bg-light my-5 p-4 rounded">
                <h3>SUMMARY</h3>
                <table class="table">
                  <tbody>
                    <tr>
                      <td>Art Entry</td>
                      <td id="art_value">$00.00</td>
                    </tr>
                    <tr>
                      <td>Photography Entry</td>
                      <td id="photography_value">$00.00</td>
                    </tr>
                    <tr>
                      <td>Donation</td>
                      <td id="donation_value" >$00.00</td>
                    </tr>
                    <tr>
                      <th>TOTAL</th>
                      <td id="total_value">$00.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
      
              <button type="button" class="btn btn-primary btn-lg ml-auto d-block" style="width: 200px;" id="registration_btn">
                Register
              </button>
            </form>
        </div>
      </div>
      <div class="col-lg px-lg-5" id="file_upload_from">
          <div class="container" style=" padding-left: 30px; ">
            <h1 class="mb-4" style="font-size: 20px;">STEP 2</h1>
            <h2 class=" mb-4" style="font-size: 30px;">SUBMIT ENTRIES</h2>
            <form class="registration-form"  method="post" action="{{ route('photography') }}" enctype="multipart/form-data">
              @csrf
              <p>
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
                  aria-describedby="emailHelp" name="email" required>
                <!-- <small id="emailHelp" class="form-text text-muted">
                  the same email address you used to register. If you did not, then please complete your registration
                  first.
                </small> -->
              </div>
              <div class="my-4" id="category_div">
                <h5>Category*</h5>
                <div id="art_category" class="form-check form-check-inline mr-4" style="display: flex;">
                  <input class="form-check-input custom-radio" type="radio" name="radioOptions" id="inlineRadio1" required
                    value="1" style="width: 40px;">
                    <label class="form-check-label custom-radio-label" for="inlineRadio1">Art Entry
                      <span class="art_spam" style="font-size: 16px;"> – <span class="art_count"> </span> out of 5 uploads left. </span> </label>
                   </label>
                </div>
                <div id="photo_category" class="form-check form-check-inline mr-4" style="display: flex;margin-top: 15px;">
                  <input class="form-check-input custom-radio" type="radio" name="radioOptions" id="inlineRadio2" required
                    value="2" style="width: 40px;">
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
              <div class="form-group"  id="file_submit_button">

                <button type="submit" class="btn btn-primary btn-lg ml-auto d-block" id="entity_submit_button" style="width: 200px;margin-top: 10px;">
                  UPLOAD
                </button>
              </div>
              <div class="form-group select_file_div" style="height:250px;width:400px; max-width:100%">        
              </div>
           
            </form>
        </div>
      </div>
    </div>
  </section>
@stop