var select = $('#flight-edit-table tr.active');
var id = select.attr('id');

$('#flight-edit-table tr').click(function(){
    var rowId = this.id;
    $('#data').load('modules/flight_edit.php',{id:rowId,trend1:trend1,field1:field1});
});

$('#btn-flight-del').click(function(){
    
    var time_dep, time_arr, point_dep, point_arr, place;
    $('#flight-edit-table tr.active td').each(function(){
        switch( $(this).attr('key') ){
            case 'time_dep':  time_dep = $(this).text(); break;
            case 'time_arr':  time_arr = $(this).text(); break;
            case 'point_dep':  point_dep = $(this).text(); break;
            case 'point_arr':  point_arr = $(this).text(); break;
            case 'place':  place = $(this).text(); break;
        };
    });
    var data = {del:id,trend1:trend1,field1:field1};
    var object = JSON.stringify(data);
    var title = 'Удаление рейса';
    var message = 'Удалить рейс: ';
    message += '<br/>Время вылета: ' + time_dep;
    message += '<br/>Время прилета: ' + time_arr;
    message += '<br/>Пункт вылета: ' + point_dep;
    message += '<br/>Пункт прилета: ' + point_arr;
    message += '<br/>Количество мест: ' + place;
    var targetOk = 'modules/flight_edit.php';
    var targetCancel = 'modules/flight_edit.php';
    confirm(title, message, object, targetOk, targetCancel);
});

$('#btn-flight-create').click(function(){
    $('#data').load('modules/flight_edit_form.php');
});

$('ul#head-flight li').click(function(){
    trend1 = ( trend1 == 'ASC' )? 'DESC' : 'ASC';
    field1 = this.id;
    $('#data').load('modules/flight_edit.php',{id:id, field1:field1, trend1:trend1});
    
});
