;(function ($) {
    $(document).ready(function () {

        // check if the checkbox is checked for comment setting form or not
        var showClass = $(".fblcs_hide_post_form, .fblcs_hide_page_form, .fblcs_disable_comments_and_form");
        
        if ( $(".fblcs_c_option").is(":checked")) {
            showClass.show();
        }   

        $(".fblcs_c_option").click(function() {
            if ($(this).is(":checked")) {
                showClass.show();
            } else {                                                
                $(".fblcs_hide_post_form td, .fblcs_hide_page_form td, .fblcs_disable_comments_and_form td").find("input[type=checkbox]").prop( "checked", false );                
                showClass.hide();                
            }
        });      

        var fblcs_c_mobile_optimize = $("#fblcs_c_mobile_optimize").val();
        if ( fblcs_c_mobile_optimize == 'true' ) {
            $("#fblcs_c_width").hide();
        } else {
            $("#fblcs_c_width").show();
        }

        $("#fblcs_c_mobile_optimize").change(function() {
            var fblcs_c_mobile_optimize = $(this).val();
            if ( fblcs_c_mobile_optimize == 'true' ) {
                $("#fblcs_c_width").hide();
            } else if ( fblcs_c_mobile_optimize == 'false' ) {
                $("#fblcs_c_width").show();
            } else {
                $("#fblcs_c_width").hide();
            }
        });

        
        // fblcs commetn settings
        $("#fblcs_ajax_form_id").on('submit', function (e) {            
            var nonce       =   $("#fblcs_s_nonce").val();
            var action      =   $("#fblcs_action_name").val();
            var form_data   =   $(this).serialize()+'&s='+nonce+'&action='+action;
            $.ajax({
                type        :   'POST',
                url         :   urls.ajaxurl,
                dataType    :   'html',
                data        :   form_data,
                beforeSend : function () {
                    $("#fblcs_submit_btn").val('Please wait...');
                },
                success: function ( result ) {
                    $("#fblcs_submit_btn").val('Save Change');
                    $(".fblcs_ajax_result").html( result );
                }
                
            });
            return false;
        });
        

        var exting_option   =   $(".fblcs_l_href_auto").val();        
        if( exting_option == 'given' ) {
            $("#let_me_give_it").show();
        }

        $(".fblcs_l_href_auto").change(function() {
            var option  =   $(this).val();
            if( option == 'given' ) {
                $("#let_me_give_it").show();
            } else {
                $("#let_me_give_it").hide();
            }
        }); 

        var share_exting_option     =   $(".fblcs_s_href_auto").val();        
        if( share_exting_option     ==  'given' ) {
            $("#let_me_give_it_s").show();
        }

        $(".fblcs_s_href_auto").change(function() {
            var option  =   $(this).val();
            if( option == 'given' ) {
                $("#let_me_give_it_s").show();
            } else {
                $("#let_me_give_it_s").hide();
            }
        }); 

    });

})(jQuery);