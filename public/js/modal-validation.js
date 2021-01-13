$("document").ready(function () {
    // Prepare reset.
    function resetModalFormErrors() {
        let form_group = $(".form-group");
        form_group.removeClass("has-error");
        form_group.find('input').removeClass('is-invalid');
        form_group.find('select').removeClass('is-invalid');
        form_group.find(".help-block").remove();
    }

    // Intercept submit.
    $("form.bootstrap-modal-form").on("submit", function (submission) {
        submission.preventDefault();
        // Set vars.
        var form = $(this),
            url = form.attr("action"),
            submit = form.find("[type=submit]");
        // Check for file inputs.

        if (form.find("[type=file]").length) {
            // If found, prepare submission via FormData object.
            var input = form.serializeArray(),
                data = new FormData(),
                contentType = false;

            // Append input to FormData object.
            $.each(input, function (index, input) {
                data.append(input.name, input.value);
            });

            // Append files to FormData object.
            $.each(form.find("[type=file]"), function (index, input) {
                if (input.files.length == 1) {
                    data.append(input.name, input.files[0]);
                } else if (input.files.length > 1) {
                    data.append(input.name, input.files);
                }
            });
        }
        // If no file input found, do not use FormData object (better browser compatibility).
        else {
            var data = form.serialize(),
                contentType = "application/x-www-form-urlencoded; charset=UTF-8";
        }

        // Please wait.
        if (submit.is("button")) {
            var submitOriginal = submit.html();
            submit.attr("disabled", "disabled");
            submit.html("<i class='fa fa-refresh fa-spin'></i>&nbsp;Please wait");
        } else if (submit.is("input")) {
            var submitOriginal = submit.val();
            submit.val("Please wait...");
        }

        // Request.
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            cache: false,
            contentType: contentType,
            processData: false
            // Responses.
        }).always(function (response) {
            // Reset errors.

            resetModalFormErrors();
            let modal = $(".bootstrap-modal-form");
            if (response.status === 201) {
                modal.closest(".modal").modal("hide");
                if (submit.is("button")) {
                    submit.removeAttr("disabled");
                    submit.html(submitOriginal);
                } else if (submit.is("input")) {
                    submit.val(submitOriginal);
                }
                modal.trigger("reset");
                let a = modal.find('input[name="reload"]');
                if (a.length === 0) {
                    window.location.reload();
                } else {
                    if ($(response.select).length) {
                        let data = response['options'];
                        $(response.select).find('option[value !=""]').remove();
                        $.each(data, function (value, text) {
                            $(response.select).append($('<option/>', {
                                value: value,
                                text: text
                            }));
                        });
                        $(response.select).val(response['id']).trigger('change');
                    }
                }
            }
            // Check for errors.
            if (response.status === 422) {
                var errors = $.parseJSON(response.responseText).errors;
                // Iterate through errors object.

                $.each(errors, function (field, message) {
                    // $(".bootstrap-modal-form").find($.attr("autofocus")).focus();
                    //handle arrays
                    if (field.indexOf('.') != -1) {
                        field = field.replace('.', '[');
                        //handle multi dimensional array
                        for (i = 1; i <= (field.match(/./g) || []).length; i++) {
                            field = field.replace(".", '][');
                        }
                        field = field + "]";
                    }
                    var fieldElement = $('[name="' + field + '"]', form);
                    if (fieldElement.length > 0) {
                        var formGroup = fieldElement.closest('.form-group');
                        fieldElement.addClass('is-invalid')
                        if (fieldElement.attr('type') === 'hidden') {
                            fieldElement.parent().append('<div class="col-md-12 col-md-offset-2">' +
                                '<p class="help-block">' + message + '</p>' +
                                '</div>');
                        } else {
                            if (fieldElement.parent().hasClass('input-group'))
                                fieldElement.parent('.input-group').parent().append('<p class="help-block text-danger">' + message + '</p>');
                            else
                                fieldElement.parent().append('<p class="help-block text-danger">' + message + '</p>');
                        }
                    } else {
                        var fieldElement = form.find('label[for=' + field + ']');
                        var formGroup = fieldElement.closest('.form-group');
                        if (fieldElement.siblings().hasClass('input-group'))
                            fieldElement.siblings('.input-group').parent().append('<p class="help-block text-danger">' + message + '</p>');
                        else
                            fieldElement.siblings().append('<p class="help-block text-danger">' + message + '</p>');
                    }
                    formGroup.addClass("has-error");
                    var currentForm = modal.find(".has-error");
                    if (currentForm.length > 0) {
                        let a = $(".bootstrap-modal-form").find(".has-error:first").find("input");
                        if (!a.hasClass('datePicker')) {
                            a.focus();
                            currentForm.animate({scrollTop: 0}, "slow");
                        }

                    }
                });

                // Reset submit.
                if (submit.is("button")) {
                    submit.removeAttr("disabled");
                    submit.html(submitOriginal);
                } else if (submit.is("input")) {
                    submit.val(submitOriginal);
                }

                // If successful, reload.
            }
        });
    });

// Reset errors when opening modal.
    $('.bootstrap-modal-form-open').click(function () {
        resetModalFormErrors();
    });
    $('.modal').on('hide.bs.modal', function () {
        resetModalFormErrors();
    })

});
