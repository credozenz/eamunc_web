$('#clock-c').countdown('2022/06/01', function(event) {
    var $this = $(this).html(event.strftime(
        '<span class="counter-text">' +
            '<span class="number">%D <span class="counter-line">Days</span></span>' + '<span class="seperator"> : </span>' +
            '<span class="number">%H <span class="counter-line">Hours</span></span>' + '<span class="seperator"> : </span>' +
            '<span class="number">%M <span class="counter-line">Minutes</span></span>' + '<span class="seperator"> : </span>' +
            '<span class="number">%S <span class="counter-line">Seconds</span></span>' +
        '</span>'
    ));
});

$(document).ready(function() {
    $('#side_opener').click(function() {
        $("#navbar-menu").fadeIn(500)
    });
    $('#side_closer').click(function() {
        $("#navbar-menu").fadeOut(500)
    });
});
