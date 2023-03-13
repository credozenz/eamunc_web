
jQuery(document).ready(function ($) {
  
  // This is for the auto sliding
  setInterval(function () {
   
      changeSlider();
  }, 6000);
  
  //variables
  var slideCount = $('#slider ul li').length;
  var slideWidth = $('#slider ul li').width();
  var slideHeight = $('#slider ul li').height();
  var sliderUlWidth = slideCount * slideWidth;

  $('#slider').css({ width: slideWidth, height: slideHeight });

  $('#slider ul').css({ width: slideWidth, height: slideHeight });

  $('#slider ul li:last-child').prependTo('#slider ul');





  function changeSlider() {
    $('#slider ul').animate({
        opacity: 0.1
    }, 1000, function () {
        $('#slider ul li:last-child').prependTo('#slider ul');
        $('#slider ul').css('left', '');
        $('#slider ul').css('opacity', 1);
    });
};
  

  function moveLeft() {
      $('#slider ul').animate({
        left: '-=100%',
      }, 200, function () {
          $('#slider ul li:last-child').prependTo('#slider ul');
          $('#slider ul').css('left', '');
          $('#slider ul').css('opacity', 1);
      });
  };

  function moveRight() {
      $('#slider ul').animate({
        left: '+=100%',
      },200, function () {
          $('#slider ul li:first-child').appendTo('#slider ul');
          $('#slider ul').css('left', '');
          $('#slider ul').css('opacity', 1);
      });
  };

  $('.control_prev').click(function () {
      moveLeft();
  });

  $('.control_next').click(function () {
      moveRight();
  });

});



function videoPopup(id) {
    document.getElementById("modal"+id).style.display='none';
    $("#iframe"+id).attr('src','');
    location.reload();
    
  }