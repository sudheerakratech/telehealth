$( document ).ready(function() {

    $('#menu_appointment').click( function () {
        $('#app_provider_id').val('');          
        $('#create_appointment_frm')[0].reset();                
        $('#app-modal-image').show();
        $('#find_doctor_btn').show();
        $('#create_appointment_btn').hide();
        $('#find_provider_block').html('');        
        $('#appointment').modal('show');        
    });

    $('#find_doctor_btn').click( function() {

        var app_date = $('#create_appointment_frm input[name=app_date]').val();
        var start_time = $('#create_appointment_frm input[name=start_time]').val();
        var end_time = $('#create_appointment_frm select[name=end_time]').val();

        if(app_date == '') {
            toastr.warning("Please enter appointment date.");
            return false;
        }
        if(start_time == '') {
            toastr.warning("Please enter appointment start time.");
            return false;
        }
        if(end_time == '') {
            toastr.warning("Please enter appointment end time.");
            return false;
        }

        $('#loader').fadeIn();
        $.ajax({
            url: $(this).data('action'),
            data: { app_date: app_date, start_time: start_time, end_time: end_time },
            type: 'post',
            success: function (data) {
                findProviderAjaxResponse(data);
            }
        });
        return false; 
    });

    function formProviderSubmit() {

        $('#find-provider-frm').submit( function() {

            var app_date = $('#create_appointment_frm input[name=app_date]').val();
            var start_time = $('#create_appointment_frm input[name=start_time]').val();
            var end_time = $('#create_appointment_frm select[name=end_time]').val();

            if(app_date == '') {
                toastr.warning("Please enter appointment date.");
                return false;
            }
            if(start_time == '') {
                toastr.warning("Please enter appointment start time.");
                return false;
            }
            if(end_time == '') {
                toastr.warning("Please enter appointment end time.");
                return false;
            }

            $('#loader').fadeIn();
            $.ajax({
                url: $(this).data('action'),            
                type: 'post',
                data: $(this).serialize() + "&app_date="+app_date+"&start_time="+start_time+"&end_time="+end_time,
                success: function (data) {
                    findProviderAjaxResponse(data);
                }
            });
            return false;
        });   
    }
    formProviderSubmit();

    function findProviderAjaxResponse(data) {
        $('#loader').fadeOut();                                
        $('#app-modal-image').hide();                            
        $("#find_provider_block").html('');
        $("#find_provider_block").append(data);
        
        formProviderSubmit();

        $('.request_app_doc').click( function () {                    
            $('#app_provider_id').val($('.request_app_doc').data('provider_id'));                                        
            $('#find_provider_block').text('');
            $('#create_appointment_btn').show();                    
            $('#app-modal-image').show();
        });
    }    

    $('#create_appointment_frm').submit( function() {

        if($('#app_provider_id').val() == '') {
            toastr.warning("Please search and request your doctor to appointment.");
            return false;
        }

        $('#loader').fadeIn();
        $.ajax({
            url: $('#create_appointment_btn').data('action'),
            data: $(this).serialize(),
            type: 'post',
            success: function (response) {                
                $('#loader').fadeOut();                
                if(response.status == 0) {
                    $('#find_doctor_btn').show();
                    toastr.error(response.message);
                } else {                    
                    toastr.success(response.message);
                    $('#appointment').modal('hide');
                }
            }
        });
        return false;
    });	

    $('.date_picker input').click(function(event){
       $('.date_picker').data("DateTimePicker").show();
    });
    $('.date_picker').datetimepicker({
        format: 'YYYY-MM-DD',
        maxDate: new Date()
    });

    $('#doc_register').click( function() { 
        $('#register_title').text('Doctor Registration');
        $('#doc_register').addClass('active');
        $('#pat_register').removeClass('active');
        $('#register_group_id').val(2);
        $('.doctors_field').show();
        $('#phone_number').attr('required',true);
        $('#country').attr('required',true);
        $('#specialty').attr('required',true);
    });

    $('#pat_register').click( function() { 
        $('#register_title').text('Patient Registration');
        $('#pat_register').addClass('active');
        $('#doc_register').removeClass('active');
        $('#register_group_id').val(100);
        $('.doctors_field').hide();
        $('#phone_number').attr('required',false);
        $('#country').attr('required',false);
        $('#specialty').attr('required',false);
    });    
});