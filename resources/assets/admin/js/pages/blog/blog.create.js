var BlogCreate = function () {
    var datepicker = $('.datepicker');

    function setupDatepicker() {
        datepicker.datepicker({ autoclose: true });
    }

    /**
     * Set function
     */
    function init() {
        setupDatepicker();
    }

    return {
        init: init
    };
}();