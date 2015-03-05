// Try Me Button
$(document).ready(function () {
    $("span.tryME").click(function (e) {

        var tooltipHtml = '<div class=\"tooltip-widget simple-tooltip\">';
        tooltipHtml += '<div class=\"tooltip-widget-top\"></div>';
        tooltipHtml += '<div class=\"tooltip-widget-middle\">';
        tooltipHtml += '<p>Try Me Content</p>';
        tooltipHtml += '</div>';
        tooltipHtml += '<div class=\"tooltip-widget-bottom\"></div>'
        tooltipHtml += '</div>';

        $('body').append(tooltipHtml);

        var tooltipContent = $('.expertise li.demo').attr('tooltip');
        $(".tooltip-widget.simple-tooltip p").html(tooltipContent);

        var demoPosition = $('.expertise li.demo').position();
        demoPosition.left = demoPosition.left - 222;

        var demoHeightOffset = ($(".tooltip-widget.simple-tooltip").height()) / 2;
        demoPosition.top = (demoPosition.top - demoHeightOffset) + 3;

        $(".tooltip-widget.simple-tooltip").show().css({
            'position': 'absolute',
            'left': demoPosition.left,
            'top': demoPosition.top,
            'display': 'inline-block'
        });
    });
});