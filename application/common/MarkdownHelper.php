<?php

require_once dirname(dirname(__FILE__)) . "/components/php-markdown/Michelf/Markdown.inc.php";

class MarkdownHelper
{
    public static function transformFromPlainText(&$text)
    {
        $text = Michelf\Markdown::defaultTransform($text);
    }
}
