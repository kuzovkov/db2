$('td.name').hover(function(){
    
    $(this).removeClass('hide');
    $(this).addClass('show');
    },
    function(){ 
        $(this).removeClass('show');
        $(this).addClass('hide');
});