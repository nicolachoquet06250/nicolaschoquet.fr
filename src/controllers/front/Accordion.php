<?php


namespace NC\controllers\front;

use PhpLib\decorators\Route;

#[Route('/accordion')]
class Accordion
{
    public function get(): string {
        return <<<HTML
            <!doctype html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Test du web component accordion</title>
                
                <script type="module" src="/assets/ui-kit/components/index.js"></script>
            </head>
            <body>
                <simple-accordion name="motif"></simple-accordion>
                
                <hr>
                
                <multi-accordion name="motif2"></multi-accordion>
            </body>
            </html>
        HTML;
    }
}