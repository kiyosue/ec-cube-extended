<?php
/**
 * Script�����򥨥������פ���
 *
 * @param  string $value ����
 * @return string $value �ޥå����������Ѵ����ʸ���󡢤��ʤ��������Ϥ��줿ʸ����򤽤Τޤ��֤���
 */
function smarty_modifier_script_escape($value) {
    
    if (is_array($value)) {return $value;}
    
    $pattern = "/<script.*?>|<\/script>/";
    $convert = "#do not use script#";
    
    if ( preg_match_all($pattern, $value, $matches) ) {
        return preg_replace($pattern, $convert, $value);
    } else {
        return $value;
    }
}
?>
