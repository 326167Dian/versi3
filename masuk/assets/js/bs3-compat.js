$(function () {
    "use strict";

    // AdminLTE Box/Card Collapse Widget Compatibility for Bootstrap 5
    $(document).on('click', '[data-widget="collapse"]', function (e) {
        e.preventDefault();
        var $button = $(this);
        var $box = $button.closest('.box, .card');
        var $boxBody = $box.find('.box-body, .card-body, .box-footer, .card-footer');
        var $icon = $button.find('i');

        if ($box.hasClass('collapsed-box')) {
            $box.removeClass('collapsed-box');
            $boxBody.slideDown();
            $icon.removeClass('fa-plus').addClass('fa-minus');
        } else {
            $box.addClass('collapsed-box');
            $boxBody.slideUp();
            $icon.removeClass('fa-minus').addClass('fa-plus');
        }
    });

    // Check All Feature for Tables
    $(document).on('click', '#check-all', function () {
        var isChecked = $(this).prop('checked');
        $(this).closest('table').find('tbody input[type="checkbox"]').prop('checked', isChecked);
    });

    $(document).on('click', 'tbody input[type="checkbox"]', function () {
        var $table = $(this).closest('table');
        var $checkAll = $table.find('#check-all');
        if ($checkAll.length > 0) {
            var allChecked = $table.find('tbody input[type="checkbox"]').length === $table.find('tbody input[type="checkbox"]:checked').length;
            $checkAll.prop('checked', allChecked);
        }
    });

    // Generic Confirmation Handler (e.g., for Bulk Submit)
    $(document).on('click', '[data-confirm]', function (e) {
        var message = $(this).data('confirm');
        if (!confirm(message)) {
            e.preventDefault();
        }
    });
});