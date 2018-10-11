$( document ).ready(function() {

    $('#menu_appointment').click( function () {
        $('#app_provider_id').val('');
        $('#create_appointment_frm')[0].reset();
        $('.find_provider_block').show();        
        findAppointmentDoctorForm();
        $('#appointment').modal('show');
    });

    function findAppointmentDoctorForm() {
        $('#loader').fadeIn();
        $.ajax({
            url: $('#find-provider-frm').data('action'),
            data: $('#find-provider-frm').serialize(),
            type: 'post',
            success: function (data) {
                $('#loader').fadeOut();
                $('#app-modal-image').hide();
                $("#app_doctors_list").show();
                $("#app_doctors_list").html(data);

                $('.request_app_doc').click( function () {                    
                    $('#app_provider_id').val($(this).data('provider_id'));
                    $('#find-provider-frm')[0].reset();
                    $('#app_doctors_list').text('');
                    $('#app-modal-image').show();
                    toastr.success("You have requested to doctor! Now, You can make your appointment.");
                });
            }
        });
        return false;
    }

    $('#find-provider-frm').submit(function(){            
        findAppointmentDoctorForm();
        return false; 
    });

	$('#create_appointment_frm').submit( function () {        
        if($('#app_provider_id').val() == '') {
            toastr.warning("Please search and request your doctor to appointment.");
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