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
                            window.location.reload()
                        }

                    },


                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        swal(err.Message);
                        window.location.reload()
                    }
            
                });
            
            } else {
            swal("Your imaginary file is safe!");
            window.location.reload()
            }
        });

});


    setTimeout(function () {
     $('.alert').fadeOut()
    }, 1500);




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


})