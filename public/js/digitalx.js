$(function() {
    $('.add-friend').click(function(e){
        e.preventDefault(e);
        var num = $('.form-group').size();
        var grab = $('.friend-block')
            .clone()
            .removeClass('friend-block')
            .appendTo('#field-wrap');
            
        $(grab).find(".control-label").text('Friend #' + num);
    });
});