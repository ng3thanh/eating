var Setting = function () {

    function changeSelect() {
        $('select').on('change', function() {
            var str = this.id;
            var value = 'fa fa-fw fa-' + this.value;
            var idChange = str.split('_')[1];
            $("#fa_" + idChange).removeClass().addClass(value);
        })
    }

    /**
     * Set function
     */
    function init() {
        changeSelect();
    }

    return {
        init: init
    };
}();