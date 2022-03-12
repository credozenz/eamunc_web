$(document).ready(function() {

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
});
