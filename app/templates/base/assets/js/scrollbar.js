$.fn.scrollify_run = function() {
    this.each(function () {
        /* Init */
        var element = $(this);
        var scontent = '<div class="scroll-container"><div class="scroll-content">' + element.html() + '</div></div><div class="scrollbar-container"><div class="scrollbar"></div></div>';
        element.html(scontent);

        var scroll_container = element.find('.scroll-container');
        var scroll_container_height = element.find('.scroll-container').outerHeight();

        var scroll_content = element.find('.scroll-content');
        var scroll_content_height = scroll_content.outerHeight();

        var scrollbar = element.find('.scrollbar');
        var init_scroll_pos = scroll_content.offset().top;


        var percent = scroll_content_height / element.outerHeight();
        if (percent > 1)
            scrollbar.outerHeight(scroll_container.outerHeight() / percent);
        else
            scrollbar.hide();

        /* Drag Scroll Bar */
        scrollbar.on('mousedown', function(e){

            var dr = $(this).addClass("drag");

            height = dr.outerHeight();
            width = dr.outerWidth();

            max_left = dr.parent().offset().left + dr.parent().width() - dr.width();
            max_top = dr.parent().offset().top + dr.parent().height() - dr.height();
            min_left = dr.parent().offset().left;
            min_top = dr.parent().offset().top;

            ypos = dr.offset().top + height - e.pageY, xpos = dr.offset().left + width - e.pageX;

            $(document.body).on('mousemove', function(e){
                var itop = e.pageY + ypos - height;
                var ileft = e.pageX + xpos - width;

                if(dr.hasClass("drag")){
                    if(itop <= min_top ) { itop = min_top; }
                    if(ileft <= min_left ) { ileft = min_left; }
                    if(itop >= max_top ) { itop = max_top; }
                    if(ileft >= max_left ) { ileft = max_left; }
                    dr.offset({ top: itop,left: ileft});

                    var scroll_deg = (scrollbar.offset().top - element.offset().top) * percent;
                    scroll_container.scrollTop(scroll_deg);
                    $('body').addClass('scroll-grabbed');
                }
            }).on('mouseup', function(e){
                dr.removeClass("drag");
                $('body').removeClass('scroll-grabbed');
            });
        });

        /* Mouse Wheel */
        scroll_container.scroll(function () {
            var top = scroll_container.scrollTop() / percent + element.offset().top;
            scrollbar.offset({ top: top});
        });

        scroll_container.mouseover(function () {
            if (scroll_content.outerHeight() != scroll_content_height) {
                scroll_content_height = scroll_content.outerHeight();
                percent = scroll_content_height / element.outerHeight();
                scrollbar.outerHeight(scroll_container.outerHeight() / percent);
            }
        });

    });
}

$.fn.scrollify = function(action) {
    this.each(function () {
        var element = $(this);
        if (action == 'start')  {
            element.addClass('scroll');
            element.scrollify_run();
            $(window).resize(function(){
                element.removeClass('scroll');
                var content = element.find('.scroll-content').html();
                element.html(content);

                element.addClass('scroll');
                element.scrollify_run();
            });
        } else if (action == 'stop') {
            element.removeClass('scroll');
            var content = element.find('.scroll-content').html();
            element.html(content);
            $(window).unbind();
        }
    });
}