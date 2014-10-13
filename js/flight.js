var select = $('#flight-table tr.active');
var id = select.attr('id');

$('#flight-table tr.tbody').click(function(){
    var rowId = this.id;
    $('#data').load('modules/flight.php',{id:rowId,field1:field1, field2:field2,trend1:trend1,trend2:trend2});
});

$('ul#head-flight li').click(function(){
    trend1 = ( trend1 == 'ASC' )? 'DESC' : 'ASC';
    field1 = this.id;
    $('#data').load('modules/flight.php',{id:id, field1:field1, field2:field2,trend1:trend1,trend2:trend2});
    
});

$('ul#head-ticket li').click(function(){
    trend2 = ( trend2 == 'ASC' )? 'DESC' : 'ASC';
    field2 = this.id;
    $('#data').load('modules/flight.php',{id:id, field2:field2, field1:field1, trend1:trend1, trend2:trend2});
    
});