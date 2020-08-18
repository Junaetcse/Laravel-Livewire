<div>
    <div class="col-lg px-lg-5 border-right-lg-only mb-5">
        <div class="col-lg px-lg-5">
        <h1 class="mb-4" style="font-size: 20px;">STEP 1</h1>
          <h2 class="mb-4" style="font-size: 30px;">ENTER THE CONTEST</h2>
          <form class="registration-form" id="main-registration-form">
            <div class="form-group">
                {{ $name }}
              <label for="contestantName">Contestant Name *</label>
              <input type="text" wire:model="name" class="form-control" id="contestantName" required>
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
</div>
