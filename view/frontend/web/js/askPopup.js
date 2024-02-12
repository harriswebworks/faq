define([
    'jquery',
    'Magento_Ui/js/modal/modal'
], function($, modal) {
    var options = {
        type: 'popup',
        responsive: true,
        innerScroll: true,
        title: 'Ask a Question',
        buttons: [{
            text: $.mage.__('Close'),
            class: 'action-primary',
            click: function () {
                this.closeModal();
            }
        }]
    };

    var popup = modal(options, $('#popup-modal'));

    $('#open-popup-button').on('click', function() {
        $('#popup-modal').modal('openModal');
    });
});
