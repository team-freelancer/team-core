jQuery(document).ready(function($) {
	 var owl = $(".owl-carousel");
            owl.owlCarousel({
                margin:0,                           
                loop:true,                          
                nav:true,                           
                navText:['',''], 
                autoplay:true,                      
                autoplayTimeout:1500,
                autoplayHoverPause:false,
                autoplaySpeed: 1000,
                responsiveClass:true,               
                responsive:{
                    0:{
                        items:2,                                                                                                
                    },
                    600:{
                        items:3,          
                    },
                    1000:{
                        items:6,  
                    }
                }
            });


	$('.bxslider').bxSlider({
	  minSlides: 3,
	  maxSlides: 7,
	  slideWidth: 170,
	  slideMargin: 10,
	  autoControls: false,
	  controls: true,
	  auto: false,
	  ticker: true,
	  tickerHover: true,
	  autoHover: true,
	  speed: 18000
	});

$('.bxslider-detail').bxSlider({
  pagerCustom: '#bx-pager-detail',
  controls:false,
});

// slide pro
var owl = $(".owl-carousel-pro");
            owl.owlCarousel({
                margin:0,                           
                loop:true,                          
                nav:true,                           
                navText:['<i class="fa fa-chevron-circle-left fa-2x"></i>','<i class="fa fa-chevron-circle-right fa-2x"></i>'], 
                autoplay:true,                      
                autoplayTimeout:1500,
                autoplayHoverPause:true,
                autoplaySpeed: 1000,
                responsiveClass:true,               
                responsive:{
                    0:{
                        items:2,                                                                                                
                    },
                    600:{
                        items:3,          
                    },
                    1000:{
                        items:4,  
                    }
                }
            });
// update gio hang
    $('.btnupdate').click(function(){
        
        var rowid = $(this).attr('id');
        var qty = $(this).parent().parent().find('.qty').val();
        var token = $('input[name="_token"]').val();
        $.ajax({
            url: 'cap-nhat/'+rowid+'/'+qty,
            type: 'GET',
            cache: false,
            data:{
                '_token':token, 
                'id':rowid, 
                'qty':qty
            },
            success: function(data){
                if(data =="ok"){
                    window.location = 'gio-hang'
                }
            }
        });
    });
    
});