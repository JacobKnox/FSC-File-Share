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
    'report_types' => [
        0 => 'users',
        1 => 'files',
        2 => 'comments',
    ],
    'report_categories' => [
        'inappropriate words',
        'other',
    ],
    'bug_categories' => [
        'Text Error' => 'Misspelling/Grammer',
        'Visual' => 'Visual/Image',
        'Security' => 'Security Vulnerability',
        'Other' => 'Other',
    ],
];