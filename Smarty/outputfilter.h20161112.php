<?php
/**
 * Smarty plugin
 *
 * @package    Webseiten Optimierungs Tipps - Optimierer
 * @subpackage PluginsFilter
 */

/**
 * Smarty trimwhitespace outputfilter plugin
 * Trim unnecessary whitespace from HTML markup.
 *
 * @param string $source input string
 * @return string filtered output
 */
function smarty_outputfilter_h20161112($output)
{
    if (mb_strpos($output, "<head>") == -1) {
        return $output;
    }

    $tmp = trim($output);
    $tmp = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $tmp);

    return preg_replace('/>\s+</s', '> <', $tmp);
}
