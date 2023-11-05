document.addEventListener('click', function (e) {
    if (!e.target.classList.contains('js-ajax-button')) {
        return;
    }
    e.preventDefault();
    const button = e.target;
    if (button.getAttribute('data-confirm') && !confirm(button.getAttribute('data-confirm'))) {
        return;
    }
    const url = button.getAttribute('data-url');
    if (button.disabled) {
        return;
    }
    button.disabled = true;
    postData('post', url, '&_token=' + _csrf+(button.getAttribute('data-adata') || ''), function (data) {
            let notificationMessage;
            try {
                data = JSON.parse(data);
                notificationMessage = data.message || 'Successfully completed request';
            } catch (error) {
                notificationMessage = (data.message || 'Successfully completed request') + '<br>Can\'t parse JSON: contact webmaster';
            }
            App.success(button, data.message || 'Successfully completed request');
            button.disabled = false;
            if (button.getAttribute('data-refresh')) {
                location.reload();
            }
            if (button.getAttribute('data-redirect')) {
                window.location = button.getAttribute('data-redirect');
            }
            if (button.getAttribute('data-toggle-hidden')) {
                document.querySelectorAll(button.getAttribute('data-toggle-hidden')).forEach(function (el) {
                    el.hidden = !el.hidden;
                });
            }
            if (button.getAttribute('data-remove-target')) {
                document.querySelector(button.getAttribute('data-remove-target')).remove();
            }
            if (button.getAttribute('data-autohide')) {
                button.hidden = true;
            }
        },
        function (xhr, exception) {
            button.disabled = false;
            App.errorToast(xhr, exception)
        })
});
