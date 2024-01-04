<?php

/** A function to convert new lines into <br> for HTML documents.
 * @param $string string A string with new lines.
 * @return string A string with <br> tags for html page rendering.
 */
function newlines2br(string $string):string {
    $commentContent = $string;
    $userInput = preg_replace("/(\r\n|\r|\n)/", PHP_EOL, $commentContent);
    return nl2br(htmlspecialchars($userInput));
}
