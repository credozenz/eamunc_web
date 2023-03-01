$(document).ready(function() {

            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:15,
                dots: true,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true
                    },
                    600:{
                        items:3,
                        nav:false
                    },
                    1000:{
                        items:3,
                        nav:true,
                        loop:false
                    }
                }
            })
     
   
        $('#side_opener').click(function() {
            $("#navbar-menu").fadeIn(500)
        });
        $('#side_closer').click(function() {
            $("#navbar-menu").fadeOut(500)
        });
    




    setTimeout(function () {
        $('.alert').fadeOut()
       }, 1500);

    var enddate = $('#clock-c').data("date");


    $('#clock-c').countdown(enddate, function(event) {
        var $this = $(this).html(event.strftime(
            '<span class="counter-text">' +
                '<span class="number">%D <span class="counter-line">Days</span></span>' + '<span class="seperator"> : </span>' +
                '<span class="number">%H <span class="counter-line">Hours</span></span>' + '<span class="seperator"> : </span>' +
                '<span class="number">%M <span class="counter-line">Minutes</span></span>' + '<span class="seperator"> : </span>' +
                '<span class="number">%S <span class="counter-line">Seconds</span></span>' +
            '</span>'
        ));
    });

   

});



$(document).ready(function () {
    $('.select2').select2({
        placeholder: "Select",
        allowClear: true,
        
    });
});


$(document).ready(function() {

    $('#side_opener').click(function() {
        $("#navbar-menu").fadeIn(500)
    });

    $('#side_closer').click(function() {
        $("#navbar-menu").fadeOut(500)
    });


    $(document).ready(function() {


        var i=1; 

        var committees = ''; 
        var countries  = '';   

       
        $('#add-student').click(function() {


            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
            
            let _token1   = $('meta[name="csrf-token"]').attr('content');
            
            $.ajax({
                type: "POST",
                url: './committees_and_country',
                dataType:"json",
                data: {
                },
                _token: _token1,
                success: function(responce){
            
                    if(responce.status==true){
                      
                      var committees = responce.committees.data; 
                      var countries = responce.countries;   
                      


                        i++;
                    // var array_no =i-1;

                    var html='<div class="form-section mb-5 student'+i+'">'+
                                '<h4 class="color-darkblue mb-5">Student '+i+'</h4>'+
                            '<div class="col-sm-12 col-12 d-flex justify-content-center justify-content-sm-end">'+
                                '<div class="form-group">'+
                                '<button type="button" class="btn btn-danger me-1 mb-1 mt-1 btn_remove" name="remove" id="'+ i +'">X</button>'+
                                '</div>'+
                            '</div>'+

                            '<div class="row">'+
                            '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<label for="form-label">Delegate Name*</label>'+
                                        '<input type="text" name="name['+i+']" value="" maxlength="80" class="form-control" placeholder="Delegate Name" aria-describedby="textHelp" required>'+
                                        '<div class="text-danger mt-2"></div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<label for="form-label">Email*</label>'+
                                        '<input type="email" name="email['+i+']" value="" maxlength="80" class="form-control user_email" placeholder="Email" aria-describedby="textHelp" required>'+
                                        '<div class="text-danger mt-2"></div>'+
                                    '</div>'+
                                '</div>'+     
                                '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<label for="form-label">Class & Section*</label>'+
                                        '<input type="text" name="class['+i+']" value="" maxlength="80" class="form-control" placeholder="Class & Section" aria-describedby="textHelp" required>'+
                                        '<div class="text-danger mt-2"></div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<label for="form-label">WhatsApp Number with country code*</label>'+
                                            '<div class="row">'+
                                            '<div class="col-md-3">'+
                                                    '<input type="text" name="phone_code[]" value="" maxlength="15" class="form-control phone_code"  placeholder="Code" aria-describedby="textHelp">'+
                                                '</div>'+
                                                '<div class="col-md-9">'+
                                                    '<input type="phone['+i+']" name="whatsapp_no[]" value="" maxlength="15" class="form-control user_phone"  placeholder="WhatsApp Number" aria-describedby="textHelp">'+
                                                '</div>'+
                                            '</div>'+
                                        '<div class="text-danger mt-2"></div>'+
                                    '</div>'+
                                '</div>'+    


                                '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<label for="">Committee of Choice*</label>'+
                                            '<select name="committee_choice['+i+']" class="form-control placeholder="Committee of Choice" required>'+
                                                '<option value=""> Select Committee of Choice </option>';
                                                        if(committees.length){
                                                            for (var j = 0; j < committees.length; j++){
                                                                html+='<option value="'+committees[j].id+'">'+committees[j].title+'</option>';
                                                            }
                                                        }else{
                                                                html+='<option value="">empty committees !</option>';
                                                        }
                                    html+='</select>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<label for="form-label">Country of Choice*</label>'+
                                            '<select name="country_choice['+i+']"  class="form-control" placeholder="Country of Choice" required>'+
                                                '<option value=""> Select Country of Choice </option>';
                                                    if(countries.length){
                                                        for (var j = 0; j < countries.length; j++){
                                                            html+='<option value="'+countries[j].id+'">'+countries[j].name+'</option>';
                                                        }
                                                    }else{
                                                            html+='<option value="">empty countries !</option>';
                                                    }
                                    html+='</select>'+
                                    '</div>'+
                                '</div>'+
                                
                                
                                '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<label for="form-label">MUN Experience (if any)</label>'+
                                        '<input type="text" name="mun_experience['+i+']" value="" maxlength="80" class="form-control"  placeholder="MUN Experience (if any)" aria-describedby="textHelp">'+
                                        '<div class="text-danger mt-2"></div>'+
                                    '</div>'+
                            '</div>'+
                                '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<label for="form-label">Bureau Member Experience</label>'+
                                        '<input type="text" name="bureaumem_experience['+i+']" value="" maxlength="80" class="form-control" placeholder="Bureau Member Experience" aria-describedby="textHelp">'+
                                        '<div class="text-danger mt-2"></div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-4">'+
                                '<div class="form-group">'+
                                    '<label for="form-label">Awards Received</label>'+
                                    '<input type="text" name="awards_received['+i+']" value="" maxlength="80" class="form-control" placeholder="Awards Received" aria-describedby="textHelp">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>';


                        $('#dynamic_field').append(html);




                       }
            
            
                   }

         });

    
});




        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('.student' + button_id + '').remove();
        });


    });


    $(document).on('change', '.user_email', function (e) {
        e.preventDefault();

        var input = $(this);
        var email = input.val();
            input.closest('div').find('.email-valid').remove();
        var i = 0;

            $(".user_email").each(function() {
                if($(this).val() == email){
                    i++;
                }
            });

        if(i<=1){

                    $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                    let _token1   = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: "POST",
                        url: './validate_user_email',
                        dataType:"json",
                        data: {
                            email: email,  
                        },
                        _token: _token1,
                        success: function(responce){
        console.log(responce);
                            if(responce.status==false){
                                input.val("");
                                input.after("<div class='text-danger mt-2 email-valid'> This email address is already in use </div>");  
                                
                            }

                        },

                        error: function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            console.log(err);      
                        }
                
                    });

        }else{

            input.val("");
            input.after("<div class='text-danger mt-2 email-valid'> This email address is already use in this form </div>");  
            
        }
          

    });


    $(document).on('change', '.user_phone', function (e) {
        e.preventDefault();
    
        var input = $(this);
            input.closest('div').find('.phone-valid').remove();
        var phone = input.val();


        var i = 0;

        $(".user_phone").each(function() {
            if($(this).val() == phone){
                i++;
            }
        });

        if(i<=1){


            var phoneno = /^\d+$/;
            if(phone.match(phoneno))
            { 

            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

            let _token2   = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: "POST",
                        url: './validate_user_phone',
                        dataType:"json",
                        data: {
                            phone: phone,
                            
                        },
                        _token: _token2,
                        success: function(responce){
        
                            if(responce.status==false){
                                input.val(""); 
                                input.closest('div').find('.phone-valid').remove();
                                input.after("<div class='text-danger mt-2 phone-valid'> This Phone number is already in use </div>");  
                                
                            }

                        },

                        error: function(xhr, status, error) {
                            var err = eval("(" + xhr.responseText + ")");
                            console.log(err);      
                        }
                
                    });


                }
                else
                {
                    input.val(""); 
                    input.closest('div').find('.phone-valid').remove();
                    input.after("<div class='text-danger mt-2 phone-valid'> Not a valid Phone Number </div>");  
                    
                }
        }else{

            input.val("");
            input.after("<div class='text-danger mt-2 phone-valid'> This Phone Number is already use in this form </div>");  
            
        }      

    });


    $(document).on('change', '.img_valid', function (e) {
        e.preventDefault();
    
        var input = $(this);
            input.closest('div').find('.img_valid_err').remove();
        var fsize = input[0].files[0].size;
        var ftype = input[0].files[0].type;
        if(ftype == "image/jpeg" || ftype == "image/png" || ftype == "image/svg"){
      
            var file = Math.round((fsize / 1024));
                // The size of the file.
                if (file >= 10240) {
                    input.val("");  
                    input.after("<div class='text-danger mt-2 img_valid_err'> File too Big, please select a file less than 10MB </div>");  
                } else if (file < 20) {
                    input.val("");  
                    input.after("<div class='text-danger mt-2 img_valid_err'> File too small, please select a file greater than 20 KB </div>");  
                }
        }else{
            input.val(""); 
            input.after("<div class='text-danger mt-2 img_valid_err'> Upload jpeg/png/svg Images only </div>");  
        }

    });




    
   
    
    jQuery("#isg-regForm").validate({
        rules: {
            'name': {
                required: true
            },
            'email': {
                required: true
            },
            'class': {
                required: true
            },
            'committee_choice': {
                required: true
            },
            'country_choice': {
                required: true
            }
        },
    });


    jQuery("#school-regForm").validate({
        rules: {
            'school_name': {
                required: true
            },
            'school_logo': {
                required: true
            },
            'advisor_name': {
                required: true
            },
            'advisor_email': {
                required: true
            },
            'mob_code': {
                required: true
            },
            'name[]': {
                required: true
            },
            'email[]': {
                required: true
            },
            'class[]': {
                required: true
            },
            'committee_choice[]': {
                required: true
            },
            'country_choice[]': {
                required: true
            }
        },
        
    });

 




   

});
























