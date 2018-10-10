$( document ).ready(function() {

    $('#menu_appointment').click( function () {
        $('#create_appointment_frm')[0].reset();
        $('#find-provider-frm')[0].reset();
        $('#app_provider_id').val('');
        $('.find_provider_block').show();
        $('#app-modal-image').show();
        $('#app_doctors_list').text('');        
        $('#appointment').modal('show');
    });

    $('#find-provider-frm').submit(function(){            
        $('#loader').fadeIn();
        $.ajax({
            url: $(this).data('action'),
            data: $(this).serialize(),
            type: 'post',
            success: function (data) {
                $('#loader').fadeOut();
                $('#app-modal-image').hide();
                $("#app_doctors_list").show();
                $("#app_doctors_list").html(data);

                $('.request_app_doc').click( function () {        
                    $('#find-provider-frm')[0].reset();
                    $('#app_doctors_list').text('');
                    $('#app_provider_id').val($(this).data('provider_id'));
                    $('#app-modal-image').show();                                                            
                    toastr.success("You have a doctor! Now, You can make an appointment.");
                });
            }
        });
        return false; 
    });

	$('#create_appointment_frm').submit( function () {        
        if($('#app_provider_id').val() == '') {
            toastr.warning("There is no any doctor selected.");
            return false;
        }
        $('#loader').fadeIn();
        $.ajax({
            url: $(this).data('action'),
            data: $('#create_appointment_frm').serialize(),
            type: 'post',
            success: function (response) {                
                $('#loader').fadeOut();                
                if(response.status == 0) {
                    toastr.error(response.message);
                } else {                    
                    toastr.success(response.message);
                    $('#appointment').modal('hide');
                }
            }
        });
		return false;
	});    

});