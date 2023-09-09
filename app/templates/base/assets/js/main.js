$(document).ready(function() {

    function childsHeight(element) {
        var totalHeight = 0;
        $(element).children().each(function(){
            totalHeight = totalHeight + $(this).outerHeight(true);
        });
        return totalHeight;
    }

    /* Navbar Dropdown */
    $('.dropdown').on('click', function () {
        var dropdown = $(this);
        var dropdown_menu = dropdown.find('.dropdown-menu');
        dropdown.toggleClass('active');
        dropdown_menu.toggleClass('show');
    });

    /* Toggle Sidebar */
    $('.sidebar-toggle-btn').on('click', function () {
        $(this).find('.icon').toggleClass('changed');
        $('.navbar-header').toggleClass('changed');
        $('.sidebar').toggleClass('changed');
        $('.main').toggleClass('changed');
        if ($('.sidebar').hasClass('changed')) {
            $('.sidebar-scroll').scroller('stop');
            $('.sidebar-scroll').smooth('start');
        } else {
            $('.sidebar-scroll').smooth('stop');
            $('.sidebar-scroll').scroller('start');
        }
    });

    /* Sidebar Menu Dropdown Click */
    $(document).on('click','.has-menu',function(e) {
        var menu = $(this).find('.menu');
        var height = childsHeight(menu);

        if (!$(this).hasClass('active')) {
            $(this).find('.menu').css('max-height', height + 30);
        } else {
            $(this).find('.menu').css('max-height', '0px');
        }

        $(this).toggleClass('active');
        $(this).find('.menu').toggleClass('show');
    });

    /* Sidebar Menu Dropdown Hover */
    $(document).on({
        mouseenter: function () {
            if ($('.sidebar').hasClass('changed')) {
                $(this).click();
            }
        },
        mouseleave: function () {
            if ($('.sidebar').hasClass('changed')) {
                $(this).click();
            }
        }
    }, ".has-menu");

    /* Select Input Content */
    $(document).on('click','.field-label',function(e) {
        $(this).parent().find('input').select();
        $(this).parent().find('textarea').select();
    });

    /* Active Link */
    $('.sidebar-nav .nav-link').each(function () {
        var path = window.location.pathname;
        var nav_link = $(this).attr('href');
        nav_link = nav_link.replace(/\\+/g, '/');
        var res = nav_link.split("/");
        var n = res[1] + '/' + res[2];
        if (path == '/mvc/' && nav_link == path) {
            $(this).addClass('active');
        } else if(path.includes(n) && nav_link != '/mvc/') {
            $(this).addClass('active');
        }
    })

    /* Hide Messenger Alerts After x Seconds*/
    $('.alert').each(function () {
        var alert = $(this);
        setTimeout(function(){
            alert.addClass('hide');
        }, 5000);
        setTimeout(function(){
            alert.remove();
        }, 5300);
    });

    /* Close Messenger Alerts */
    $('.alert .close').on('click', function () {
        var alert = $(this);
        alert.parent().addClass('hide');
        setTimeout(function(){
            alert.parent().remove();
        }, 300);
    });

    /* Tabbed Pane */
    $(document).on('click', '.tabbed', function(e){
        if ($(e.target).is('.tab-button')) {
            // Get Button Index
            var index = $(e.target).index();
            //Set Active Button
            $(e.target).addClass('active').siblings().removeClass('active');
            //Set Active Tab
            $(this).find('.tabs').children().eq(index).addClass('active').siblings().removeClass('active');
        }
    });
    /* Set Default Tab */
    $('.tabbed').each(function(index) {
        $(this).find("[data='default']").click();
    });

    /* Add Text Field */
    $(document).on('click', '.add-field.textfield', function(){
        var id = $('input[name="field_id"]').val();
        $.post('http://localhost/mvc/categories/textfield', {id: id}, function(data, status){
            if (data) {
                if ($('.cat-fields').hasClass('no-fields')) {
                    $('.cat-fields').html(data);
                    $('.cat-fields').removeClass('no-fields');
                } else {
                    $('.cat-fields').append(data);
                }
                id++;
                $('input[name="field_id"]').val(id);
            }
        });
    });
    /* Add Numeric Field */
    $(document).on('click', '.add-field.numericfield', function(){
        var id = $('input[name="field_id"]').val();
        $.post('http://localhost/mvc/categories/numericfield', {id: id}, function(data, status){
            if (data) {
                if ($('.cat-fields').hasClass('no-fields')) {
                    $('.cat-fields').html(data);
                    $('.cat-fields').removeClass('no-fields');
                } else {
                    $('.cat-fields').append(data);
                }
                id++;
                $('input[name="field_id"]').val(id);
            }
        });
    });
    /* Add Select Field */
    $(document).on('click', '.add-field.selectfield', function(){
        var id = $('input[name="field_id"]').val();
        $.post('http://localhost/mvc/categories/selectfield', {id: id}, function(data, status){
            if (data) {
                if ($('.cat-fields').hasClass('no-fields')) {
                    $('.cat-fields').html(data);
                    $('.cat-fields').removeClass('no-fields');
                } else {
                    $('.cat-fields').append(data);
                }
                id++;
                $('input[name="field_id"]').val(id);
            }
        });
    });
    /* Add Select Option */
    $(document).on('click', '.add-field.option', function(){
        var options = $(this);
        var pid = $(this).parent().parent().parent().parent().find('input[name="selectfield_id"]');
        var id = $(this).parent().parent().parent().parent().find('input[name="option_id"]');
        $.post('http://localhost/mvc/categories/option', {pid: pid.val(), id: id.val()}, function(data, status){
            if (data) {
                options.parent().parent().parent().parent().find('.options').append(data);
                var new_id = parseInt(id.val());
                new_id++;
                id.val(new_id);
            }
        });
    });
    /* Add Checkbox Field */
    $(document).on('click', '.add-field.checkboxfield', function(){
        var id = $('input[name="field_id"]').val();
        $.post('http://localhost/mvc/categories/checkboxfield', {id: id}, function(data, status){
            if (data) {
                if ($('.cat-fields').hasClass('no-fields')) {
                    $('.cat-fields').html(data);
                    $('.cat-fields').removeClass('no-fields');
                } else {
                    $('.cat-fields').append(data);
                }
                id++;
                $('input[name="field_id"]').val(id);
            }
        });
    });

    $(document).on('click', '.delete-field', function(){
        $(this).parent().parent().remove();
    });

    $(document).on('click', '.delete-option', function(){
        $(this).parent().parent().remove();
    });

    $('.main').scroller('start');
    $('.sidebar-scroll').scroller('start');

});