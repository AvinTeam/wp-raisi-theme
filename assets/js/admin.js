
jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});


jQuery(document).ready(function ($) {

    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });



    // انتخاب تصویر از گالری
    $(document).on('click', '.upload-menu-image', function (e) {
        e.preventDefault();
        var button = $(this);
        var menuItemId = button.data('menu-item-id');
        var container = button.closest('.field-image');
        var preview = container.find('.menu-item-image-preview');
        var imageInput = container.find('.edit-menu-item-image');

        var mediaUploader = wp.media({
            title: 'انتخاب تصویر برای منو',
            button: { text: 'استفاده از این تصویر' },
            multiple: false
        });

        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            imageInput.val(attachment.id);
            preview.find('img').attr('src', attachment.url);
            preview.show();
        });

        mediaUploader.open();
    });

    // حذف تصویر
    $(document).on('click', '.remove-menu-image', function (e) {
        e.preventDefault();
        var button = $(this);
        var menuItemId = button.data('menu-item-id');
        var container = button.closest('.field-image');
        var preview = container.find('.menu-item-image-preview');
        var imageInput = container.find('.edit-menu-item-image');

        imageInput.val('');
        preview.hide().find('img').attr('src', '');
    });


})

