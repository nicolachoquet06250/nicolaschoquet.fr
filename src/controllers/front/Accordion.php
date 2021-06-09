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
                <simple-accordion name="motif">
                    <accordion-item id="accordion-item-internet" value="internet">
                        <span slot="title">Internet</span>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                    </accordion-item>
                    
                    <accordion-item id="accordion-item-aucun-service" value="aucun-service">
                        <span slot="title">Aucun Service</span>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                    </accordion-item>
                </simple-accordion>
                
                <hr>
                
                <multi-accordion name="motif2">
                    <accordion-item id="accordion-item-internet" value="internet">
                        <span slot="title">Internet</span>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                    </accordion-item>
                    
                    <accordion-item id="accordion-item-aucun-service" value="aucun-service">
                        <span slot="title">Aucun Service</span>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                        <p slot="content">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                              maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                    </accordion-item>
                </multi-accordion>
            </body>
            <script>
                window.addEventListener('load', e => {
                    const simple = document.querySelector('simple-accordion');
                    const multi = document.querySelector('multi-accordion');
                    const onChange = e => {
                        console.log('on-change', 'value', e.detail.checked);
                    };
                    
                    if (simple) simple.addEventListener('change', onChange)
                    if (multi) multi.addEventListener('change', onChange)
                })
            </script>
            </html>
        HTML;
    }
}