jQuery(document).ready(function($) {
    "use strict";
    // add new redirect  on click 
	$("#xsawrlite_addredirects").on('click',function(e){
		e.preventDefault();
        var frm = $('#xsawrlite_redirect')[0];
		$.ajax({
            url:ajaxurl,
            type:'POST',
            beforeSend: function(){$("#xsawrlite-overlay").show();},
            complete: function(){$("#xsawrlite-overlay").hide();},
            data:{
            action:'xsawrlite_add_redirects',
            redirect_data:$('#xsawrlite_redirect').serialize(),
            },
            success:function(response){
            	if(response.error){
                    $("#xsawrlite-snackbar").html(response.error);
            	}else{
                    $("#xsawrlite-snackbar").html(response.success);
                	$( "#xsawrlite-refresh").html(response.output);
                    frm.reset();
                    $('html, body').animate({ 
                        scrollTop: $('.xsawrlite-scroll-down').offset().top 
                    }, 2000 );
            	}
                $("#xsawrlite-snackbar").addClass('show');
                    setTimeout(function(){ 
                        $("#xsawrlite-snackbar").removeClass('show'); 
                }, 2000);
            }
        });
    });

   // Delete redirect on click delete button
    $("#xsawrlite-refresh").on('click' ,'.xsawrlite-del', function(){
        $(".xsawrlite-message").html('');
        var id = $(this).attr('id');
        var dialog = document.querySelector('dialog');
        if (!dialog.showModal) {
          dialogPolyfill.registerDialog(dialog);
        }
        dialog.showModal();
        dialog.querySelector('.xsawrlite-close').addEventListener('click', function() {
          dialog.close();
        });
        dialog.querySelector('.xsawrlite-yes').addEventListener('click', function() {
            dialog.close();
            $.ajax({
                url:ajaxurl,
                type:'POST',
                beforeSend: function(){$("#xsawrlite-overlay").show();},
                complete: function(){$("#xsawrlite-overlay").hide();},
                data:{
                action:'xsawrlite_del',
                redirect_id: id,
                },
                success:function(response){
                    $('tr').remove('#xsawrlite-row-'+id);
                    $("#xsawrlite-snackbar").html(response.msg);
                    $("#xsawrlite-snackbar").addClass('show');
                        setTimeout(function(){ 
                            $("#xsawrlite-snackbar").removeClass('show'); 
                    }, 2000);
                }
            });
        });   
    });

    // Edit form appear on click edit button
    $("#xsawrlite-refresh").on('click' ,'.xsawrlite-edit', function(){
        var id = $(this).attr('id');
        var backup = $('#xsawrlite-row-'+id).html();
        $.ajax({
            url:ajaxurl,
            type:'POST',
            beforeSend: function(){$("#xsawrlite-overlay").show();},
            complete: function(){$("#xsawrlite-overlay").hide();},
            data:{
                action:'xsawrlite_edit_redirects',
                redirect_id:id,
            },
            success:function(response){
                $('#xsawrlite-row-'+id).html(response);
            }
        });    
        $('#xsawrlite-row-'+id).on('click' ,'#xsawrlite-cancel', function(e){
            e.preventDefault();
           $('#xsawrlite-row-'+id).html(backup); 
        });
        $('#xsawrlite-row-'+id).on('click' ,'#xsawrlite-save', function(e){
            e.preventDefault();
            $.ajax({
                url:ajaxurl,
                type:'POST',
                beforeSend: function(){$("#xsawrlite-overlay").show();},
                complete: function(){$("#xsawrlite-overlay").hide();},
                data:{
                action:'xsawrlite_add_redirects',
                redirect_id: id,
                redirect_data:$('#xsawrlite_redirect_'+id).serialize(),
                },
                success:function(response){
                    if(response.error){
                        $("#xsawrlite-snackbar").html(response.error);
                    }else{
                        $("#xsawrlite-snackbar").html(response.updated);
                        $( "#xsawrlite-refresh").html(response.output);
                    }
                    $("#xsawrlite-snackbar").addClass('show');
                        setTimeout(function(){ 
                            $("#xsawrlite-snackbar").removeClass('show'); 
                    }, 2000);
                }
            });
            
        });           
    });
});