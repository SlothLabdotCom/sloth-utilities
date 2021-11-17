<?php

return [
    'token' => 'slothadmin',

    //Malware Scan
    'file-extensions' => 'php|phtml|php3|php4|php5|phps|htaccess|txt|gif', // File extensions
    'ignored-dirs' => '.|..|.DS_Store|.svn|.git', // Directories & Files to ignore
    'scan-dir' => '../', // Directory to scan
    'additional-strings' => '' //Example: iframe|bruteforce|ddos
];
