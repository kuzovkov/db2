function validate(){
    var result = true;
    $('input.number').each(function(){
        var parent = $(this).parent();
        var re = /^[1-9][0-9]{0,}$/;
        if ( !re.test( $(this).val() ) ){
            $(this).addClass('novalid');
            result = false;
            if ( parent.children('p.novalid-message').length > 0 ){
                parent.children('p.novalid-message').text('Введите число!');
            }else{
                parent.append('<p class="novalid-message">Введите число!</p>');
            } 
        }else{
            $(this).removeClass('novalid');
            if ( parent.children('p.novalid-message').length > 0 ){
                parent.children('p.novalid-message').remove();
            }
        }  
    });
    
    $('input.time').each(function(){
        var parent = $(this).parent();
        var re = /^[0-9]{1,2}:[0-9]{1,2}(:[0-9]{1,2})?$/;
        if ( !re.test( $(this).val() ) ){
            $(this).addClass('novalid');
            result = false;
            if ( parent.children('p.novalid-message').length > 0 ){
                parent.children('p.novalid-message').text('Неверный формат времени!');
            }else{
                parent.append('<p class="novalid-message">Неверный формат времени!</p>');
            } 
        }else{
            $(this).removeClass('novalid');
            if ( parent.children('p.novalid-message').length > 0 ){
                parent.children('p.novalid-message').remove();
            }
        } 
    });
    
    $('input.passport').each(function(){
        var parent = $(this).parent();
        var re = /^[0-9]{4} [0-9]{6}$/;
        if ( !re.test( $(this).val() ) ){
            $(this).addClass('novalid');
            result = false;
            if ( parent.children('p.novalid-message').length > 0 ){
                parent.children('p.novalid-message').text('Неверный формат паспорта!');
            }else{
                parent.append('<p class="novalid-message">Неверный формат паспорта!</p>');
            } 
        }else{
            $(this).removeClass('novalid');
            if ( parent.children('p.novalid-message').length > 0 ){
                parent.children('p.novalid-message').remove();
            }
        } 
    });
    
    $('input.city').each(function(){
        var parent = $(this).parent();
        var re = /^[a-zA-Zа-яА-я-]{2,}$/;
        if ( !re.test( $(this).val() ) ){
            $(this).addClass('novalid');
            result = false;
            if ( parent.children('p.novalid-message').length > 0 ){
                parent.children('p.novalid-message').text('Некорректное название!');
            }else{
                parent.append('<p class="novalid-message">Некорректное название!</p>');
            } 
        }else{
            $(this).removeClass('novalid');
            if ( parent.children('p.novalid-message').length > 0 ){
                parent.children('p.novalid-message').remove();
            }
        } 
    });
    
    $('input.name').each(function(){
        var parent = $(this).parent();
        var re = /^[a-zA-Zа-яА-я-]{2,}$/;
        if ( !re.test( $(this).val() ) ){
            $(this).addClass('novalid');
            result = false;
            if ( parent.children('p.novalid-message').length > 0 ){
                parent.children('p.novalid-message').text('Некорректное имя!');
            }else{
                parent.append('<p class="novalid-message">Некорректное имя!</p>');
            } 
        }else{
            $(this).removeClass('novalid');
            if ( parent.children('p.novalid-message').length > 0 ){
                parent.children('p.novalid-message').remove();
            }
        } 
    });
    
    return result;
}
