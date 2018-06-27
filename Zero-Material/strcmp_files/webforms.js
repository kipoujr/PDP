(function() {
    if (typeof window.ml_jQuery !== 'undefined') {
        ml_load_libs();
        return;
    }

    if (typeof window.jQuery !== 'undefined') {
        window.ml_jQuery = window.jQuery;

        ml_load_libs();
        return;
    }

    var script_tag = document.createElement('script');
    script_tag.setAttribute("type", "text/javascript");
    script_tag.setAttribute("src", "//cdn.mailerlite.com/ajax/libs/jquery/1.8.3/jquery.min.js");
    script_tag.onload = onJqueryReady;
    script_tag.onreadystatechange = function () {
        if (this.readyState == 'complete' || this.readyState == 'loaded') onJqueryReady();
    };
    document.getElementsByTagName("head")[0].appendChild(script_tag);

    function onJqueryReady() {
        if (typeof window.jQuery !== 'undefined') {
            ml_jQuery = window.jQuery.noConflict(true);
        }

        ml_load_libs();
    }

    function ml_load_libs() {
        var libs = ["//static.mailerlite.com/js/w/ml_jQuery.inputmask.bundle.min.js?v3.3.1"];

        for (var i in libs) {
            if (libs.hasOwnProperty(i)) {
                var script_tag = document.createElement('script');
                script_tag.setAttribute("type", "text/javascript");
                script_tag.setAttribute("src", libs[i]);

                if (i == libs.length - 1) {
                    script_tag.onload = ml_webform_embed;
                    script_tag.onreadystatechange = function () {
                        if (this.readyState == 'complete' || this.readyState == 'loaded') ml_webform_embed();
                    };
                }
                document.getElementsByTagName("head")[0].appendChild(script_tag);
            }
        }
    }

    function ml_webform_embed() {
        ml_jQuery('.ml-subscribe-form form').each(function () {
            var $form = ml_jQuery(this);
            var $wrapper = ml_jQuery(this).closest('.ml-subscribe-form');

            var code = $form.data('code');
            var webform_data = window.webform_data && window.webform_data[code] ? window.webform_data[code] : {};

            var submit_primary = ml_jQuery(this).find('button.primary');
            var submit_loading = ml_jQuery(this).find('button.loading');
            var submit_loading_enabled = submit_loading.length > 0;

            $form.find('.ml-validate-date input').inputmask(undefined, {
                oncomplete: function () {
                    ml_jQuery(this).closest('.ml-validate-date').addClass('ml-validate-date-valid');
                }, onincomplete: function () {
                    ml_jQuery(this).closest('.ml-validate-date').removeClass('ml-validate-date-valid');
                }, oncleared: function () {
                    ml_jQuery(this).closest('.ml-validate-date').removeClass('ml-validate-date-valid');
                }, onKeyValidation: function (result, opts) {
                    ml_jQuery(this).closest('.ml-validate-date').removeClass('ml-validate-date-valid');
                }
            });

            $form.find('.ml-validate-phone input').inputmask(undefined, {
                oncomplete: function () {
                    ml_jQuery(this).closest('.ml-validate-phone').addClass('ml-validate-phone-valid');
                }, onincomplete: function () {
                    ml_jQuery(this).closest('.ml-validate-phone').removeClass('ml-validate-phone-valid');
                }, oncleared: function () {
                    ml_jQuery(this).closest('.ml-validate-phone').removeClass('ml-validate-phone-valid');
                }, onKeyValidation: function (result, opts) {
                    ml_jQuery(this).closest('.ml-validate-phone').removeClass('ml-validate-phone-valid');
                }
            });

            if ($form.data('ml-submit-bound') === undefined || !$form.data('ml-submit-bound')) {
                $form.data('ml-submit-bound', 1);

                $wrapper.find('.ml-block-success').bind('click', function () {
                    $wrapper.find('.ml-block-success').hide();
                    $wrapper.find('.ml-block-form').find('input[type="text"]').val('');
                    var $checkboxes = $wrapper.find('.ml-block-form').find('input[type="checkbox"]');
                    if ($checkboxes.prop !== undefined) {
                        $checkboxes.prop('checked', false);
                    } else {
                        $checkboxes.attr('checked', false);
                    }

                    $wrapper.find('.ml-block-form').show();
                });

                ml_jQuery(":submit", $form).click(function(){
                    $form.find('input[type="hidden"].ml-submit-hidden-value').remove();
                    if(ml_jQuery(this).attr('name')) {
                        $form.append(
                            ml_jQuery('<input type="hidden" class="ml-submit-hidden-value">').attr( {
                                name: ml_jQuery(this).attr('name'),
                                value: ml_jQuery(this).attr('value') })
                        );
                    }
                });

                function doSuccess() {
                    if (typeof window['ml_webform_after_success'] === 'function') {
                        window['ml_webform_after_success']();
                    }

                    var successFnName = 'ml_webform_success_' + $wrapper.attr('id').substr(5);
                    if (typeof window[successFnName] === 'function') {
                        window[successFnName]();
                    } else {
                        $wrapper.find('.ml-block-success').show();
                        $wrapper.find('.ml-block-form').hide();
                    }

                    if (window != window.parent) {
                        window.parent.postMessage('mlWebformSubmitSuccess-' + $wrapper.attr('id').substr(5), "*");
                    }
                }

                //if body has ml-submit-success class - show success immediatelly
                if (ml_jQuery('body').hasClass('ml-submit-success')) {
                    doSuccess();
                }

                $form.bind('submit', function (e) {
                    e.preventDefault();

                    // prevent multi submits
                    if ($form.data('loading')) {
                      return false;
                    }

                    //nuvalom visus error'us
                    $form.find('.ml-error').removeClass('ml-error');

                    if (ml_validate_form($form)) {
                        if (submit_loading_enabled) {
                            submit_primary.hide();
                            submit_loading.show();
                        }

                        var form_data = $form.serialize();
                        form_data = form_data + '&ajax=1';

                        var form_url = $form.attr('action');


                        $form.data('loading', true);
                        ml_jQuery.ajax({
                            type: 'GET',
                            url: form_url,
                            data: form_data,
                            dataType: 'jsonp',
                            success: function (result) {
                                $form.data('loading', false);
                                if (submit_loading_enabled) {
                                    submit_primary.show();
                                    submit_loading.hide();
                                }

                                if (result.success) {
                                    doSuccess();
                                } else {

                                    if (result.errors !== undefined) {
                                        if (result.errors.groups !== undefined && result.errors.groups) {
                                            $form.find('.ml-block-groups').addClass('ml-error');
                                        }
                                        if (result.errors.fields !== undefined && result.errors.fields) {
                                            ml_jQuery.each(result.errors.fields, function (field, value) {
                                                $form.find('.ml-field-' + field).addClass('ml-error');
                                            });
                                        }
                                    }
                                }

                            },
                            error: function (responseData, textStatus, errorThrown) {
                                $form.data('loading', false);
                                if (submit_loading_enabled) {
                                    submit_primary.show();
                                    submit_loading.hide();
                                }

                                //TODO:
                            }
                        });

                    }
                });

                // Track webform view
                var webform_id = $form.attr('data-id');
                var webform_code = $form.attr('data-code');

                if (webform_id) {
                    (new Image()).src = 'https://track.mailerlite.com/webforms/o/' + webform_id + '/' + webform_code + '?v' + Math.floor(Date.now() / 1000);
                }
            }

            if (window != window.parent) {
                ml_jQuery(document).on('click', '.overlay, .ml-subscribe-close', function () {
                    window.parent.postMessage('mlCloseIframe-' + $form.data('code'), "*");
                });

                ml_jQuery('.ml-subscribe-form').bind('click', function (e) {
                    var target = e.target || e.srcElement;
                    if (ml_jQuery(target).is('div.ml-subscribe-close')) {
                        return;
                    }

                    e.stopPropagation();
                });
            }
        });
    }

    function ml_validate_form($form) {
        var form_valid = true;

        $form.find('.ml-validate-required').each(function (index, w) {
            var element_valid = false;
            ml_jQuery(w).find('input[type="text"], input[type="email"], select').each(function (i, v) {
                if (ml_jQuery(v).val() !== undefined && ml_jQuery(v).val() !== '') {
                    element_valid = true;
                }
            });
            ml_jQuery(w).find('input[type="checkbox"]').each(function (i, v) {
                if (ml_jQuery(v).prop !== undefined) {
                    if (ml_jQuery(v).prop('checked')) {
                        element_valid = true;
                    }
                } else {
                    if (ml_jQuery(v).attr('checked')) {
                        element_valid = true;
                    }
                }
            });

            if (!element_valid) {
                ml_jQuery(w).addClass('ml-error');
                form_valid = false;
            }
        });

        $form.find('.ml-validate-email').each(function (index, w) {
            var element_valid = true;
            ml_jQuery(w).find('input[type="text"], input[type="email"]').each(function (i, v) {
                if (ml_jQuery(v).val() !== undefined && ml_jQuery(v).val() !== '' && !ml_valid_email(ml_jQuery(v).val())) {
                    element_valid = false;
                }
            });

            if (!element_valid) {
                ml_jQuery(w).addClass('ml-error');
                form_valid = false;
            }
        });

        $form.find('.ml-validate-date').each(function (index, w) {
            var element_valid = true;
            ml_jQuery(w).find('input[type="text"]').each(function (i, v) {
                if (ml_jQuery(v).val() !== undefined && ml_jQuery(v).val() !== '' && !ml_jQuery(w).hasClass('ml-validate-date-valid')) {
                    element_valid = false;
                }
            });

            if (!element_valid) {
                ml_jQuery(w).addClass('ml-error');
                form_valid = false;
            }
        });

        $form.find('.ml-validate-phone').each(function (index, w) {
            var element_valid = true;
            ml_jQuery(w).find('input[type="text"]').each(function (i, v) {
                if (ml_jQuery(v).val() !== undefined && ml_jQuery(v).val() !== '' && !ml_jQuery(w).hasClass('ml-validate-phone-valid')) {
                    element_valid = false;
                }
            });

            if (!element_valid) {
                ml_jQuery(w).addClass('ml-error');
                form_valid = false;
            }
        });

        return form_valid;
    }

    function ml_valid_email(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]){2,40}$/;
        return regex.test(email.trim());
    }
})();
