var select = $('#passenger-table tr.active');
var id = select.attr('id');
var args = {id:rowId,field1:field1, field2:field2,trend1:trend1,trend2:trend2};


$('#passenger-table tr.tbody').click(function(){
    args.id = this.id;
    reloadPage();
});

$('#head-passenger li').click(function(){
    args.trend1 = ( args.trend1 == 'ASC' )? 'DESC' : 'ASC';
    args.field1 = this.id;
    reloadPage();
    
});

$('#head-ticket li').click(function(){
    args.trend2 = ( args.trend2 == 'ASC' )? 'DESC' : 'ASC';
    args.field2 = this.id;
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
   
    $('#data').load('modules/passenger.php',args);
}