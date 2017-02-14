<?php

/**
 * @param string $str
 * @return string
 */
function generate_displayable_php_code($str = "")
{
    $str = nl2br(htmlspecialchars($str));

    return $str;

}

/**
 * @param bool|false $status
 * @return string
 */
function display_php_code_status($status) {

    return $status ?  "Valid PHP code." : "Invalid PHP code. Exiting now";
}


/**
 * @param $str
 * @return bool|int
 */
function is_valid_php_code($str) {
    $ret = exec( 'echo "' . $str .'" | php -l 2> /dev/null' );

    return strpos( $ret, 'Errors parsing' ) !== false ? 0 : 1;
}