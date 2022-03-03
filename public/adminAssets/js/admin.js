$(document).on('click', '.dltButton', function (e) {
        e.preventDefault();
        
        var url = $(this).data('url');

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

                        }else{
                            swal("something went wrong please try again !");
                        }

                    },


                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        swal(err.Message);
                        
                    }
            
                });
            
            } else {
            swal("Your imaginary file is safe!");
            }
        });



});