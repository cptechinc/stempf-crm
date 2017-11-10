<?php 
trait AttributeParser {
    /**
     * Takes a string of attributes and parses it out by a delimiter (|)
     * @param  [type] $vars string of attributes separated by | 
     * @return [type]       string of atrributes and values like class=""
     */
    private function attributes($vars) {
        $attributesarray = array();
        $attributes = '';
        
        if (!empty($vars)) {
            $values = explode('|', $vars);
            foreach ($values as $value) {
                $pieces = explode('=', $value);
                $attributesarray[array_shift($pieces)] = implode('=', $pieces);
            }
        }
        
        if (!empty($attributesarray)) {
            foreach ($attributesarray as $key => $value) {
                if ($value == 'noparam') {
                    $attributes .= ' ' . $key;
                } else {
                    $attributes .= ' ' . $key . '="' . $value . '"';
                }
            }
        }
        return $attributes;
    }
}
