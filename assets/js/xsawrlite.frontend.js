jQuery(document).ready(function($) {
    "use strict";
    var currlink = location.href;
    $.ajax({
        url:frontend_ajax.ajaxurl,
        type:'POST',
        data:{
            action:'xsawrlite_get_nf_link',
        },
        success:function(response){ 
            if(response.off == 0){
                var obj = response.all_redirect;
                $.each(obj, function(key,value) {
                    var link  = 'a[href ="'+document.location.protocol+'//'+document.location.hostname+value.rurl+'"]';
                    var slink = 'a[href ="'+document.location.protocol+'//'+document.location.hostname+value.rurl+'/'+'"]';
                  if(response.nw_redirect == 1){
                    $(link).attr('target', '_blank');
                    $(slink).attr('target', '_blank');  
                  }else{
                    if(value.nw == 1){
                        $(link).attr('target', '_blank');
                        $(slink).attr('target', '_blank');  
                    }
                  }
                  if(response.nf_redirect == 1){
                    $(link).attr('rel', 'nofollow');
                    $(slink).attr('rel', 'nofollow');

                  }else{
                    if(value.nf == 1){
                        $(link).attr('rel', 'nofollow');
                        $(slink).attr('rel', 'nofollow');  
                    }
                  }  
                });
            }    
        }
    });
});