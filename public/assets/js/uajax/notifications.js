var App = {};
App.success = function (form, message, title) {
    b5toast.success(message, title);
};

App.error = function (form, message, title) {
    b5alert.error(form, message, title);
};
App.alertLogin = function () {
    window.location.href = "https://kinobaza.com.ua/login";
};

commentSuccess = function(xhr, form, message, exception) {
    form.querySelector('textarea').value='';
    const closest = form.closest('.comment-wrapper');
    if (closest) {
        closest.after(b5toast.htmlToElement(xhr.response));
    } else {
        form.before(b5toast.htmlToElement(xhr.response));
    }
}

App.errorMessage = function (xhr, exception, form) {
    App.error(form, App.getErrorMessage(xhr, exception));
};

App.errorToast = function (xhr, exception) {
    b5toast.error(App.getErrorMessage(xhr, exception));
};

App.getErrorMessage = function (xhr, exception) {
    const contentType = xhr.getResponseHeader('content-type');
    if (contentType && contentType.indexOf('application/json') !== -1) {
        const obj = JSON.parse(xhr.responseText);
        if (obj.error) {
            return 'Помилка<br>'+obj.error;
        }
        if (obj.errors) {
            let message ='<ul>';
            const keys = Object.keys(obj.errors);
            for (let i = 0; i < keys.length; i++) {
                message += '<li>'+obj.errors[keys[i]]+'</li>';
            }
            message += '</ul>'
            return 'Помилковий запит<br>' + message;
        }
    }

    if (xhr.status === 0) {
        return 'Помилка сервера<br>Не вдається підключитися до сервера. Будь ласка, перевірте підключення до мережі';
    } else if (xhr.status === 400) {
        return 'Помилковий запит';
    } else if (xhr.status === 401) {
        window.location.assign('/login');
        return '';
    } else if (xhr.status === 403) {
        return 'У вас нема прав для дії над цим ресурсом!';
    } else if (xhr.status === 404) {
        return 'От халепа! 404<br>Запитувана сторінка не знайдена';
    } else if (xhr.status === 405) {
        return ' 405 Method Not Allowed ';
    } else if (xhr.status === 422) {
        return 'Помилковий запит';
    } else if (exception === 'parsererror') {
        return 'От халепа :(<br>Неможливо розпізнати відповідь';
    } else if (exception === 'timeout') {
        return 'От халепа :(<br>Час очікування відповіді вийшов';
    } else if (exception === 'abort') {
        return 'От халепа :(<br>Запит перерваний';
    } else {
        return 'От халепа :(<br>Невідома помилка!';
    }
}