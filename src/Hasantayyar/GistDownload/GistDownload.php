<?php

namespace Hasantayyar\GistDownload;

class GistDownload extends ApiClient {

    public function download($username, $dir) {
        $next = 'https://api.github.com/users/' . $username . '/gists';
        while ($next) {
            echo "getting list :" . $next . "\n";
            $res = $this->client->get($next);
            $gists = $res->json();
            foreach ($gists as $gist) {
                $gistFolder = $dir . '/gist_' . $gist['id'];
                $rmCommand = 'rm -rf ' . $gistFolder; // damn. too dangerous.
                echo 'RUN: ' . $rmCommand . "\n";
                exec($rmCommand);
                $command = 'git clone ' . escapeshellarg($gist['git_pull_url']) . ' ' . escapeshellarg($gistFolder);
                echo 'RUN: ' . $command . "\n";
                exec($command);
            }
            $links = $res->getHeader('Link');
            $matches = null;
            preg_match('/\<(.*)\>\; rel\=\"next\"/i', $links, $matches);
            $next = isset($matches[1]) ? $matches[1] : null;
        }
    }

}
