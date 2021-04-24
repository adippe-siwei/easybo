jQuery(function() {
    showToast();
    initDataTables();
    initMultiSelect();
    initConfirm();
    initFormValidate();
    initFormCheck();
    fixContentHeight();
    initSummerNote();

    $('.tooltiped').tooltip();


    $('input[type="checkbox"]').on('click', function(event) {
        event.stopPropagation();
    })
});
