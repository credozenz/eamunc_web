$(document).ready(function() {

    setTimeout(function () {
        $('.alert').fadeOut()
       }, 1500);

var enddate = $('#clock-c').data("date");

$('#clock-c').countdown(enddate, function(event) {
    var $this = $(this).html(event.strftime('' +
        '<span class="counter-text">%D :<span class="counter-line"> Days</span> </span>' +
        '<span class="counter-text">%H :<span class="counter-line"> Hours</span> </span>' +
        '<span class="counter-text">%M :<span class="counter-line"> Minutes</span> </span>' +
        '<span class="counter-text">%S<span class="counter-line">Seconds</span></span>'));
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
        var i=3; 
        $('#add-student').click(function() {
            i++;
var array_no =i-1;



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
                            '<input type="text" name="name" value="" class="form-control" placeholder="Delegate Name" aria-describedby="textHelp" required>'+
                            '<div class="text-danger mt-2"></div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="form-label">Email*</label>'+
                            '<input type="email" name="email" value="" class="form-control" placeholder="Email" aria-describedby="textHelp" required>'+
                            '<div class="text-danger mt-2"></div>'+
                        '</div>'+
                    '</div>'+     
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="form-label">Class & Section*</label>'+
                            '<input type="text" name="class" value="" class="form-control" placeholder="Class & Section" aria-describedby="textHelp" required>'+
                            '<div class="text-danger mt-2"></div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="form-label">WhatsApp Number with country code*</label>'+
                            '<input type="phone" name="whatsapp_no" value="" class="form-control" placeholder="WhatsApp Number with country code" aria-describedby="textHelp" required>'+
                            '<div class="text-danger mt-2"></div>'+
                        '</div>'+
                    '</div>'+     
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="form-label">MUN Experience (if any) *</label>'+
                            '<input type="text" name="mun_experience" value="" class="form-control"  placeholder="MUN Experience (if any)" aria-describedby="textHelp" required>'+
                            '<div class="text-danger mt-2"></div>'+
                        '</div>'+
                   '</div>'+
                    '<div class="col-md-4">'+
                        '<div class="form-group">'+
                            '<label for="form-label">Bureau Member Experience*</label>'+
                            '<input type="text" name="bureaumem_experience" value="" class="form-control" placeholder="Bureau Member Experience" aria-describedby="textHelp" required>'+
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
        
        var email = $(this).val();
        var url = $('#reg-form').data('url');
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

        let _token1   = $('meta[name="csrf-token"]').attr('content');

     

                $.ajax({
                    type: "POST",
                    url: url,
                    dataType:"json",
                    data: {
                        email: email,
                     },
                    _token: _token1,
                    success: function(responce){
        
                        if(responce.status){

                           
                            
                        }else{
                            
                            
                        }

                    },


                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                      
                        
                    }
            
                });
            
           

    });









});
