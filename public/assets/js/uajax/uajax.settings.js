var uajax = {
    spinnerHtml: '<div class="spinner-border spinner-border-sm text-light"></div>',
    notificationMessageDisplay: true,
    notificationMessageDefault: 'Successfully completed request',
    notificationMessageObject: 'message',
    notificationMessageHeader: 'uajax-note',
    htmlOnError: true,
    jsonParseErrorSuffix: '<br>Помилка парсингу JSON: зв’яжіться з веб-майстром',


    success: function (jqxhr, form, notificationMessage, displayNotification) {
        // Uncomment next line if you don't want message yourself when using html target
        // if (form.hasAttribute('data-target')) return;

        if (displayNotification) {
            App.success(form, notificationMessage)
        }
    },
    error: function (jqxhr, form, exception) {
        App.errorMessage(jqxhr, exception, form)
    },
    complete: function (jqxhr, form, notificationMessage, displayNotification, exception) {
        console.log('completed');
    },
};
