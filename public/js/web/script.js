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
        $('#add-student').click(function() {
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
                            '<input type="text" name="name[]" value="" maxlength="80" class="form-control" placeholder="Delegate Name" aria-describedby="textHelp" required>'+
                            '<div class="text-danger mt-2"></div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="form-label">Email*</label>'+
                            '<input type="email" name="email[]" value="" maxlength="80" class="form-control user_email" placeholder="Email" aria-describedby="textHelp" required>'+
                            '<div class="text-danger mt-2"></div>'+
                        '</div>'+
                    '</div>'+     
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="form-label">Class & Section*</label>'+
                            '<input type="text" name="class[]" value="" maxlength="80" class="form-control" placeholder="Class & Section" aria-describedby="textHelp" required>'+
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
                                         '<input type="text" name="phone_code[]" value="" maxlength="15" class="form-control phone_code"  placeholder="Code" aria-describedby="textHelp" required>'+
                                    '</div>'+
                                    '<div class="col-md-9">'+
                                        '<input type="phone[]" name="whatsapp_no[]" value="" maxlength="15" class="form-control user_phone"  placeholder="WhatsApp Number" aria-describedby="textHelp" required>'+
                                    '</div>'+
                                '</div>'+
                            '<div class="text-danger mt-2"></div>'+
                        '</div>'+
                    '</div>'+     
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="form-label">MUN Experience (if any) *</label>'+
                            '<input type="text" name="mun_experience[]" value="" maxlength="80" class="form-control"  placeholder="MUN Experience (if any)" aria-describedby="textHelp" required>'+
                            '<div class="text-danger mt-2"></div>'+
                        '</div>'+
                   '</div>'+
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="form-label">Bureau Member Experience*</label>'+
                            '<input type="text" name="bureaumem_experience[]" value="" maxlength="80" class="form-control" placeholder="Bureau Member Experience" aria-describedby="textHelp" required>'+
                            '<div class="text-danger mt-2"></div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
              '</div>';


            $('#dynamic_field').append(html)
    
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




    
   
    
    






});
