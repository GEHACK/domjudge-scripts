<?php

$schoolData = explode("\n", file_get_contents($argv[1]));
$schools = [];
foreach ($schoolData as $idx => $school) {
    if ($idx === 0)
    {
        continue;
    }
    $school = str_replace("\r", "", $school);
    IF (empty($school))
    {
        continue;
    }
    $school = explode("\t", $school);

    $schools[$school[1]] = sprintf('U-%04d', $school[0]);
}

$imageDir = $argv[2];
$newImageDir = $argv[3];

if ($handle = opendir($imageDir))
{
    while (($entry = readdir($handle)) !== false)
    {
        if (preg_match('/^(\d+)\.png$/', $entry, $matches))
        {
            if (!isset($schools[$matches[1]])) {
                echo "${matches[1]} NOT FOUND!\n";
            } else {
                $newName = sprintf('%s/%s.png', $newImageDir, $schools[$matches[1]]);
                copy($imageDir . '/' . $entry, $newName);
            }
        }
    }

    closedir($handle);
}
