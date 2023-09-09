$.fn.scroller_core = function () {
    this.each(function () {
        var scroll_element = $(this);
        var scroll_content = '<div class="scroll-container"><div class="scroll-content">' + $(this).html() + '</div></div><div class="scrollbar-container"><div class="scrollbar"></div></div>';
        scroll_element.html(scroll_content);

        var scroll_container = scroll_element.find('.scroll-container');
        var scroll_content = scroll_element.find('.scroll-content');
        var scrollbar = scroll_element.find('.scrollbar');

        var scroll_element_height = scroll_element.outerHeight();
        var scroll_container_height = scroll_container.outerHeight();
        var scroll_content_height = scroll_content.outerHeight();

        var init_scroll_pos = scroll_content.offset().top;

        /* Init Scrollbar Height */
        var percent = scroll_content_height / scroll_element_height;
        scrollbar.outerHeight(scroll_container_height / percent);
        if (percent > 1)  {
            scrollbar.removeClass('hide');
        } else {
            scrollbar.addClass('hide');
        }

        /* Drag Scrollbar */
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

                    var scroll_deg = (scrollbar.offset().top - scroll_element.offset().top) * percent;
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
            var top = scroll_container.scrollTop() / percent + scroll_element.offset().top;
            scrollbar.offset({ top: top});
        });

        scroll_container.mouseover(function () {
            if (scroll_content.outerHeight() != scroll_content_height) {
                scroll_content_height = scroll_content.outerHeight();
                percent = scroll_content_height / scroll_element.outerHeight();
                scrollbar.outerHeight(scroll_container.outerHeight() / percent);
                if (percent > 1)  {
                    scrollbar.removeClass('hide');
                } else {
                    scrollbar.addClass('hide');
                }
            }
            if (scroll_container.outerHeight() != scroll_container_height) {
                scroll_container_height = scroll_container.outerHeight();
                percent = scroll_content_height / scroll_element.outerHeight();
                scrollbar.outerHeight(scroll_container.outerHeight() / percent);
                if (percent > 1)  {
                    scrollbar.removeClass('hide');
                } else {
                    scrollbar.addClass('hide');
                }
            }
        });

    });
};

$.fn.scroller = function(action) {
    this.each(function () {
        var element = $(this);
        if (action == 'start')  {
            element.addClass('scroll');
            element.scroller_core();
        } else if (action == 'stop') {
            element.removeClass('scroll');
            var content = element.find('.scroll-content').html();
            element.html(content);
            element.unbind();
        }
    });
};