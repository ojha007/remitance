!(function ($) {
    "use strict";

    $('form.contact_us_form').submit(function (e) {
        e.preventDefault();
        let element = $(this).find('.form-group');
        let errors = false;
        errors = validationCases(element, 'textarea');
        errors = validationCases(element, 'input');
        if(errors) return false;
        $(this).find('.sent-message').slideUp();
        $(this).find('.error-message').slideUp();
        $(this).find('.loading').slideDown();
        contactUS($(this),  $(this).serialize());
        return true;
    });

    function contactUS(form,data) {
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: data,
            timeout: 40000
        }).done(function (msg) {
            // if (msg.trim() == 'OK') {
            //     form.find('.loading').slideUp();
            //     form.find('.sent-message').slideDown();
            //     this_form.find("input:not(input[type=submit]), textarea").val('');
            // } else {
            //     this_form.find('.loading').slideUp();
            //     if (!msg) {
            //         msg = 'Form submission failed and no error message returned from: ' + action + '<br>';
            //     }
            //     this_form.find('.error-message').slideDown().html(msg);
            // }
        }).fail(function (data) {
            console.log(data);
            let error_msg = "Form submission failed!<br>";
            if (data.statusText || data.status) {
                error_msg += 'Status:';
                if (data.statusText) {
                    error_msg += ' ' + data.statusText;
                }
                if (data.status) {
                    error_msg += ' ' + data.status;
                }
                error_msg += '<br>';
            }
            if (data.responseText) {
                error_msg += data.responseText;
            }
            form.find('.loading').slideUp();
            form.find('.error-message').slideDown().html(error_msg);
        });
    }

    function validationCases(element, field) {
        let fErrors = false;
        let iErrors = false;
        let emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
        element.children(field).each(function () {
            let rule = $(this).attr('data-rule');
            let exp;

            if (rule !== undefined) {
                let pos = rule.indexOf(':', 0);
                if (pos >= 0) {
                    exp = rule.substr(pos + 1, rule.length);
                    rule = rule.substr(0, pos);
                } else {
                    rule = rule.substr(pos + 1, rule.length);
                }
                switch (rule) {
                    case 'required':
                        if ($(this).val() === '')
                            fErrors = iErrors = true;
                        break;
                    case 'minLen':
                        if ($(this).val().length < parseInt(exp)) {
                            fErrors = iErrors = true;
                        }
                        break;
                    case 'email':
                        if (!emailExp.test($(this).val())) {
                            fErrors = iErrors = true;
                        }
                        break;

                }
                $(this).next('.validate').html((iErrors ?
                    ($(this).attr('data-msg') != undefined ?
                        $(this).attr('data-msg') : 'wrong Input') : ''))
                    .show('blind');
            }
        });
        return fErrors;
    }

})(jQuery);


