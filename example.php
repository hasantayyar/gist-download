#!/usr/bin/env php
<?php
namespace Hasantayyar\GistDownload;

include __DIR__ . '/vendor/autoload.php';

$gist = new GistDownload();
$username = 'hasantayyar';
$dir = __DIR__.'/gists-'.$username;
$gist->download($username , $dir);
