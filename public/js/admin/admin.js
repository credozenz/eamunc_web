$(function(){

    $(document).on('click', '.dltButton', function (e) {
        e.preventDefault();
        
        var url = $(this).data('url');
        var replace_url = $(this).data('replaceurl');

        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

        let _token1   = $('meta[name="csrf-token"]').attr('content');

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {


                $.ajax({
                    type: "POST",
                    url: url, 
                    dataType:"json",
                    data: '',
                    _token: _token1,
                    success: function(responce){
            
                        if(responce.status){

                            swal("Poof! Your file has been deleted!", {
                                icon: "success",
                            });
                            window.location.replace(replace_url);
                        }else{
                            swal("something went wrong please try again !");
                            setTimeout(function(){
                                window.location.reload(1);
                             }, 2500);
                        }

                    },


                    error: function(xhr, status, error) {
                        swal(error);
                        setTimeout(function(){
                            window.location.reload(1);
                         }, 2500);
                    }
            
                });
            
            } else {
            swal("Your imaginary file is safe!");
            setTimeout(function(){
                window.location.reload(1);
             }, 2500);
            }
        });

});




$(document).on('click', '.roleButton', function (e) {
    e.preventDefault();
    
    var url = $(this).data('url');
    var replace_url = $(this).data('replaceurl');
    var data_val = $(this).data('dataval');

    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

    let _token1   = $('meta[name="csrf-token"]').attr('content');

    if(data_val=='3'){

        var alert= "You want to change the user role to Bureau members!";

    } else if(data_val=='2') {
       
        var alert= "You want to change the user role to Delegates!";

    }


    swal({
        title: "Are you sure?",
        text: alert,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })




    .then((willDelete) => {
        if (willDelete) {


            $.ajax({
                type: "POST",
                url: url, 
                dataType:"json",
                data: {status:data_val},
                _token: _token1,
                success: function(responce){
        
                    if(responce.status){

                        swal(responce.message, {
                            icon: "success",
                        });
                        setTimeout(function(){
                            window.location.reload(1);
                         }, 2500);
                    }else{
                        swal(responce.message);
                        setTimeout(function(){
                            window.location.reload(1);
                         }, 2500);
                    }

                },


                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    swal(err.Message);
                    setTimeout(function(){
                        window.location.reload(1);
                     }, 2500);
                }
        
            });
        
        } else {
        
            setTimeout(function(){
                window.location.reload(1);
             }, 2500);
        }
    });

});



    setTimeout(function () {
     $('.alert').fadeOut()
    }, 1500);


    
        ClassicEditor.create( document.querySelector( '#ckeditor' ) )
        .then( editor => {
            editor.ui.view.editable.element.style.height = '500px';
        } )
        .catch( error => {
            console.log(error);
        } );




    $(document).ready(function() {
        var i=1; 
        $('#add').click(function() {
            i++;

 
    var html='<div class="row row'+i+'">'+ 
                '<div class="col-md-4 col-12">'+
                  '<div class="form-group">'+                
                    '<input type="text" name="name[]" value="" class="form-control" placeholder="Name">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-3 col-12">'+
                   '<div class="form-group">'+       
                     '<input type="time" name="time_start[]" value="" class="form-control" placeholder="Start Date">'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-3 col-12">'+
                  '<div class="form-group">'+        
                    '<input type="time" name="time_end[]" value="" class="form-control" placeholder="End Date">'+
                  '</div>'+
                '</div>'+
                '<div class="col-md-2 col-12">'+
                  '<div class="form-group">'+
                     '<button type="button" class="btn btn-primary me-1 mb-1 mt-1 btn_remove" name="remove" id="'+ i +'">-</button>'+
                  '</div>'+
                '</div>'+
              '</div>';


            $('#dynamic_field').append(html)
    
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('.row' + button_id + '').remove();
        });

        $(document).on('click', '.btn_remove_xst', function() {
            var button_id = $(this).attr("key");
            $('.key' + button_id + '').remove();
        });


    });



    $(document).ready(function () {
        $('.select2-multiple').select2({
            placeholder: "Select",
            allowClear: true
        });
    });


    $(document).on('change', '.delegate_member', function() {
        var member_id = $(this).val();
       
       var div = document.getElementById("delegatedtl");


       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        let _token1   = $('meta[name="csrf-token"]').attr('content');



        $.ajax({
            type: "POST",
            url: '/admin/committee_get_delegate', 
            dataType:"json",
            data: {user_id:member_id},
            _token: _token1,
            success: function(responce){
          
                if(responce.status==true){
                
                    var delegate =responce.data;
                    
                   
                      
                    if (delegate.id) 
                    {  

                        document.getElementById("del_name").value = delegate.name;
                        document.getElementById("del_school").value = delegate.school;
                        document.getElementById("del_email").value = delegate.email;
                        document.getElementById("del_class").value = delegate.class;
                        document.getElementById("del_no").value = delegate.whatsapp_no;
                        document.getElementById("del_munexp").value = delegate.mun_experience;
                        document.getElementById("del_buroexp").value = delegate.bureaumem_experience;


                        div.style.display = "block"; 
                          
                    }  
                    else
                    {  
                        div.style.display = "none"; 
                    }  




                }else{
                    div.style.display = "none"; 
                }

            },


            error: function(xhr, status, error) {
                // var err = eval("(" + xhr.responseText + ")");
                // swal(err.Message);
                div.style.display = "none"; 
            }
    
        });









    });














})