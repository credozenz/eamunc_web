$(document).ready(function() {

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


    $(document).on('click', '.dltspeaker', function (e) {
        e.preventDefault();
        
        var url = $(this).data('url');
        var replace_url = $(this).data('replaceurl');

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
                    data: '',
                    _token: _token1,
                    success: function(responce){
            
                        if(responce.status){

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
            
           
    });






    var i = $('#speaker_count').val();
 
        $('#add_speaker').click(function() {
                i++;


                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
            
                let _token1   = $('meta[name="csrf-token"]').attr('content');
            
                var committe_id = $('#committe_id').val();
            
            
                $.ajax({
                    type: "POST",
                    url: "/app/bureau_speaker_country", 
                    dataType:"json",
                    data: {committe_id:committe_id},
                    _token: _token1,
                    success: function(responce){
                
                        if(responce.status){

                    var html='<div class="speaker'+i+' d-flex  align-items-center mb-4">'+
                                '<div class="form-count ">'+i+'</div>'+
                                '<div class=" flex-fill ps-5 pe-5">'+
                                '<label class="form-label"> Country Name</label>'+
                                '<select class="form-control blocspeaker" name="country_id[]" required>'+
                                ' <option value="">Select Country Name</option>';
                                if(responce.data.length){
                                for (var j = 0; j < responce.data.length; j++){
                                    html+='<option value="'+responce.data[j].country_id+'">'+responce.data[j].country_name+'</option>';
                                }
                            }else{
                                    html+='<option value="">No Other students in this Bloc</option>';
                                }
                                html+='</select>'+
                                '</div>'+
                                '<div class="speaker_remove" id="'+ i +'"><i class="fa Example of check-circle fa-minus-circle text-secondary fs-4"></i></div>'+
                            '</div>';


                $('.speaker_list').append(html);

            
                        
                        }else{


                        
                        }
            
                    },
            
            
                    error: function(xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err.Message);
                    
                    }



            });

            $(document).on('click', '.speaker_remove', function() {
                var button_id = $(this).attr("id");
                $('.speaker' + button_id + '').remove();
            });

        


        });
     

        $("body").on("change",".blocspeaker",function(){
       
            $( "#blocspeaker-form" ).submit();
        });
        










        $("body").on("click","#mdlbtn",function(){
                   
            $("#myModal").modal("show");
        
            //appending modal background inside the blue div
            $('.modal-backdrop').appendTo('.blue');   
      
            //remove the padding right and modal-open class from the body tag which bootstrap adds when a modal is shown
            $('body').removeClass("modal-open");
            $('body').css("padding-right","");     
        });


        $("body").on("click",".close",function(){
            $("#myModal").removeClass("show");
            setTimeout(function(){
                window.location.reload(1);
             }, 500);
            
        });


        $('.select2').select2({
            width: 'resolve'
          });




        //   ClassicEditor.create( document.querySelector( '#ckeditor' ) )
        //   .then( editor => {
        //       editor.ui.view.editable.element.style.height = '500px';
        //   } )
        //   .catch( error => {
        //       console.log(error);
        //   } );


          tinymce.init({
            selector: '#txt_editor',
            plugins: [
              'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
              'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
              'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
            ],
            toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
              'alignleft aligncenter alignright alignjustify | ' +
              'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
          });


          tinymce.init({
            selector: '#view_editor',
            menubar: false,
            toolbar: false,
            statusbar: false,
            readonly:true
           
          });
  



        $("#avatar").on('change',function(){
            $( "#avatar_form" ).submit();
        });
        
        
        $("#avatar").on('change',function(){
            $( "#avatar_form" ).submit();
        });
        
        $("#paper_submission").on('change',function(){
            $( "#paper_submit" ).submit();
        });






        $(document).ready(function() {
            var i=1; 
            $('#add').click(function() {
                i++;
    
     
        var html='<div class="row row'+i+'">'+ 
                    '<div class="col-md-4 col-12">'+
                      '<div class="form-group">'+                
                        '<input type="text" name="title[]" value="" class="form-control" placeholder="Title">'+
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
    



       










});




