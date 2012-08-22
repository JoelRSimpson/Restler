<?php
namespace Luracast\Restler\Format;
/**
 * Describe the purpose of this class/interface/trait
 *
 * @category   Framework
 * @package    restler
 * @author     R.Arul Kumaran <arul@luracast.com>
 * @copyright  2010 Luracast
 * @license    http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link       http://luracast.com/products/restler/
 * @version    3.0.0
 */
abstract class MultiFormat implements iFormat
{
    /**
     * override in the extending class
     */
    const MIME = 'text/plain,text/html';
    /**
     * override in the extending class
     */
    const EXTENSION = 'txt,html';

    public static $mime;
    public static $extension;

    /**
     * Injected at runtime
     *
     * @var \Luracast\Restler\Restler
     */
    public $restler;

    /**
     * Get MIME type => Extension mappings as an associative array
     *
     * @return array list of mime strings for the format
     * @example array('application/json'=>'json');
     */
    public function getMIMEMap()
    {
        $extensions = explode(',',static::EXTENSION);
        $mimes = explode(',',static::MIME);
        $count = max(count($extensions), count($mimes));
        $extensions += array_fill(0, $count, end($extensions));
        $mimes += array_fill(0, $count, end($mimes));
        return array_combine($mimes,$extensions);
    }

    /**
     * Set the selected MIME type
     *
     * @param string $mime
     *            MIME type
     */
    public function setMIME($mime)
    {
        static::$mime = $mime;
    }

    /**
     * Content-Type field of the HTTP header can send a charset
     * parameter in the HTTP header to specify the character
     * encoding of the document.
     * This information is passed
     * here so that Format class can encode data accordingly
     * Format class may choose to ignore this and use its
     * default character set.
     *
     * @param string $charset
     *            Example utf-8
     */
    public function setCharset($charset)
    {
        // TODO: Implement setCharset() method.
    }

    /**
     * Content-Type accepted by the Format class
     *
     * @return string $charset Example utf-8
     */
    public function getCharset()
    {
        // TODO: Implement getCharset() method.
    }

    /**
     * Get selected MIME type
     */
    public function getMIME()
    {
        return static::$mime;
    }

    /**
     * Set the selected file extension
     *
     * @param string $extension
     *            file extension
     */
    public function setExtension($extension)
    {
        static::$extension = $extension;
    }

    /**
     * Get the selected file extension
     *
     * @return string file extension
     */
    public function getExtension()
    {
        return static::$extension;
    }

    public function __toString()
    {
        return $this->getExtension();
    }
}