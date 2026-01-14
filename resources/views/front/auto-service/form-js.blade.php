<script>
    var messages = @json(__('messages'));
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); 

    function closeModalReservation(){
        let modal = $('#serviceReservation');
        modal.modal('toggle');
    }

    function validate(){
        let errors = $('.service-reservation-form .error-form');
        let errorsStatus = [];

        errors.each(function() {
            let input = $(this).parent().find('input');
            let inputVal = input.val();
            let error = $(this);

            console.log(inputVal)
            if(inputVal == undefined || inputVal == null || inputVal == '' || inputVal == NaN){
                error.html(messages.required);
                errorsStatus.push(1);
            }else{
                error.html("");
                errorsStatus.push(0)
            }
            if (input.attr('type') == 'email'){
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(inputVal)){
                }else{
                    error.html(messages.valide_email);
                    errorsStatus.push(1)
                }
            }
        });

        if (errorsStatus.includes(1)) {
            return false;
        } else {
            return true;
        }

    }
    function submitReservation(){
        console.log(validate());
        if(validate()){
            let type = $('.auto-service-form #type').val();
            let date = $('.auto-service-form #service_prefered_date').val();
            let time = $('.auto-service-form #time').val();
            let car_brand = $('.auto-service-form #car_brand').val();
            let car_model = $('.auto-service-form #car_model').val();
            let registration_number = $('.auto-service-form #registration_number').val();
            let name = $('.auto-service-form #first_name').val();
            let surname = $('.auto-service-form #last_name').val();
            let email = $('.auto-service-form #email').val();
            let phone = $('.auto-service-form #phone').val();
            let comment = $('.auto-service-form #comment').val();

            let modalService = $('#serviceReservation');
            let text = $('.service-reservation .text');
            let spinner = $('.service-reservation .spinner-border');
            let errorIcon = $('.service-reservation #error-icon');
            let successIcon = $('.service-reservation #success-icon');
            let closeButton = $('.service-reservation .close');

            modalService.modal('show');
            spinner.show();
            successIcon.hide();
            errorIcon.hide();
            closeButton.hide();
            text.html('');

            $.ajax({
                url: '/service/reservation/update',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: JSON.stringify({
                    "type": type,
                    "time": time,
                    'prefered_date': date, 
                    "car_brand": car_brand,
                    "car_model": car_model,
                    "registration_number": registration_number,
                    "first_name": name,
                    "last_name": surname,
                    "email": email,
                    "phone": phone,
                    "comment": comment
                }),
                processData: true,
                contentType: 'application/json',
                success: function(data) {
                    console.log(data);
                    if(data.status == 500 && data.message == 'busy'){
                        spinner.hide();
                        errorIcon.show();
                        closeButton.show();
                        text.html(messages.busy_service_reservation);
                    }
                    if(data.status == 200 && data.message == 'success'){
                        successIcon.show();
                        closeButton.show();
                        spinner.hide();
                        text.html(messages.sucess_service_reservation);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    spinner.hide();
                    errorIcon.show();
                    closeButton.show();
                    text.html(messages.error_service_reservation);
                    console.log("err",textStatus);
                }
            });
        }
    }
</script>

<script>
    $('#service_prefered_date').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        timePicker: false,
        minDate: new Date()
      }, function(start, end, label) {
      }
    );

    $('.timerangepicker').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      timePicker24Hour: true,
      singleDatePicker: true,
      startDate: moment().startOf('day'),
      endDate: moment().startOf('day'),
      locale: {
        format: 'HH:mm'
      }
    },function(start, end, label) {

    });

    $('.timerangepicker').on('show.daterangepicker', function(ev, picker) {
      picker.container.find('.calendar-table').hide();
    });

    $('.timerangepicker').on('apply.daterangepicker', function(ev, picker) {
      var selectedTime = picker.startDate.format('HH:mm');
      console.log(selectedTime);
      // Do something with the selected time
    });

    var timerangepicker = "{{ old('time') }}"

    if(timerangepicker != "" && timerangepicker != undefined){
      $('.timerangepicker').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        timePicker24Hour: true,
        singleDatePicker: true,
        startDate: moment().startOf('day'),
        endDate: moment().startOf('day'),
        startDate: moment().startOf('day').set({ hour: timerangepicker.split(':')[0], minute: timerangepicker.split(':')[1], second: 0 }),
        locale: {
          format: 'HH:mm'
        }
      },function(start, end, label) {

      });
      $('.timerangepicker').on('show.daterangepicker', function(ev, picker) {
        picker.container.find('.calendar-table').hide();
      });
    }
</script>