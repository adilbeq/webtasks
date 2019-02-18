jQuery(document).ready(function ($) {
    "use strict";

    $(window).load(function () {
        var $mainNav = $(".top_nav ul.top_nav_menu"), $el, leftPos, newWidth;

        if ($mainNav.length > 0) {
            $mainNav.append("<li id='stm_magic_line'></li>");
            var $magicLine = $("#stm_magic_line");
            var $magicLineWidth = 0;
            var $magicLineLeft = 0;
            if ($mainNav.find(".current_page_item").length || $mainNav.find(".current-menu-parent").length || $mainNav.find(".current-menu-ancestor").length) {
                $magicLineWidth = $(".current_page_item, .current-menu-parent, .current-menu-ancestor").width();
                $magicLineLeft = $(".current_page_item, .current-menu-parent, .current-menu-ancestor").position().left + 26;
            }
            $magicLine.width($magicLineWidth)
                .css("left", $magicLineLeft)
                .data("origLeft", $magicLine.position().left)
                .data("origWidth", $magicLine.width());

            $mainNav.find(' > li').hover(function () {
                $el = $(this);
                leftPos = $el.position().left;
                newWidth = $el.innerWidth();
                $magicLine.stop().animate({
                    left: leftPos,
                    width: newWidth
                }, 200);
            }, function () {
                $magicLine.stop().animate({
                    left: $magicLine.data("origLeft"),
                    width: $magicLine.data("origWidth")
                }, 200);
            });
        }
    });

    $(".top_bar_info_switcher .active").on('click', function () {

        if( $(".top_bar_info_switcher ul").is(':visible') ){
            $(".top_bar_info_switcher ul").slideUp(100);
        }else{
            $(".top_bar_info_switcher ul").slideDown(100);
        }

        return false;
    });

    $(".top_bar_info_switcher a").on('click', function () {
        var id = $(this).attr('href');
        var title = $(this).text();
        $(".top_bar_info").hide();
        $(id).show();
        $(".top_bar_info_switcher .active span").text(title);
        $(".top_bar_info_switcher ul").slideUp(100);
        return false;
    });

    $(".rev_slider_nav").on("click", function () {
        $(this).parents().find(".rev_slider_nav.active").removeClass("active");
        $(this).addClass("active");
        return false;
    });

    $("select").select2({width: '100%', minimumResultsForSearch: '-1'});

    $(".top_nav_wr .top_nav_affix").affix({
        offset: {
            top: $(".top_bar").height()
        }
    });

    $('#menu_toggle').on('click', function () {
        $(this).toggleClass('open');
        $('.top_mobile_menu_wr').toggleClass('active');
        return false;
    });

    $(".top_mobile_menu_wr ul.top_mobile_menu li.menu-item-has-children > a").on('click', function () {
        $(this).closest('li').toggleClass('active');
        $(this).closest('li').find('> ul').slideToggle(300);
        return false;
    });

});