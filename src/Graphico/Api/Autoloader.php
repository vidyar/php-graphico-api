<?php
/**
 * This file is part of phpgraphico-api.
 *
 * (c) Yuya Takeyama
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Autoloader.
 *
 * @author Yuya Takeyama
 */
class Graphico_Api_Autoloader
{
    const NAME_SPACE = 'Graphico_Api';

    private static $baseDir;
    
    /**
     * Registers autoloader.
     *
     * @param string $dirname base directory path.
     * @return void
     */
    public static function register($dirname = NULL)
    {
        if (is_null($dirname)) {
            self::$baseDir = realpath(dirname(__FILE__) . '/../../');
        } else {
            self::$baseDir = $dirname;
        }

        spl_autoload_register(array(__CLASS__, "autoload"));
    }
    
    /**
     * Unregisters autoloader.
     *
     * @return void
     */
    public static function unregister()
    {
        spl_autoload_unregister(array(__CLASS__, "autoload"));
    }
    
    /**
     * Autoloading.
     *
     * @param string $name class name
     * @return boolean return true when load successful
     */
    public static function autoload($name)
    {
        $retval = false;

        if (strpos($name,self::NAME_SPACE) === 0) {
            $parts = explode('_', $name);
            array_shift($parts);
            
            $expected_path = join(
                DIRECTORY_SEPARATOR,
                array(self::$baseDir, join(DIRECTORY_SEPARATOR, $parts) . ".php")
            );

            if (is_file($expected_path) && is_readable($expected_path)) {
                require $expected_path;
                $retval = true;
            }
        }
        
        return $retval;
    }
}
