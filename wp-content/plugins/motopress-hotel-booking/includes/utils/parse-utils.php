<?php

namespace MPHB\Utils;

/**
 * @since 3.7.2
 */
class ParseUtils
{
    /**
     * @param array $rawData
     * @param array $errors Optional. An array to add the errors to.
     * @return array|false Customer data or FALSE.
     *
     * @since 3.7.2
     */
    public static function parseCustomer($rawData, &$errors = null)
    {
        if (!is_admin()) {
            $customerFields = mphb_get_customer_fields();
        } else {
            $customerFields = mphb_get_admin_checkout_customer_fields();
        }

        // [Field name => '']
        $customerData = array_combine(array_keys($customerFields), array_fill(0, count($customerFields), ''));

        // Parse inputs
        foreach ($customerFields as $fieldName => $field) {
            $fullName = MPHB()->addPrefix($fieldName, '_'); // 'mphb_first_name'

            if (isset($rawData[$fullName])) {
                $value = $rawData[$fullName];

                if ($field['type'] == 'email') {
                    $value = sanitize_email($value);
                } else if ($field['type'] == 'textarea') {
                    $value = sanitize_textarea_field($value);
                } else {
                    $validValue = apply_filters('mphb_sanitize_customer_field', null, $value, $field['type'], $fieldName);

                    if (is_null($validValue)) {
                        $value = sanitize_text_field($value);
                    } else {
                        $value = $validValue;
                    }
                }

                $customerData[$fieldName] = $value;
            }
        }

        $customerData = apply_filters('mphb_parse_customer_data', $customerData);

        // Check for errors
        if (is_null($errors)) {
            $errors = array();
        }

        $wasErrors = count($errors);

        foreach ($customerFields as $fieldName => $field) {
            $value = $customerData[$fieldName];

            if (empty($value) && $field['required']) {
                $errors[] = $field['labels']['required_error'];
            }
        }

        // Return the results
        if (count($errors) == $wasErrors) {
            return $customerData;
        } else {
            return false;
        }
    }
}
