<script>
    var messages = @json(__('messages'));

    function errorNewsletter(errorIcon, successIcon, loader, text){
        errorIcon.show();
        successIcon.hide();
        loader.hide();
        text.html(messages.error);
    }
    function existsNewsletter(errorIcon, successIcon, loader, text){
        errorIcon.show();
        successIcon.hide();
        loader.hide();
        text.html(messages.already_registred);
    }
    function successNewsletter(successIcon, close, loader, text, errorIcon){
        successIcon.show();
        errorIcon.hide();
        close.show();
        loader.hide();
        text.html(messages.newsletter_success);
    }

    function closeModal(){
        let modal = $('#newsletterModal');
        modal.modal('toggle');
    }

    function submitNewsletter(){
        let modal = $('#newsletterModal');
        let loader = modal.find('.spinner-border');
        let email = $('.footer-newsletter .email').val();
        let errorIcon = modal.find('#error-icon');
        let successIcon = modal.find('#success-icon');
        let text = modal.find('.text');
        let close = modal.find('.close');
        modal.modal('show');
        close.show();

        $.ajax({
            url: '/api/newsletter/submit',
            type: 'POST',
            data: JSON.stringify({
                "email": email,
            }),
            processData: true,
            contentType: 'application/json',
            success: function(data) {
                let status = data.status;
                let message = data.message;

                if(status == 200 && message == 'success'){
                    successNewsletter(successIcon, close, loader, text, errorIcon)
                }

                if(status == 422 && message == 'error'){
                    errorNewsletter(errorIcon, successIcon, loader, text);
                }

                if(status == 422 && message == 'exists'){
                    existsNewsletter(errorIcon, successIcon, loader, text);
                }
            },  
            error: function(jqXHR, textStatus, errorThrown) {
                errorNewsletter(errorIcon, successIcon, loader, text);
            }
        });
    }
</script>