(function ($) {
    "use strict";

// <!--**************  Smooth Scroll to Section  **************-->
    $(document).on('click', '.navigation a[href*=#]:not([href=#])', function() {
        $('.navigation').addClass('show-mobile-nav');
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 90
                }, 800);
            }
        }
    });
 
    $(document).on('click', '.mobile-nav-btn',function(){
        $('.navigation').toggleClass('show-mobile-nav');
    });
// <!--**************  End Smooth Scroll to Section  **************-->

// <!--**************  Tabs  **************-->   
    $('.tabs_nav').each(function(){ 
        var activeTabTitle = $(this).attr('data-tab-name');
        var activeTab = $(this).find('.active').attr('data-title');
        $('.tabs_content[data-tab-name='+activeTabTitle+']').find('.tab_content[data-title='+activeTab+']').addClass('content_active-tab');
        $(document).on('click','.tabs_nav .tab_btn', function(){
            var tabsTitle = $(this).attr('data-title');
            $(this).addClass('active').siblings().removeClass('active');
            var findTab = $(this).closest('.tabs_nav').attr('data-tab-name');
            $('.tabs_content[data-tab-name='+findTab+']').find('[data-title='+tabsTitle+']').addClass('content_active-tab').siblings('.content_active-tab').removeClass('content_active-tab');
        });
        $(document).on('mouseup',function(e){
            if ($(e.target).closest('.tabs_nav.select').length === 0) {
                $('.select').find('li:not(.active_tab-title)').hide();
                if ($(this).closest('.select').find('li:not(.active_tab-title)').is(':visible')) {
                    $('.select').find('.show_tabs').hide();
                    $('.select').find('.hide_tabs').show();
                } else {
                    $('.select').find('.show_tabs').show();
                    $('.select').find('.hide_tabs').hide();
                }
            }   
        }); 
    });
// <!--**************  END Tabs  **************--> 

// <!--**************  Responsive Video  **************-->
    // Target your .container, .wrapper, .post, etc.
    $('.thing_with_videos').fitVids();
// <!--**************  END Responsive Video  **************-->


// <!--**************  Modal  **************-->
    $(document).on('click', '[data-modal-btn]',function(){
        var ModalBtn = $(this).attr('data-modal-btn');
        $('[data-modal='+ModalBtn+']').css('display' , 'flex');
    });
    $(document).on('mouseup touchend',function(e){
        if ($(e.target).closest('.modal_content').length === 0) {
            $('.modal_container').hide();
        }   
    });
// <!--**************  END Modal  **************-->

// <!--**************  Size  **************-->
    $(document).on('click', '.size',function(){
        $(this).addClass('active').siblings('.size').removeClass('active');
    });
// <!--**************  END Size  **************-->

})(jQuery);

