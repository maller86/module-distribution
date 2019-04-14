/**
 * @api
 */
define([
    'ko',
    'jquery',
    'mage/translate',
    'Magento_Ui/js/form/components/button'
], function (ko, $, $t, Button) {
    'use strict';

    return Button.extend({
        defaults: {
            label: '',
            useLoader: false,
            iconSelector: '*[data-type="check-icon"] .icon',
            checkTpl: 'FjodorMaller_Distribution/form/check-icon',
            restoreMessageTimeout: 8000,
            loadingMessage: $t('Checking, please wait ..'),
            unknownErrorMessage: $t('An unknown error occurred.'),
            buttonTpl: 'Magento_Theme/form/element/button',
            imports: {
                formData: '${ $.provider }:data'
            }
        },

        /**
         * @public
         */
        initObservable: function () {
            this.originalNotice = this.notice;
            this.notice = ko.observable(this.notice);
            return this._super().observe(
                'formData'
            );
        },

        /**
         * @public
         */
        check: function (params) {
            params = JSON.parse(params);
            if (!params.checkUrl) {
                this.notice(this.unknownErrorMessage);
                return;
            }
            $.ajax({
                type: 'post',
                url: params.checkUrl,
                data: $.extend(this.formData(), {
                    'form_key': FORM_KEY
                }),
                dataType: 'json',
                beforeSend: function () {
                    if (this.useLoader) {
                        $('body').trigger('processStart');
                    }
                    this.icon(null);
                    this.notice(this.loadingMessage);
                }.bind(this),
                success: function (response) {
                    if (response.message) {
                        this.icon(!response.error, response.message);
                        this.notice(response.message);
                        return;
                    }
                    this.icon(false, this.unknownErrorMessage);
                    this.notice(this.unknownErrorMessage);
                }.bind(this),
                error: function (XHR, status, error) {
                    this.icon(false, error);
                    this.notice(error);
                }.bind(this),
                complete: function () {
                    if (this.useLoader) {
                        $('body').trigger('processStop');
                    }
                    setTimeout(function () {
                        this.notice(this.originalNotice);
                    }.bind(this), this.restoreMessageTimeout);
                }.bind(this)
            });
        },

        /**
         * @public
         */
        icon: function (status, alt) {
            alt = alt || '';
            let $elem = $(this.iconSelector);
            $elem.removeClass('icon-success icon-failed').hide();
            if (true == status) {
                $elem.addClass('icon-success');
                $elem.show();
            } else if (false == status) {
                $elem.addClass('icon-failed');
                $elem.show();
            }
            if (alt) {
                $elem.attr('alt', alt).attr('title', alt);
            }
        }
    });
});
