define([
        'jquery',
        'Magento_Ui/js/modal/modal'
    ],
    function($, modal) {
        "use strict";
        $.widget('amida.oneClickBuy', {
            _create: function () {
                let $widget = this;
                if (undefined !== $widget.options.urlAjax) {
                    let urlAjax = $widget.options.urlAjax,
                        productSku = $widget.options.productSku,
                        formSelector = '#form-one-click-buy',
                        phoneInputSelector = '.one-click-buy-phone',
                        thanksSelector = '#buy-one-click-modal-thanks',
                        errorSelector = '#buy-one-click-modal-error',
                        modalContentSelector = '#buy-one-click-modal-content',
                        options = {
                        type: 'popup',
                        responsive: true,
                        innerScroll: true,
                        title: $widget.options.title,
                        clickableOverlay: true,
                        buttons: [{
                            text: $.mage.__('Submit'),
                            class: 'buy-one-click-submit-button',
                            click: function () {
                                $.ajax({
                                    type: 'post',
                                    url: urlAjax,
                                    data: {
                                        product_sku: productSku,
                                        phone_number: $(phoneInputSelector).val()
                                    },
                                    dataType: 'json',
                                    success: function (res) {
                                        $(formSelector).hide();
                                        $(thanksSelector).show();
                                        $('.buy-one-click-submit-button').prop('disabled', true);
                                    },
                                    error: function (res) {
                                        $(formSelector).hide();
                                        $(errorSelector).show();
                                        console.log('ajax.error');
                                        console.log(res);
                                    },
                                });
                                setTimeout(() => {
                                    $(modalContentSelector).modal('closeModal');
                                }, 2000);
                            },
                        }]
                    };

                    modal(options, $(modalContentSelector));

                    $(document).on("click", "#buy-one-click-modal-button", function () {
                        $(modalContentSelector).modal('openModal');
                    });
                }
            }
        });

        return $.amida.oneClickBuy;
    });
