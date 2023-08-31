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
    $('#xsawrlite_name , #xsawrlite_email , #xsawrlite_message').on('change',function(e){
        if(!$(this).val()){
            $(this).addClass("error");
        }else{
            $(this).removeClass("error");
        }
    });
    $('.xsawrlite_support_form').on('submit' , function(e){ 
        e.preventDefault();
        jQuery('.xs-send-email-notice').hide();
        jQuery('.xs-mail-spinner').addClass('xs_is_active');
        jQuery('#xsawrlite_name').removeClass("error");
        jQuery('#xsawrlite_email').removeClass("error");
        jQuery('#xsawrlite_message').removeClass("error");
        $.ajax({ 
            url:ajaxurl,
            type:'post',
            data:{'action':'xsawrlite_send_mail','data':$(this).serialize()},
            beforeSend: function(){
                if(!jQuery('#xsawrlite_name').val()){
                    jQuery('#xsawrlite_name').addClass("error");
                    jQuery('.xs-send-email-notice').removeClass('notice-success');
                    jQuery('.xs-send-email-notice').addClass('notice');
                    jQuery('.xs-send-email-notice').addClass('error');
                    jQuery('.xs-send-email-notice').addClass('is-dismissible');
                    jQuery('.xs-send-email-notice p').html('Please fill all the fields');
                    jQuery('.xs-send-email-notice').show();
                    jQuery('.xs-notice-dismiss').show();
                    window.scrollTo(0,0);
                    jQuery('.xs-mail-spinner').removeClass('xs_is_active');
                    return false;
                }
                 if(!jQuery('#xsawrlite_email').val()){
                    jQuery('#xsawrlite_email').addClass("error");
                    jQuery('.xs-send-email-notice').removeClass('notice-success');
                    jQuery('.xs-send-email-notice').addClass('notice');
                    jQuery('.xs-send-email-notice').addClass('error');
                    jQuery('.xs-send-email-notice').addClass('is-dismissible');
                    jQuery('.xs-send-email-notice p').html('Please fill all the fields');
                    jQuery('.xs-send-email-notice').show();
                    jQuery('.xs-notice-dismiss').show();
                    window.scrollTo(0,0);
                    jQuery('.xs-mail-spinner').removeClass('xs_is_active');
                    return false;
                }
                 if(!jQuery('#xsawrlite_message').val()){
                    jQuery('#xsawrlite_message').addClass("error");
                    jQuery('.xs-send-email-notice').removeClass('notice-success');
                    jQuery('.xs-send-email-notice').addClass('notice');
                    jQuery('.xs-send-email-notice').addClass('error');
                    jQuery('.xs-send-email-notice').addClass('is-dismissible');
                    jQuery('.xs-send-email-notice p').html('Please fill all the fields');
                    jQuery('.xs-send-email-notice').show();
                    jQuery('.xs-notice-dismiss').show();
                    window.scrollTo(0,0);
                    jQuery('.xs-mail-spinner').removeClass('xs_is_active');
                    return false;
                }
                jQuery(".xsawrlite_support_form :input").prop("disabled", true);
                jQuery("#xsawrlite_message").prop("disabled", true);
                jQuery('.xsawrlite-send-mail').prop('disabled',true);
            },
            success: function(res){
                jQuery('.xs-send-email-notice').find('.xs-notice-dismiss').show();
                jQuery('.xsawrlite-send-mail').prop('disabled',false);
                jQuery(".xsawrlite_support_form :input").prop("disabled", false);
                jQuery("#xsawrlite_message").prop("disabled", false);
                if(res.status == true){
                    jQuery('.xs-send-email-notice').removeClass('error');
                    jQuery('.xs-send-email-notice').addClass('notice');
                    jQuery('.xs-send-email-notice').addClass('notice-success');
                    jQuery('.xs-send-email-notice').addClass('is-dismissible');
                    jQuery('.xs-send-email-notice p').html('Successfully sent');
                    jQuery('.xs-send-email-notice').show();
                    jQuery('.xs-notice-dismiss').show();
                    jQuery('.xsawrlite_support_form')[0].reset();
                }else{
                    jQuery('.xs-send-email-notice').removeClass('notice-success');
                    jQuery('.xs-send-email-notice').addClass('notice');
                    jQuery('.xs-send-email-notice').addClass('error');
                    jQuery('.xs-send-email-notice').addClass('is-dismissible');
                    jQuery('.xs-send-email-notice p').html('Sent Failed');
                    jQuery('.xs-send-email-notice').show();
                    jQuery('.xs-notice-dismiss').show();
                }
                jQuery('.xs-mail-spinner').removeClass('xs_is_active');
            }

        });
    });
    $('.xs-notice-dismiss').on('click',function(e){
        e.preventDefault();
        $(this).parent().hide();
        $(this).hide();
    });

});