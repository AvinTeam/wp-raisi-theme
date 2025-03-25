
jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});


jQuery(document).ready(function ($) {

    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
})

