$(document).ready(function() {



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
                                '<select class="form-control" name="country_id[]" required>';
                                for (var j = 0; j < responce.data.length; j++){
                                    html+=' <option value="">Select Country Name</option>'+
                                    '<option value="'+responce.data[j].country_id+'">'+responce.data[j].country_name+'</option>';
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
            
        });



        $('.select2').select2({
            width: 'resolve'
          });

});




