switchMenu('flight');
    
$('.menu').click(function(){
    menuId = this.id;
   switchMenu(menuId);
});

function switchMenu(menuId){
    $('li').removeClass('active');
    $('#'+menuId).parent().addClass('active');
    $('#data').load('modules/'+menuId+'.php');
}

