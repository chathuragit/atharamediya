/**
 * Created by Admin on 9/27/2016.
 */
function detail_slider(wrapper){
    var parent_wrapper = $(wrapper);
    var count = $(parent_wrapper).find('li').length;

    if(count <= 1){
        $(parent_wrapper).find('.prev').hide(0);
        $(parent_wrapper).find('.next').hide(0);
    }

    $(parent_wrapper).find('.prev').click(function(){
        var active = $(parent_wrapper).find('li.active');
        var prev = $(active).prev();
        var src = $(prev).find('img').attr('src');
        $(parent_wrapper).find('li').removeClass('active');

        if(src == undefined){
            prev = $(parent_wrapper).find('li:last-child');
            src = $(prev).find('img').attr('src');
        }

        $(prev).addClass('active');
        $('#preview_wrapper').find('img').attr('src', src);
    });

    $(parent_wrapper).find('.next').click(function(){
        var active = $(parent_wrapper).find('li.active');
        var next = $(active).next();
        var src = $(next).find('img').attr('src');
        $(parent_wrapper).find('li').removeClass('active');

        if(src == undefined){
            next = $(parent_wrapper).find('li:first-child');
            src = $(next).find('img').attr('src');
        }

        $(next).addClass('active');
        $('#preview_wrapper').find('img').attr('src', src);
    });

    $(parent_wrapper).find('li').click(function(){
        var src = $(this).find('img').attr('src');
        $(parent_wrapper).find('li').removeClass('active');
        $(this).addClass('active');
        $('#preview_wrapper').find('img').attr('src', src);
    });
}
