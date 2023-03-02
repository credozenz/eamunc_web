// $('#clock-c').countdown('2022/06/01', function(event) {
//     var $this = $(this).html(event.strftime(
//         '<span class="counter-text">' +
//             '<span class="number">%D <span class="counter-line">Days</span></span>' + '<span class="seperator"> : </span>' +
//             '<span class="number">%H <span class="counter-line">Hours</span></span>' + '<span class="seperator"> : </span>' +
//             '<span class="number">%M <span class="counter-line">Minutes</span></span>' + '<span class="seperator"> : </span>' +
//             '<span class="number">%S <span class="counter-line">Seconds</span></span>' +
//         '</span>'
//     ));
// });

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





});


$(function() {
    var wtf    = $('.chatscreen');
    if (wtf.length !== 0) {
    var height = wtf[0].scrollHeight;
    wtf.scrollTop(height);
    }
  });