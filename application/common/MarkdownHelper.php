<?php

require_once "/home/laoyi/jobs/php_test/airnote/application/components/php-markdown/Michelf/Markdown.inc.php";

class MarkdownHelper
{
    public static function transformFromPlainText(&$text)
    {
        $text = Michelf\Markdown::defaultTransform($text);
    }
}
