jQuery(document).ready(function() {
	 
	"use strict";
	
    jQuery(".post-like a").on("click",function() {
        var heart = jQuery(this);
        // Retrieve post ID from data attribute
        var post_id = heart.data("post_id");
        // Ajax call
        jQuery.ajax({
            type: "post",
            url: iconsult__ajax_var.url,
			data: { action: 'post-like', 
					nonce: iconsult__ajax_var.nonce,
					post_id: post_id,
					post_like: '',
				  },
			success: function(data, textStatus, XMLHttpRequest){
					jQuery( "span.rating_likecount_display" ).text(data); 
			},
			error: function(MLHttpRequest, textStatus, errorThrown){  
				//alert(textStatus); 
			}
        });
        return false;
    })
	
	
    jQuery(".post-unlike a").on("click",function() { 
        var heart = jQuery(this);
        // Retrieve post ID from data attribute
        var post_id = heart.data("post_id");
        // Ajax call
        jQuery.ajax({
            type: "post",
            url: iconsult__ajax_var.url,
			data: { action: 'post-unlike', 
					nonce: iconsult__ajax_var.nonce,
					post_id: post_id,
					post_like: '',
				  },
			success: function(data, textStatus, XMLHttpRequest){ 
					jQuery( "span.rating_unlikecount_display" ).text(data);
			},
			error: function(MLHttpRequest, textStatus, errorThrown){  
				//alert(textStatus); 
			}
        });
        return false;
    })
	
	
	jQuery(".post-reset a").on("click",function() { 
	
	var action = confirm("Are you sure you want to start reset (like/unlike/total post visitors) process. Once reset it cant be undone");
	if (action == true) {
	
			var heart = jQuery(this);
			// Retrieve post ID from data attribute
			var post_id = heart.data("post_id");
			// Ajax call
			jQuery.ajax({
				type: "post",
				url: iconsult__ajax_var.url,
				data: { action: 'post-reset-stats', 
						nonce: iconsult__ajax_var.nonce,
						post_id: post_id,
						post_reset: '',
					  },
				success: function(data, textStatus, XMLHttpRequest){ 
						jQuery( "span.rating_likecount_display" ).text(''); 
						jQuery( "span.rating_unlikecount_display" ).text('');
				},
				error: function(MLHttpRequest, textStatus, errorThrown){  
					//alert(textStatus); 
				}
			});
			return false;
	}
	})	
	
	
	// IMPRESSION
	var imp_postIDs = '';
	var ids = 0;
	jQuery('.post-impression').each(function(){
		imp_postIDs = jQuery(this).attr('id').replace('post-impression-','');
		ids++;
	});
	if(imp_postIDs != '' ) { 
		jQuery.ajax({
				type: "post",
				url: iconsult__ajax_var.url,
				data: { action: 'post-impression', 
						nonce: iconsult__ajax_var.nonce,
						post_id: imp_postIDs,
					  },
				success: function(data, textStatus, XMLHttpRequest){ /*alert(data);*/ },
				error: function(MLHttpRequest, textStatus, errorThrown){ /*alert(textStatus);*/  }
		});
	}
		
	
})