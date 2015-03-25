<?php

if ( ! function_exists('has_required_property'))
{
    /**
     * Check an array of properties for a required property.
     *
     * @param string $required
     * @param array $properties
     * @return mixed
     */
    function has_required_property($required, array $properties)
    {
        $result = false;

        foreach ($properties as $property => $value) {
            if (is_array($value)) {
                $result = has_required_property($required, $value);
            } else {
                $result = ($required == $property);
            }
            if ($result == true) {
                break;
            }
        }

        return $result;
    }
}