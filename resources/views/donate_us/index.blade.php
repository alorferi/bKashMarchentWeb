<x-guest-layout>

    <div class="elementor-widget-container">

        <div class="elementor-shortcode">
            <div class="gf_browser_chrome gform_wrapper gravity-theme gform-theme--no-framework"
                data-form-theme="gravity-theme" data-form-index="0" id="gform_wrapper_1">
                <div class="gform_heading">
                    <h2 class="gform_title">Become a Regular Donor</h2>
                    <p class="gform_description"></p>
                </div>
                <form method="post" enctype="multipart/form-data" id="gform_1" action="/test-donate-form/"
                    data-formid="1" novalidate="">
                    <div class="gform-body gform_body">
                        <div id="gform_fields_1" class="gform_fields top_label form_sublabel_below description_below">
                            <div id="field_1_22"
                                class="gfield gfield--type-section gsection field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
                                data-js-reload="field_1_22">
                                <h3 class="gsection_title"></h3>
                            </div>
                            <fieldset id="field_1_6"
                                class="gfield gfield--type-product gfield--type-choice gfield--input-type-radio gfield--width-full gfield_price gfield_price_1_6 gfield_product_1_6 gfield_contains_required field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
                                data-js-reload="field_1_6">
                                <legend class="gfield_label gform-field-label">Daily Donation Amount :<span
                                        class="gfield_required"><span
                                            class="gfield_required gfield_required_text">(Required)</span></span>
                                </legend>
                                <div class="ginput_container ginput_container_radio">
                                    <div class="gfield_radio" id="input_1_6">



                                        @foreach ($paymentAmounts as $amount)
                                            <div class="gchoice gchoice_1_6_0">
                                                <input class="gfield-choice-input" name="input_6" type="radio"
                                                    value="{{ $amount->amount }}" id="choice_1_6_0"
                                                    onchange="gformToggleRadioOther( this )">
                                                <label for="choice_1_6_0" id="label_1_6_0"
                                                    class="gform-field-label gform-field-label--type-inline">{{ $amount->amount }} {{ $amount->currency }}</label>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </fieldset>
                            <div id="field_1_13"
                                class="gfield gfield--type-select gfield--width-full gfield_contains_required field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
                                data-js-reload="field_1_13"><label class="gfield_label gform-field-label"
                                    for="input_1_13">Select Donation Type:<span class="gfield_required"><span
                                            class="gfield_required gfield_required_text">(Required)</span></span></label>
                                <div class="ginput_container ginput_container_select">

                                    <select name="input_13" id="input_1_13" class="large gfield_select"
                                        aria-required="true" aria-invalid="false">

                                        @foreach ($paymentCycles as $paymentCycle)
                                            <option>
                                                {{ $paymentCycle->merchant_display_name ?? $paymentCycle->display_name }}
                                            </option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                            <div class="spacer gfield" style="grid-column: span 5;"></div>
                            <fieldset id="field_1_18"
                                class="gfield gfield--type-post_custom_field gfield--type-choice gfield--input-type-checkbox gfield--width-full field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
                                data-js-reload="field_1_18">
                                <legend class="gfield_label gform-field-label gfield_label_before_complex">Choose your
                                    preferred donation sector :</legend>
                                <div class="ginput_container ginput_container_checkbox">
                                    <div class="gfield_checkbox" id="input_1_18">


                                        @foreach ($paymentSectors as $paymentSector)
                                            <div class="gchoice gchoice_1_18_1">
                                                <input class="gfield-choice-input" name="input_18.1" type="checkbox"
                                                    value="General Donation" id="choice_1_18_1">
                                                <label for="choice_1_18_1" id="label_1_18_1"
                                                    class="gform-field-label gform-field-label--type-inline">
                                                    {{ $paymentSector->name }}
                                                </label>
                                            </div>
                                        @endforeach




                                    </div>
                                </div>
                            </fieldset>
                            <div id="field_1_4"
                                class="gfield gfield--type-text gfield--width-seven-twelfths field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
                                data-js-reload="field_1_4"><label class="gfield_label gform-field-label"
                                    for="input_1_4">Name</label>
                                <div class="ginput_container ginput_container_text"><input name="input_4" id="input_1_4"
                                        type="text" value="" class="large" aria-invalid="false"> </div>
                            </div>
                            <div class="spacer gfield" style="grid-column: span 5;"></div>
                            <div id="field_1_5"
                                class="gfield gfield--type-email gfield--width-seven-twelfths gfield_contains_required field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
                                data-js-reload="field_1_5"><label class="gfield_label gform-field-label"
                                    for="input_1_5">Email/Phone<span class="gfield_required"><span
                                            class="gfield_required gfield_required_text">(Required)</span></span></label>
                                <div class="ginput_container ginput_container_email">
                                    <input name="input_5" id="input_1_5" type="email" value="" class="large"
                                        aria-required="true" aria-invalid="false">
                                </div>
                            </div>
                            <div class="spacer gfield" style="grid-column: span 5;"></div>
                            <div id="field_1_9"
                                class="gfield gfield--type-total gfield--width-full gfield_price gfield_price_1_ gfield_total gfield_total_1_ field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
                                aria-atomic="true" aria-live="polite" data-js-reload="field_1_9"><label
                                    class="gfield_label gform-field-label" for="input_1_9">Total</label>
                                <div class="ginput_container ginput_container_total">
                                    <input type="text" readonly="" name="input_9" id="input_1_9"
                                        value="৳ 0.00" class="gform-text-input-reset ginput_total ginput_total_1">
                                </div>
                            </div>
                            <div id="field_1_23"
                                class="gfield gfield--type-section gsection field_sublabel_below gfield--no-description field_description_below gfield_visibility_visible"
                                data-js-reload="field_1_23">
                                <h3 class="gsection_title"></h3>
                            </div>
                        </div>
                    </div>
                    <div class="gform_footer top_label"> <input type="submit" id="gform_submit_button_1"
                            class="gform_button button" value="Donate"
                            onclick="if(window[&quot;gf_submitting_1&quot;]){return false;}  if( !jQuery(&quot;#gform_1&quot;)[0].checkValidity || jQuery(&quot;#gform_1&quot;)[0].checkValidity()){window[&quot;gf_submitting_1&quot;]=true;}  "
                            onkeypress="if( event.keyCode == 13 ){ if(window[&quot;gf_submitting_1&quot;]){return false;} if( !jQuery(&quot;#gform_1&quot;)[0].checkValidity || jQuery(&quot;#gform_1&quot;)[0].checkValidity()){window[&quot;gf_submitting_1&quot;]=true;}  jQuery(&quot;#gform_1&quot;).trigger(&quot;submit&quot;,[true]); }">
                        <input type="hidden" class="gform_hidden" name="is_submit_1" value="1">
                        <input type="hidden" class="gform_hidden" name="gform_submit" value="1">

                        <input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
                        <input type="hidden" class="gform_hidden" name="state_1"
                            value="WyJ7XCI2XCI6W1wiMGUxOTM4NTM4NGI2YTQ3ZGI3YWEzYWI5NDcxOWQwMTRcIixcIjhiNzY5NDg0YjQ3NDhhMmJlMGFmOTc4MWM0ZDE0MTYyXCIsXCI0NmIwMjhkZGMzZWUzOGNmNzQ0NzNhNzA4ODAyZjkyZlwiLFwiMWRkMjE0NGVmMjkxMzY0MDY4ZDA3N2JjNjhiODJjZmZcIixcImFlZGIwZGQ5MmYxZWNhMjVhYzNmMjFmZDdmYjMxYjQxXCIsXCI0NDMwZTUzZDc1Y2RhNzY5NTQ1YmNkMzFkMjRmN2VhOFwiLFwiNmY4ZDM2ZWY5MzY2ZDhiMTMzNzY2NWIyYTE2MjkyNjVcIixcImVmYjY0NzBkYzg1ZWVhYTg5M2IyYTc1YzQxNjk5ODRjXCJdfSIsIjFhOWVlMDFlNzBhZGVmOTNiMGQyY2E0MDU1ZDczNDRjIl0=">
                        <input type="hidden" class="gform_hidden" name="gform_target_page_number_1"
                            id="gform_target_page_number_1" value="0">
                        <input type="hidden" class="gform_hidden" name="gform_source_page_number_1"
                            id="gform_source_page_number_1" value="1">
                        <input type="hidden" name="gform_field_values" value="">

                    </div>
                    <p style="display: none !important;"><label>Δ
                            <textarea name="ak_hp_textarea" cols="45" rows="8" maxlength="100"></textarea>
                        </label><input type="hidden" id="ak_js_1" name="ak_js" value="1681149880524">
                        <script>
                            document.getElementById("ak_js_1").setAttribute("value", (new Date()).getTime());
                        </script>
                    </p>
                </form>
            </div>
            <script type="text/javascript">
                gform.initializeOnLoaded(function() {
                    gformInitSpinner(1,
                        'https://odommobangladesh.org.bd/wp-content/plugins/gravityforms-main/images/spinner.svg', true);
                    jQuery('#gform_ajax_frame_1').on('load', function() {
                        var contents = jQuery(this).contents().find('*').html();
                        var is_postback = contents.indexOf('GF_AJAX_POSTBACK') >= 0;
                        if (!is_postback) {
                            return;
                        }
                        var form_content = jQuery(this).contents().find('#gform_wrapper_1');
                        var is_confirmation = jQuery(this).contents().find('#gform_confirmation_wrapper_1').length >
                            0;
                        var is_redirect = contents.indexOf('gformRedirect(){') >= 0;
                        var is_form = form_content.length > 0 && !is_redirect && !is_confirmation;
                        var mt = parseInt(jQuery('html').css('margin-top'), 10) + parseInt(jQuery('body').css(
                            'margin-top'), 10) + 100;
                        if (is_form) {
                            jQuery('#gform_wrapper_1').html(form_content.html());
                            if (form_content.hasClass('gform_validation_error')) {
                                jQuery('#gform_wrapper_1').addClass('gform_validation_error');
                            } else {
                                jQuery('#gform_wrapper_1').removeClass('gform_validation_error');
                            }
                            setTimeout(function() {
                                /* delay the scroll by 50 milliseconds to fix a bug in chrome */
                            }, 50);
                            if (window['gformInitDatepicker']) {
                                gformInitDatepicker();
                            }
                            if (window['gformInitPriceFields']) {
                                gformInitPriceFields();
                            }
                            var current_page = jQuery('#gform_source_page_number_1').val();
                            gformInitSpinner(1,
                                'https://odommobangladesh.org.bd/wp-content/plugins/gravityforms-main/images/spinner.svg',
                                true);
                            jQuery(document).trigger('gform_page_loaded', [1, current_page]);
                            window['gf_submitting_1'] = false;
                        } else if (!is_redirect) {
                            var confirmation_content = jQuery(this).contents().find('.GF_AJAX_POSTBACK').html();
                            if (!confirmation_content) {
                                confirmation_content = contents;
                            }
                            setTimeout(function() {
                                jQuery('#gform_wrapper_1').replaceWith(confirmation_content);
                                jQuery(document).trigger('gform_confirmation_loaded', [1]);
                                window['gf_submitting_1'] = false;
                                wp.a11y.speak(jQuery('#gform_confirmation_message_1').text());
                            }, 50);
                        } else {
                            jQuery('#gform_1').append(contents);
                            if (window['gformRedirect']) {
                                gformRedirect();
                            }
                        }
                        jQuery(document).trigger('gform_post_render', [1, current_page]);
                    });
                });
            </script>
        </div>
    </div>

</x-guest-layout>
