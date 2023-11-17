<?php

// Open the file
$filename = 'fsc-file-share\google-profanity-words.txt';
$fp = @fopen($filename, 'r'); 
$words = [];
// Add each line to an array
if ($fp) {
   $words = explode(PHP_EOL, fread($fp, filesize($filename)));
}

return [
    'inappropriate_words' => $words,
];