var select = $('#passenger-edit-table tr.active');
var id = select.attr('id');

$('#passenger-edit-table tr').click(function(){
    var rowId = this.id;
    $('#data').load('modules/passenger_edit.php',{id:rowId,trend1:trend1,field1:field1});
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
    trend1 = ( trend1 == 'ASC' )? 'DESC' : 'ASC';
    field1 = this.id;
    $('#data').load('modules/passenger_edit.php',{id:id, field1:field1, trend1:trend1});
    
});
