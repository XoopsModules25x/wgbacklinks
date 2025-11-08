<?php

namespace XoopsModules\Wgbacklinks;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgbacklinks module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 3.0 or later
 * @package        wgbacklinks
 * @author         goffy (wedega.com) - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 */

/**
 * Class Helper
 */
class Helper extends \Xmf\Module\Helper
{
    /**
     * @var string
     */
    protected $dirname = null;
    /**
     * @var string
     */
    protected $module = null;
    /**
     * @var string
     */
    protected ?string $handler = null;
    /**
     * @var string
     */
    protected ?string $config = null;
    /**
     * @var string
     */
    public $debug = null;
    /**
     * @var array
     */
    protected array $debugArray = array();
    /**
    *  @protected function constructor class
    *  @param mixed $debug
    */
    public function __construct($debug)
    {
        $this->debug   = $debug;
        $moduleDirName = \basename(\dirname(__DIR__));
        parent::__construct($moduleDirName);
    }

    /**
     * @static function getInstance
     * @param false $debug
     * @return Helper
     */
    public static function getInstance(false $debug = false): Helper
    {
        static $instance;
        if (null === $instance) {
            $instance = new static($debug);
        }

        return $instance;
    }

    /**
     * @static function getModule
     *
     * @return XoopsModule
     */
    public function &getModule(): ?\XoopsModule
    {
        if ($this->module == null) {
            $this->initModule();
        }
        return $this->module;
    }

    /**
     * Get an Object Handler
     *
     * @param string $name name of handler to load
     *
     * @return bool|\XoopsObjectHandler|\XoopsPersistableObjectHandler
     * @throws \Exception
     */
    public function getHandler($name): \XoopsObjectHandler|bool|\XoopsPersistableObjectHandler
    {
        $class = __NAMESPACE__ . '\\' . \ucfirst($name) . 'Handler';
        if (!\class_exists($class)) {
            throw new \RuntimeException("Class '$class' not found");
        }
        /** @var \XoopsMySQLDatabase $db */
        $db     = \XoopsDatabaseFactory::getDatabaseConnection();
        $helper = self::getInstance();
        $ret    = new $class($db, $helper);
        $this->addLog("Getting handler '$name'");
        return $ret;
    }

    /**
     * truncateHtml can truncate a string up to a number of characters while preserving whole words and HTML tags
     * www.gsdesign.ro/blog/cut-html-string-without-breaking-the-tags
     * www.cakephp.org
     *
     * @param string $text         String to truncate.
     * @param integer $length       Length of returned string, including ellipsis.
     * @param string $ending       Ending to be appended to the trimmed string.
     * @param boolean $exact        If false, $text will not be cut mid-word
     * @param boolean $considerHtml If true, HTML tags would be handled correctly
     *
     * @return string Trimmed string.
     */
    public function truncateHtml(string $text, int $length = 200, string $ending = '...', bool $exact = false, bool $considerHtml = true): string
    {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (\strlen(\preg_replace('/<.*?' . '>/', '', $text)) <= $length) {
                return $text;
            }
            // splits all html-tags to scanable lines
            \preg_match_all('/(<.+?' . '>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
            $total_length = \strlen($ending);
            $open_tags    = array();
            $truncate     = '';
            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash
                    if (\preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                        // if tag is a closing tag
                    } elseif (\preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = \array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                        // if tag is an opening tag
                    } elseif (\preg_match('/^<\s*([^\s>!]+).*?' . '>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        \array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = \strlen(\preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length + $content_length > $length) {
                    // the number of characters which are left
                    $left            = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (\preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entities_length <= $left) {
                                $left--;
                                $entities_length += \strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= \substr($line_matchings[2], 0, $left + $entities_length);
                    // maximum lenght is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }
                // if the maximum length is reached, get off the loop
                if ($total_length >= $length) {
                    break;
                }
            }
        } else {
            if (\strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = \substr($text, 0, $length - \strlen($ending));
            }
        }
        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurance of a space...
            $spacepos = strrpos($truncate, ' ');
            if ($spacepos > 0) {
                // ...and cut the text in this position
                $truncate = \substr($truncate, 0, $spacepos);
            }
        }
        // add the defined ending to the text
        $truncate .= $ending;
        if ($considerHtml) {
            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }

        return $truncate;
    }

    public function execExchangeData($url, $postdata): string
    {
        $valid_url = \rtrim($url, '/');

        if (!str_ends_with($valid_url, 'exchange-data.php')) {
            $valid_url .= '/modules/wgbacklinks/exchange-data.php';
        }
        $error = "";

        if (\function_exists('curl_init')) {
            //open connection
            $ch = \curl_init();

            //set the url, number of POST vars, POST data
            \curl_setopt($ch, CURLOPT_URL, $valid_url);
            \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            \curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 25);
            \curl_setopt($ch, CURLOPT_TIMEOUT, 25);
            \curl_setopt($ch, CURLOPT_VERBOSE, false);
            \curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            \curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            \curl_setopt($ch, CURLOPT_POST, 1);
            \curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

            //execute post
            $result = \curl_exec($ch);
            // print_r(\curl_getinfo($ch));
            if ($result === FALSE)  {
                $error = "unexpected curl_error:".\curl_error($ch)."<br>";
            }

            \curl_close($ch);
        } else {
            $opts = array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $postdata
                )
            );

            $context  = \stream_context_create($opts);
            $result = \file_get_contents($valid_url, false, $context);
        }
        // echo "<br>result:" . $result; echo "<br>error:" . $error;
        return $result . $error;
    }
}
