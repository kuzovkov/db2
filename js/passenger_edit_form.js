$('#btn-passenger-new-cancel').click(function(){
    $('#data').load('modules/passenger_edit.php');
});

$('#btn-passenger-create-ok').click(function(){
    if (!validate()) return false;
    var name = $('#name').val();
    var lastname = $('#lastname').val();
    var sex = $('#sex').val();
    var age = $('#age').val();
    var passport = $('#passport').val();
    
    var data = {add:'1',name:name,lastname:lastname,sex:sex,age:age,passport:passport};
    var object = JSON.stringify(data);
    var title = 'Добавление пассажира';
    var message = 'Добавить пассажира: ';
    message += '<br/>Имя: ' + name;
    message += '<br/>Фамилия: ' + lastname;
    message += '<br/>Пол: ' + sex;
    message += '<br/>Возраст: ' + age;
    message += '<br/>Паспорт: ' + passport;
    var targetOk = 'modules/passenger_edit.php';
    var targetCancel = 'modules/passenger_edit.php';
    confirm(title, message, object, targetOk, targetCancel);
});

