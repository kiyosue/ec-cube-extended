#!/usr/local/bin/php
<?php
/**
 * �ե�����Υ��󥳡��ǥ��󥰤� $fromEncoding ���� $toEncoding ���Ѵ����ޤ�.
 *
 * @author  Kentaro Ohkouchi<ohkouchi@loop-az.jp>
 * @since   PHP4.3.0(cli)
 * @version $Id$
 */

/**
 * �Ѵ��������ե�����γ�ĥ�Ҥ򥫥�޶��ڤ������.
 */
$includes = "php,inc,tpl,css,sql,js";

/**
 * ��������ե�����̾�򥫥�޶��ڤ������.
 */
$excludes = "convert.php";

/**
 * �Ѵ������󥳡��ǥ���.
 */
$fromEncoding = "EUC-JP";

/**
 * �Ѵ��襨�󥳡��ǥ���.
 */
$toEncoding = "UTF-8";

$includeArray = explode(',', $includes);
$excludeArray = explode(',', $excludes);
$fileArrays = listdirs('.');

foreach ($fileArrays as $path) {
    if (is_file($path)) {

        // �ե�����̾�����
        $fileName = pathinfo($path, PATHINFO_BASENAME);
        
        // ��ĥ�Ҥ����
        $suffix = pathinfo($path, PATHINFO_EXTENSION);

        // �����ե�����򥹥��å�
        if (in_array($fileName, $excludeArray)) {
            echo "excludes by " . $path . "\n";
            continue;
        }

        // �Ѵ��оݤ��˽���
        foreach ($includeArray as $include) {
            if ($suffix == $include) {
            	
            	// �ե��������Ƥ������, ���󥳡��ǥ����Ѵ�
                $contents = file_get_contents($path);
                $convertedContents = mb_convert_encoding($contents,
                                                         $toEncoding,
                                                         $fromEncoding);

                // �񤭹��ߤǤ��뤫��
                if (is_writable($path)) {

                    // �ե������񤭽Ф��⡼�ɤǳ���
                    $handle = fopen($path, "w");
                    if (!$handle) {
                        echo "Cannot open file (". $path . ")";
                        continue;
                    }

                    // �������Ѵ��������Ƥ�񤭹��� 
                    if (fwrite($handle, $convertedContents) === false) {
                        echo "Cannot write to file (" . $path . ")";
                        continue;
                    }

                    echo "converted " . $path . "\n";
                    // �ե�������Ĥ���
                    fclose($handle);
                } else {

                    echo "The file " . $filename . "is not writable";
                }
            }
        }
    }
}

/**
 * $dir ��Ƶ�Ū��é�äƥѥ�̾��������֤�.
 * 
 * @param string Ǥ�դΥѥ�̾
 * @return array $dir ��겼�ؤ�¸�ߤ���ѥ�̾������
 * @see http://www.php.net/glob
 */
function listdirs($dir) {
    static $alldirs = array();
    $dirs = glob($dir . '/*');
    if (count($dirs) > 0) {
        foreach ($dirs as $d) $alldirs[] = $d;
    }
    foreach ($dirs as $dir) listdirs($dir);
    return $alldirs;
}
?>
