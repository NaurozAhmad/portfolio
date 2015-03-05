/*
 * jQuery Simple Tooltip Plugin
 * Version: 1.0
 *
 * Author: Chris and Nick Rivers
 * http://chrisriversdesign.com
 *
 *
 * Changelog: 
 * Version: 1.0
 *
 */
jQuery.fn.contactpopup = function (options) {

    var settings = { // Defaults
        'formelement': '',
        'transition': 'none'
    };

    return this.each(function () {
        // If options exist, lets merge them
        // with our default settings
        if (options) {
            $.extend(settings, options);
        }

        function centerS(cur) {

            var cur = cur;

            cur.css("position", "absolute");
            cur.css("top", ($(window).height() - cur.height()) / 2 + $(window).scrollTop() + "px");
            cur.css("left", ($(window).width() - cur.width()) / 2 + $(window).scrollLeft() + "px");
            return this;
        }

        $(settings.formelement).hide();
        $(this).click(function () {
            var a = $(document).height();
            var b = $(window).width();
            var popuphtml = '<div id="dvGlobalMask"></div><div id="contactpopup"><div class="modalnav"></div></div>';
            $('body').append(popuphtml);
            $("#dvGlobalMask").css({
                width: b,
                height: a
            });
            $("#dvGlobalMask").fadeTo("fast", 0.4);

            centerS($("#contactpopup"));

            $("#contactpopup").append($(settings.formelement));

            // Logic for transition options
            if (settings.transition == 'fade') { // If Fade
                $("#contactpopup").fadeIn('slow');

            } else if (settings.transition == 'slide') { // If Slide
                var tempHieght = $("#contactpopup").height();

                $("#contactpopup").css({
                    'height': '0%',
                    'display': 'block',
                    'overflow': 'hidden',
                    'min-height': '0'
                }).animate({
                    height: tempHieght // use the height of the object
                });

            } else if (settings.transition == 'grow') { // If Grow
                var tempHieght = $("#contactpopup").height();
                var tempWidth = $("#contactpopup").width();

                $("#contactpopup").css({
                    'height': '0%',
                    'width': '0%',
                    'display': 'block',
                    'overflow': 'hidden',
                    'min-height': '0'
                }).animate({
                    height: tempHieght,
                    // use the height of the object
                    width: tempWidth // use the width of the object
                });

            } else {
                $("#contactpopup").show();
            }

            $('.modalnav').show();
            $(settings.formelement).show();
        });

        $('.modalnav').live('click', function () {
            $('#dvGlobalMask').hide();
            $('#contactpopup').hide();
            $('.modalnav').hide();
            $(settings.formelement).hide();
        });
    });

    return this;
}