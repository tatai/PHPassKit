<?php
function phpasskit_autoload($class = null) {
    static $classes = null;
    static $path = null;

    if ($classes === null) {
        $classes = array(
          'phpasskit' => '/classes/PHPassKit.class.php',
          'phpasskitexception' => '/classes/PHPassKitException.class.php',
          'standardkeys' => '/classes/FieldDictionaryKeys/StandardKeys.class.php',
          'coupon' => '/classes/Style/Coupon.class.php'
        );

        $path = dirname(dirname(__FILE__));
    }

    if ($class === null) {
        $result = array(__FILE__);

        foreach ($classes as $file) {
            $result[] = $path . $file;
        }

        return $result;
    }

    $cn = strtolower($class);

    if (isset($classes[$cn])) {
        require $path . $classes[$cn];
    }
}

spl_autoload_register('phpasskit_autoload');
