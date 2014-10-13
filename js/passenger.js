var select = $('#passenger-table tr.active');
var id = select.attr('id');

$('#passenger-table tr.tbody').click(function(){
    var rowId = this.id;
    $('#data').load('modules/passenger.php',{id:rowId,field1:field1, field2:field2,trend1:trend1,trend2:trend2});
});

$('#head-passenger li').click(function(){
    trend1 = ( trend1 == 'ASC' )? 'DESC' : 'ASC';
    field1 = this.id;
    $('#data').load('modules/passenger.php',{id:id, field1:field1, field2:field2,trend1:trend1,trend2:trend2});
    
});

$('#head-ticket li').click(function(){
    trend2 = ( trend2 == 'ASC' )? 'DESC' : 'ASC';
    field2 = this.id;
    $('#data').load('modules/passenger.php',{id:id, field1:field1, field2:field2,trend1:trend1,trend2:trend2});
    
});