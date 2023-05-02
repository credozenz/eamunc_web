
$(document).ready(function(){
    
  
    $(".slideshow").slick({
      autoplay:true,
      autoplaySpeed:5000,
      speed:900,
      slidesToShow:1,
      slidesToScroll:1,
      pauseOnHover:true,
      dots:true,
      pauseOnDotsHover:true,
      cssEase:'linear',
      fade:true,
      draggable:false,
      prevArrow:'<button class="PrevArrow"></button>',
      nextArrow:'<button class="NextArrow"></button>', 
      responsive: [
        {
          breakpoint: 768, // Define breakpoint for devices with screen width of 768px or less
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false // Hide arrows on mobile devices
          }
        }
      ]
    });
    
  })






function videoPopup(id) {
    document.getElementById("modal"+id).style.display='none';
    $("#iframe"+id).attr('src','');
    location.reload();
    
  }