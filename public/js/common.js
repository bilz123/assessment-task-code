let isAjaxFormProcessing = false;

function toastMessage(message = '', status = 'error', isToast = true) {
    status = status == 'error' ? status : 'success';

    if (message == '') message = status == 'error' ?
        'Something went wrong.' :
        'The action was successful.';

    let options = isToast
        ? {
            icon: status,
            title: message,
            showConfirmButton: false,
            confirmButtonColor: '#6576ff',
            toast: true,
            position: 'bottom-end',
            timer: 5000,
            timerProgressBar: true,
            grow: 'fullscreen',
        }
        : {
            icon: status,
            title: message,
            position: 'center',
        }

    window.swal.fire(options);
}

function appendNotification(url, title, body, time) {
    $('#no-notifications').remove();

    $('.nk-notification').prepend(`
        <a href="${url}" class="nk-notification-item dropdown-inner">
            <div class="nk-notification-icon">
                <em class="icon icon-circle bg-danger-dim ni ni-notice"></em>
            </div>
            <div class="nk-notification-content">
                <div class="nk-notification-text">${body}</div>
                <div class="nk-notification-time">${time}</div>
            </div>
        </a>
    `);

    $('#notifications').hide();
    $('#new-notifications').show();

    NioApp.Toast(title, body, 'info', {
        timeOut: 7000,
        positionClass: 'toast-bottom-left',
        preventDuplicates: false,
    });

    $('#notifications-dt').DataTable().ajax.reload();
}

function initImagePicker($targetElement) {
    let picker = $targetElement ?? $('[image-picker]'),
        imageElement = picker.find('img'),
        defaultImage = imageElement.attr('src'),
        initialsElement = picker.find('.user-avatar').find('span'),
        pickBtn = picker.find('a'),
        pickBtnDefaultText = picker.find('a').text(),
        submitBtn = picker.closest('form').find('[type="submit"]'),
        toggleSubmitBtn = picker.data('toggle-submit-btn') !== 'undefined' && picker.data('toggle-submit-btn'),
        maxSize = typeof picker.data('max-size') !== undefined && picker.data('max-size') > 0
            ? picker.data('max-size')
            : 1000000; // 1000000 Bytes = 1 MB

    picker.on('change', 'input', function () {
        const fileInput = $(this);

        if (this.files && this.files[0]) {
            if (this.files[0].size > maxSize) {
                toastMessage(`The selected image must be less then ${maxSize / 1000000} MB.`, 'error', false);
                return;
            }

            let reader = new FileReader();

            reader.onload = function (e) {
                imageElement.attr('src', e.target.result).show();
            }

            reader.readAsDataURL(this.files[0]);

            pickBtn.text(fileInput.val().split('\\').pop());

            if (initialsElement.length > 0) initialsElement.hide();
            if (toggleSubmitBtn) submitBtn.slideDown();
        } else {
            if (initialsElement.length > 0 && defaultImage.length <= 0) {
                imageElement.hide();
                initialsElement.show();
            } else {
                imageElement.attr('src', defaultImage).show();
                initialsElement.hide();
            }

            pickBtn.text(pickBtnDefaultText);
            if (toggleSubmitBtn) submitBtn.slideUp();
        }
    });

    pickBtn.on('click', function () {
        picker.find('input').trigger('click');
    });
}

function sendAjaxForm(form) {
    const _self = $(form);
    const btn = _self.find('[type=submit]');
    const btnHtml = btn.html();
    const modal = _self.data('modal');
    const dt = _self.data('datatable');
    const reload = _self.data('reload');
    const redirect = _self.data('redirect');
    const resetForm = _self.data('reset-form');
    const eventName = _self.data('event');

    _self.find('input').removeClass('is-invalid').siblings('.invalid-feedback').text('').hide();

    btn.attr('disabled', 'disabled');
    btn.html(`<span class="spinner-border spinner-border-sm"></span>&nbsp;&nbsp;<span>${btnHtml}</span>`);

    isAjaxFormProcessing = true;

    window.axios({
        url: _self.attr('action'),
        method: _self.attr('method'),
        data: new FormData(_self[0]),
    })
        .then(response => {
            if (modal !== '') $(modal).modal('hide');
            if (dt !== '') $(dt).DataTable().ajax.reload();
            if (resetForm) _self.trigger('reset');

            if (eventName) {
                let params = typeof response.data.params !== 'undefined'
                    ? [_self.attr('action'), response.data.params]
                    : [_self.attr('action')];

                $(document).trigger(eventName, params);
            }

            if (typeof response.data.message !== 'undefined') {
                toastMessage(response.data.message, 'success');
            } else {
                toastMessage(response.data, 'success');
            }
            if (reload) window.location.reload();
            if (redirect) window.location = redirect;
        })
        .catch(error => {
            console.error(error);

            if (typeof error == 'object') {
                let response = error.response;

                if (typeof response.data == 'string') {
                    toastMessage(response.data.replace(/<[^>]*>?/gm, ''), 'error', false);
                    return;
                }

                else if (typeof response.data.errors !== 'undefined') {
                    for (let key in response.data.errors) {
                        if (_self.find(`[name="${key}"]`).siblings('.invalid-feedback').length > 0) {
                            _self.find(`[name="${key}"]`).addClass('is-invalid')
                                .siblings('.invalid-feedback').text(response.data.errors[key][0]).show();
                        } else {
                            toastMessage(response.data.errors[key][0], 'error', false);
                        }
                    }

                    return;
                }

                else if (typeof response.data.message !== 'undefined') {
                    toastMessage(response.data.message.replace(/<[^>]*>?/gm, ''), 'error', false);
                }

                else {
                    toastMessage('Oops! it seems like something is not right.', 'error', false);
                }

            } else {
                toastMessage(error, 'error', false);
            }
        })
        .finally(response => {
            btn.removeAttr('disabled');
            btn.html(btnHtml);
            isAjaxFormProcessing = false;
        });
}

$(function () {
    $(document).find('.select2').each(function (index, element) {
        $(element).select2({
            format: 'd-M-yyyy',
            autoclose: true,
            placeholder: $(element).attr('placeholder') ?? 'Choose an option'
        });
    });

    $(document).find('.datepicker').datepicker({
        format: 'd-M-yyyy',
        autoclose: true,
    });
});

$(document).on('mouseenter', '.swal2-container', function () {
    window.swal.stopTimer();
});

$(document).on('mouseleave', '.swal2-container', function () {
    window.swal.resumeTimer();
});

$(document).on('init.dt', function (e, settings) {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).on('click', 'a[delete-btn]', function (e) {
    e.preventDefault();

    const _self = $(this);
    const url = _self.attr('href');
    const dt = _self.data('datatable');
    const reload = _self.data('reload');

    window.swal.fire({
        title: 'Are you sure?',
        text: 'You want to delete this record',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#e85347',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (!result.value) return;

        window.swal.fire({
            title: '',
            text: 'Please wait...',
            showConfirmButton: false,
            backdrop: true
        });

        window.axios.delete(url).then(response => {
            if (dt !== '') $(dt).DataTable().ajax.reload();

            if (typeof response.data.message !== 'undefined') {
                toastMessage(response.data.message, 'success');
            } else {
                toastMessage(response.data, 'success');
            }

            if (reload) window.location.reload();
        }).catch(error => {
            window.swal.close();
            toastMessage(error.response.data.message, 'error');
        });
    });
});

$(document).on('click', '[modal-close]', function () {
    if (!isAjaxFormProcessing) $('#ajax-modal').modal('hide');
});

$(document).on('ajaxmodal.loaded', function () {
    let _self = $(this);
    let ajaxmodal = $('#ajax-modal');

    ajaxmodal.find('.select2').select2({
        dropdownParent: ajaxmodal
    });

    _self.find('.datepicker').datepicker({
        format: 'd-M-yyyy',
        autoclose: true,
    });

    ajaxmodal.on('change', '.custom-file-input', function () {
        $(this).next('.custom-file-label').html(
            $(this).val() ? $(this).val().split('\\').pop() : 'Choose a file'
        );
    });

    ajaxmodal.find('.dropzone').each(function (i, e) {
        let $e = $(e);
        $e.dropzone({
            autoProcessQueue: $e.data('autoprocess'),
            url: $e.data('url'),
            method: 'post',
            maxFiles: $e.data('max-files') ?? 1,
            maxFilesize: $e.data('max-size') ?? 2,
            addRemoveLinks: true,
            acceptedFiles: $e.data('file-types') ?? '',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    if (ajaxmodal.find('[image-picker]').length > 0) {
        initImagePicker($(ajaxmodal.find('[image-picker]')));
    }
});

$('body').on('click', 'a[ajax-modal]', function (e) {
  
    e.preventDefault();

    const _self = $(this);
    const ajaxModal = $('#ajax-modal');

    const content = ajaxModal.find('#content');
    const spinner = ajaxModal.find('#spinner');

    content.hide();
    spinner.show();

    ajaxModal.modal({ backdrop: 'static' });

    window.axios({
        method: _self.data('method') ?? 'get',
        url: _self.attr('href')
    })
        .then(response => {
            spinner.hide();

            if (response.status === 200) content.html(response.data).show();
            else toastMessage();

            $(document).trigger('ajaxmodal.loaded');
        }).catch(error => {
            spinner.hide();
            toastMessage(error.response.data.message);
        });
});

$('body').on('submit', 'form[ajax-form]', function (e) {
    e.preventDefault();

    const form = this;
    const confirm = $(form).data('confirm');
    const confirmMessage = $(form).data('confirm-message');

    if (confirm == 'yes') {
        window.swal.fire({
            title: 'Are you sure?',
            text: confirmMessage ?? 'Do you really want to submit this form?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!'
        }).then((result) => {
            if (result.value) sendAjaxForm(form);
        });
    } else {
        sendAjaxForm(form);
    }
});
