function showToast() {
    let options = {
        showHideTransition: 'fade',
        allowToastClose: true,
        hideAfter: 4000,
        stack: 5,
        position: 'top-center',
        textAlign: 'left',
        loader: true,
        loaderBg: '#9EC600',
        text: '',
        icon: ''
    };

    $(toastErrors).each(function(idx, errorText) {
        options.text = errorText;
        options.icon = 'error';
        $.toast(options);
    });
    $(toastMessages).each(function(idx, messageText) {
        options.text = messageText;
        options.icon = 'info';
        $.toast(options);
    });
    $(toastSuccess).each(function(idx, successText) {
        options.text = successText;
        options.icon = 'success';
        $.toast(options);
    });
}


function initDataTables()
{
    let options = {
        scrollX: true,
        dom: 'lBfrtip',
        buttons: [ 'copy', 'excel', 'pdf' ],
        columnDefs: [ { targets: 'no-sort', orderable: false } ],
        order: [],
        pageLength: 50,
        language: { url: dataTableTranslate }
    };

    let table = $('.tableDT').DataTable(options);
    table.buttons().container().appendTo(
        $('.col-sm-6:eq(0)', table.table().container() )
    );

    $('.table-clickable tbody').on('click', 'tr', function () {
        let dataFunction = $(this).attr('data-function');
        if(dataFunction && typeof window[dataFunction] === "function") {
            window[dataFunction](
                $(this).attr('data-id')
            );

            return true;
        }

        let dataUrl = $(this).attr('data-url');
        if(dataUrl !== null && dataUrl != '') {
            document.location = dataUrl;
        }
    } );
}


function initConfirm()
{
    $('[data-toggle="confirm"]').jConfirm({
        question: jsConfirmMessage,
        confirm_text: jsConfirmYes,
        deny_text: jsConfirmNo
    }).on('confirm', function(e){
        var btn = $(this);
        document.location = btn.attr('href');
        console.log(btn.attr('href'));
    }).on('deny', function(e){
        return false;
    });
}


function initFormValidate()
{
    $('button[form-validate]').each(function(idx, elm) {
        $(elm).on('click', function() {

            let frm = $('#' + $(this).attr('form-validate'));
            if(frm.hasClass('form-field-check')) {
                let frmOk = true;
                frm.find('.field-check').each(function(idx, elm) {
                    if($(elm).val() == '') {
                        frmOk = false;
                    }
                });

                if(frmOk == true) {
                    frm.submit();
                } else {
                    alertMessage('error', alertRefFieldsMandatory);
                }
            } else {
                frm.submit();
            }
        });
    });
}

function initFormCheck() {
    $('.field-check').on('keyup', formCheck).on('change', formCheck);
    formCheck();
}


function formCheck() {
    $('.form-field-check').each(function(idx, frm) {
        $(frm).find('.field-check').each(function(idx, elm) {
            if($(elm).val() == '') {
                $(elm).removeClass('fieldCheckOk').addClass('fieldCheckKo');
            } else {
                $(elm).removeClass('fieldCheckKo').addClass('fieldCheckOk');
            }
        });
    });
}


function initMultiSelect()
{
    $('.multiselect').multiselect({
        nonSelectedText: multiSelectNonSelectedText,
        nSelectedText: multiSelectNSelectedText,
        allSelectedText: multiSelectAllSelectedText,
    }).on('change', function(option, checked) {
        if($(this).find('option:selected').length == 0) {
            $(option.currentTarget.offsetParent).removeClass('fieldCheckOk').addClass('fieldCheckKo');
        } else {
            $(option.currentTarget.offsetParent).removeClass('fieldCheckKo').addClass('fieldCheckOk');
        }
    });

    $('.multiselect').each(function(idx, select) {
        let count = $(this).find('option:selected').length;
        if($(select.offsetParent).hasClass('multiselect-native-select')) {
            if(count == 0) {
                $(select.offsetParent).removeClass('fieldCheckOk').addClass('fieldCheckKo');
            } else {
                $(select.offsetParent).removeClass('fieldCheckKo').addClass('fieldCheckOk');
            }
        }
    });
}

function initSummerNote() {
    $('.summernote').each(function(idx, elm) {
        let height = $(elm).attr('height') || '200px';
        $(this).summernote({
            height: height,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']]
              ]
        });
    });
}


function alertMessage(type, message) {
    let alertIcon = $('#alertModal').find('.alertIcon');
    alertIcon.removeClass('icofont-exclamation-tringle').removeClass('icofont-comment');
    alertIcon.removeClass('alertIconError').removeClass('alertIconMessage');

    if(type == 'error') {
        alertIcon.addClass('icofont-exclamation-tringle').addClass('alertIconError');
    } else {
        alertIcon.addClass('icofont-comment').addClass('alertIconMessage');
    }

    $('#alertModal').find('.alertContent').html(message);
    $('#alertModal').modal('show');
}

function fixContentHeight() {
    let height = $('#pageContent').offset().top;
    $('#pageContent').css('height', "calc(100vh - "+height+"px)");

    $(window).on('resize', function() {
        let height = $('#pageContent').offset().top;
        $('#pageContent').css('height', "calc(100vh - "+height+"px)");
    });
}
