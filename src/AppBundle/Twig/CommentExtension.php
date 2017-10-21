<?php
/**
 * Created by PhpStorm.
 * User: suk
 * Date: 21.10.17
 * Time: 13:15
 */

namespace AppBundle\Twig;


class CommentExtension extends \Twig_Extension {
    public function getFilters() {
        return [
            new \Twig_SimpleFilter("comment", [$this, "commentFilter"])
        ];
    }

    public function commentFilter($input) {
        $output = htmlspecialchars($input);

        $find = array(
            '~\[code\](.*?)\[/code\]~s',
            '~\[b\](.*?)\[/b\]~s',
            '~\[i\](.*?)\[/i\]~s',
            '~\[url\]((?:ftp|https|http?)://.*?)\[/url\]~s',
        );

        $replace = array(
            '<pre><code>$1</code></pre>',
            '<b>$1</b>',
            '<i>$1</i>',
            '<a href="$1">$1</a>',
        );

        $output = preg_replace($find, $replace, $output);

        $output = str_replace("\n", "<br>", $output);

        return $output;
    }
}