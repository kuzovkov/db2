var select = $('#flight-table tr.active');
var id = select.attr('id');
var args = {id:rowId,field1:field1, field2:field2,trend1:trend1,trend2:trend2};

$('#flight-table tr.tbody').click(function(){
    args.id = this.id;
    reloadPage();
});

$('ul#head-flight li').click(function(){
    args.trend1 = ( args.trend1 == 'ASC' )? 'DESC' : 'ASC';
    args.field1 = this.id;
    reloadPage();
});

$('ul#head-ticket li').click(function(){
    args.trend2 = ( args.trend2 == 'ASC' )? 'DESC' : 'ASC';
    args.field2 = this.id;
    reloadPage();
});

$('#filter').change(function(){
    search = ($(this).prop('checked'))? true:false;
    reloadPage();    
});

$('#filter-point-dep').change(function(){
    search = ($('#filter').prop('checked'))? true:false;
    if ( search ) reloadPage(); 
    
});

$('#filter-point-arr').change(function(){
    search = ($('#filter').prop('checked'))? true:false;
    if ( search ) reloadPage(); 
});

function reloadPage(){
    
    if ( search ){
        args.filter1 = $('#filter-point-dep').val();
        args.filter2 = $('#filter-point-arr').val();
        args.search = search; 
    }else{
        delete args.filter1;
        delete args.filter2;
    }
    $('#data').load('modules/flight.php',args);
}
