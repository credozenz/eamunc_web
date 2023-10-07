

$(document).ready(function() {



    $('#side_opener').click(function() {
        $("#navbar-menu").fadeIn(500)
    });

    $('#side_closer').click(function() {
        $("#navbar-menu").fadeOut(500)
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


tinymce.init({
    selector: '#txt_editor',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
  });
// tinymce.init({
//     selector: '#txt_editor',
//     plugins: [
//       'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
//       'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
//       'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
//     ],
//     toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
//       'alignleft aligncenter alignright alignjustify | ' +
//       'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
//   });


  tinymce.init({
    selector: '#view_editor',
    menubar: false,
    toolbar: false,
    statusbar: false,
    readonly:true
   
  });





});


$(function() {


  reloadPageIfClassExists("get-sendfield", 30000);
  reloadPageIfClassExists("chat-body", 30000);

  function reloadPageIfClassExists(className, delay) {
    setTimeout(function() {
      if (document.querySelector("." + className)) {
        window.location.reload(1);
      }
    }, delay);
  }
  
 


    var wtf    = $('.chatscreen');
    if (wtf.length !== 0) {
    var height = wtf[0].scrollHeight;
    wtf.scrollTop(height);
    }


 
  
    function closePopup(id) {
        alert("dfdf");
        document.getElementById("modal"+id).style.display='none';
        $("#iframe"+id).attr('src','');
        location.reload();
        
      }


     
      $('#file-upload').change(function() {
        var i = $(this).prev('label').clone();
        
        var file = $('#file-upload')[0].files[0].name;
        document.getElementById("msg").value = file;
        $('#msg').attr('readonly', true);
        $("#crs").css("display","");
         });
      
         $('#crs').click(function() {
          document.getElementById("msg").value = "";
          $("#crs").css("display","none");
          $('#msg').attr('readonly',"");
        });





});