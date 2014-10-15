var select = $('#passenger-edit-table tr.active');
var id = select.attr('id');
var args = {id:rowId,field1:field1, trend1:trend1 };

$('#passenger-edit-table tr').click(function(){
    args.id = this.id;
    reloadPage();
});

$('#btn-passenger-del').click(function(){
    var name, lastname, sex, age, passport;
    $('#passenger-edit-table tr.active td').each(function(){
        switch( $(this).attr('key') ){
            case 'name':  name = $(this).text(); break;
            case 'lastname':  lastname = $(this).text(); break;
            case 'sex':  sex = $(this).text(); break;
            case 'age':  age = $(this).text(); break;
            case 'passport':  passport = $(this).text(); break;
        };
    });
    var data = {del:id,trend1:trend1,field1:field1};
    var object = JSON.stringify(data);
    var title = 'Удаление пассажира';
    var message = 'Удалить пассажира: ';
    message += '<br/>Имя: ' + name;
    message += '<br/>Фамилия: ' + lastname;
    message += '<br/>Пол: ' + sex;
    message += '<br/>Возраст: ' + age;
    message += '<br/>Паспорт: ' + passport;
    var targetOk = 'modules/passenger_edit.php';
    var targetCancel = 'modules/passenger_edit.php';
    confirm(title, message, object, targetOk, targetCancel);
});

$('#btn-passenger-create').click(function(){
    $('#data').load('modules/passenger_edit_form.php');
});

$('ul#head-passenger li').click(function(){
    args.trend1 = ( args.trend1 == 'ASC' )? 'DESC' : 'ASC';
    args.field1 = this.id;
    reloadPage();
    
});

$('#filter').change(function(){
    search = ($(this).prop('checked'))? true:false;
    reloadPage();    
});

$('#filter1').change(function(){
    search = ($('#filter').prop('checked'))? true:false;
    if ( search ) reloadPage(); 
    
});

$('#filter2').change(function(){
    search = ($('#filter').prop('checked'))? true:false;
    if ( search ) reloadPage(); 
});

function reloadPage(){
    
    args.filter1 = $('#filter1').val();
    args.filter2 = $('#filter2').val();
    args.search = search;    
    $('#data').load('modules/passenger_edit.php',args);
}
