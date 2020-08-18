
$(function() {
  /* ---- SEND CSRF TOKEN WITH AJAX CALL ----*/

    $('#category_div').hide();
    $('#art_category').hide();
    $('#photo_category').hide();
    $('.custom-file').hide()
    $('.submission_validate_count').hide();
    $('.submission_contact_option').hide();
    console.log('js');

  
   $("#artEntryCheckbox").change(function() {
        if($('#artEntryCheckbox').is(':checked')){
                $('#art_value').html('$5.00')
        }else{
            $('#art_value').html('$0.00')
        }
        calculate_total_value();

   })

   $('input[name=inlineRadioOptions]').click(function (){

        if($(this).attr('previousValue') == 'true'){
            $(this).attr('checked', false);
            $('#donation_value').html('$'+'00.00');
        }
        else {
            $('input[name=inlineRadioOptions]').attr('previousValue', false);
            }
        $(this).attr('previousValue', $(this).is(':checked') );

            calculate_total_value();
    });


   $("#photographyEntryCheckbox").change(function() {
        if($('#photographyEntryCheckbox').is(':checked')){
            $('#photography_value').html('$5.00')
        }else{
            $('#photography_value').html('$0.00')
        }
        calculate_total_value();
   
    })


    $('input[type=radio][name=inlineRadioOptions]').change(function() {
        if($(".other_radio").is(":checked") == false){
            $('#other_donation_value').val('')
        }
        if(this.value == "0"){
            $('#other_donation_value').on('input', function() {
                if($('#other_donation_value').val() == ""){
                    $('#donation_value').html('$00.00');
                }else{
                    $('#donation_value').html('$'+$('#other_donation_value').val());
                }
                calculate_total_value();
              });
        }
        $('#donation_value').html(this.value);
        calculate_total_value();
    });


    function calculate_total_value()
    {
      
        var art = parseFloat($('#art_value').html().replace('$',''));
       
        var photography =parseFloat($('#photography_value').html().replace('$',''));
        var donation = parseFloat($('#donation_value').html().replace('$',''));
        var tot = art+photography+donation;
        console.log(tot);
        $('#total_value').html('$'+tot);
    }


    $('#registration_btn').on('click', function(e){
       var contestant_name =  $("#contestantName").val();
       var  contestant_email = $("#emailAddress").val();
       var artEntryCheckbox = $('#art_value').html();
       var photographyEntryCheckbox = $('#photography_value').html();
       var inlineRadioOptions = $('input[type=radio][name=inlineRadioOptions]:checked').val();
       if( (contestant_name && contestant_email) && ($('input[name="category_checkbox"]:checked').length != 0)){

           var input_values = { 
            contestant_name:  contestant_name,
            contestant_email: contestant_email, 
            artEntryCheckbox: artEntryCheckbox,
            photographyEntryCheckbox: photographyEntryCheckbox, 
            inlineRadioOptions: inlineRadioOptions,
            other_value: $('#other_donation_value').val(),
            total_value : $('#total_value').html()
            }
            $("#registration_btn").attr("disabled", true);
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'gift-of-sight/payment',
                data: input_values,
                }).done(function( response ) {
                    var stripe = Stripe(DCI_STRIPE_KEY);
                    console.log(response.session_id);
                    //debugger;
                    if(response.session_id){
                        stripe.redirectToCheckout({
                            sessionId: response.session_id
                          }).then(function (result) {
                           
                          });
                    }
                    $("#registration_btn").attr("disabled", false);
                    if(response.status){
                        //window.location.href = "/successfully/registration";
                    }
                    event.preventDefault()
                   // alert( msg );
                })
                .error(function(err) {
                    if (err && err.responseText) {
                        console.log(err.responseText['errors']);
                        alert("Already Registred By This Name And Email");
                    }
                    console.log('error returned from backend, error', err)
                })
                .always(
                    $("#registration_btn").attr("disabled", false)
                );
       }else(
           alert('Select mandatory Fields')
       )
        



    })


    
    function selected_image(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.select_file_div').css('background', 'transparent url('+e.target.result +') center center no-repeat');
                $('.select_file_div').css('background-size', 'cover');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#customFile").change(function(){
        selected_image(this);
    });


    $(document).ready(function() {
        if ($('.emailAddress').val() && $('.contestantName').val()) {
            checkEmailvalidation($('.contestantName').val(),$('.emailAddress').val());   
        }    
    })
    
    $('.contestantName').focusout(function(){
        if($(this).val() != "" && $('.emailAddress').val() != "" ){
            checkEmailvalidation($(this).val(),$('.emailAddress').val());   
        }
    });
    $('.emailAddress').focusout(function(){
        if($(this).val() != "" && $('.contestantName').val() != "" ){
            checkEmailvalidation($('.contestantName').val(),$(this).val());   
        }
    });

    function array_contains(arr, item) {
        return arr.indexOf(item) !== -1;
    }


    function checkEmailvalidation(name,email){
        $.ajax({
            type: "get",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: EMAIL_CHECK,
            data:{'contestent_email':email,'contestent_name':name}
            }).done(function( response ) {
                $('#category_div').hide();
                $('#art_category').hide();
                $('#photo_category').hide();
                if(response && response.length){
                    $('#category_div').show();
                    document.getElementById('entity_submit_button').style.visibility='visible';
                    $('.submission_contact_option').hide();
                    $.each( response, function( index, value ){
                        console.log("key with keys: "+Object.keys(value));
                                if(Object.keys(value) == 1){
                                    $('#art_category').show();
                                    $('.art_count').html((5 - Object.values(value)));
                                }
                                if(Object.keys(value) == 2){
                                    $('#photo_category').show();
                                    $('.photo_count').html((5 - Object.values(value)));
                                }
                                if(Object.keys(value) == 3){
                                    $('#art_category').show();
                                    $('#photo_category').show();
                                }
                            
                    });
                }else{
                    $('.custom-file').hide()
                    alert('Sorry, we could not find any payment record for this email');
                }
            }).fail( function(xhr, status, error){
                if (error) {
                    console.log('payment check for email failed, error: ', error);
                }
            });
    }

    document.getElementById('customFile').onchange = function () {
      var name = document.getElementById('customFile'); 
        $('.custom-file-label').html(name.files.item(0).name)    
    };

    $('input[type=radio][name=radioOptions]').change(function() {
            $.ajax({
                type: "get",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: EntitySubmission,
                data:{'contestent_email':$('.emailAddress').val(),'category_value':$(this).val(),'contestant_name':$('.contestantName').val()}
                }).done(function( response ) {
                    $('.submission_validate_count').hide();
                    $('.count_option').html(response);
                    var type = ($('input[type=radio][name=radioOptions]:checked').val() == 1) ? "Art Entry" : "Photography Entry";
                    $('.count_entry_type').html(type);
                    if(response == 5){
                        document.getElementById('entity_submit_button').style.visibility='hidden';
                        $('.submission_contact_option').show();
                        $('.custom-file').hide()
                    }else{
                        document.getElementById('entity_submit_button').style.visibility='visible';
                        $('.submission_contact_option').hide();
                        $('.custom-file').show();

                    }

                   console.log(response)
                }).fail( function(xhr, status, error){
                    if (error) {
                        console.log('payment check for email failed, error: ', error);
                    }
                });
    
        
    })


})