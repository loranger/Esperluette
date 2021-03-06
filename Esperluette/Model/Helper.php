<?php
namespace Esperluette\Model;

use Fwk\Fwk;
class Helper
{
    private static $translations;

    private static function loadI18n($language)
    {
        $path = 'Esperluette' . DIRECTORY_SEPARATOR
                . 'I18n' . DIRECTORY_SEPARATOR
                . $language . DIRECTORY_SEPARATOR
                . 'language.php';
        if (is_readable($path)) {
            include $path;
            static::$translations = $translations;
        } else {
            Fwk::Logger()->debug(sprintf('Missing translation file for %s', $language));
        }
    }


    public static function i18n()
    {
        $args = func_get_args();
        if (isset($args[0])) {
            $str    = $args[0];
            $lang   = Config::get('language', 'en_GB');

            if (static::$translations === null) {
                static::loadI18n($lang);
            }

            if (isset(static::$translations[$str])) {
                if (isset($args[1])) {
                    array_shift($args);
                    return vsprintf(static::$translations[$str], $args);
                } else {
                    return static::$translations[$str];
                }
            } else {
                Fwk::Logger()->debug(sprintf('Missing translation in %s for \'%s\'', $lang, $str));
                return $str;
            }
        }
    }
}
