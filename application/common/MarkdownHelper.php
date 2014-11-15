<?php

require_once COMPONENT_PATH . 'php-markdown/Michelf/Markdown.inc.php';

class MarkdownHelper
{
    public static function transformFromPlainText(&$text)
    {
        $text = Markdown::defaultTransform($text);
    }
}
