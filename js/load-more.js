jQuery(function($){
    var numItems = $('.grid_item').length;
    if((numItems%9)>0){
        $('#next').hide();	
    }
    $('body').on('click','#next', function(){
    var postType = $('#primary')[0].dataset.type;
    numItems = $('.grid_item').length;
    var allData = {action:'subrosa_next',listcount:numItems,post_type:postType};
		$('.page-load-status_load').css("display","block");
		$('.loader-ellipse_load').css("display","block");
		$.ajax({
			url:"/wp-admin/admin-ajax.php",
			data:allData,
			type:"post", 
			
			success:function(data){
                $('.page-load-status_load').css("display","none");
                $('.loader-ellipse_load').css("display","none");
                if(data==''){
                    $('#more').append('<h3 style="margin-bottom:30px">No more to show</h3>');
                    $('#next').hide();	
                }
                $('#more').append(data); 
                $('#more').fadeIn();
                var numItemsRecount = $('.grid_item').length;
                if((numItemsRecount%12)>0){
                    $('#next').hide();	
                }
			}
		});
		return false;
    });
})