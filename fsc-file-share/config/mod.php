<?php
// Open the file
$filename = dirname(__FILE__, 2) . '\google-profanity-words.txt';
$fp = @fopen($filename, 'r'); 
$words = [];
// Add each line to an array
if ($fp) {
   $words = explode("\n", fread($fp, filesize($filename)));
   array_pop($words);
}

return [
    'inappropriate_words' => $words,
];