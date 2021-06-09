<?php


namespace NC\controllers\front;

use PhpLib\decorators\Route;

#[Route('/doc')]
class DocLayout
{
    protected function getTabs(string $selected) {
        $isActive = fn($expected) => match ($expected) {
            default => $selected === $expected ? 'active' : ''
        };

        return <<<HTML
            <style>
                .tabs ul {
                    list-style: none;
                    display: flex;
                    flex-direction: row;
                    justify-content: space-around;
                    align-items: center;
                    padding-left: 0;
                    border-bottom: 1px solid black;
                }
                
                .tabs ul li {
                    display: flex;
                    width: 100%;
                    height: 50px;
                    justify-content: center;
                    align-items: center;
                }
                
                .tabs ul li a {
                    color: black;
                    text-decoration: none;
                    cursor: pointer;
                    font-size: 1.5rem;
                }
                
                .tabs ul li.active {
                    border-bottom: 2px solid black;
                }
                
                .tab-content {
                    display: none;
                }
                
                .tab-content.active {
                    display: block;
                }
            </style>
            
            <nav class="tabs">
                <ul>
                    <li class="{$isActive('button')}"> 
                        <a href="#tab-content-button" data-title="Boutons"> Bouton </a>
                    </li>
                    <li class="{$isActive('image')}"> 
                        <a href="#tab-content-image" data-title="Images"> Image </a>
                    </li>
                    <li class="{$isActive('form')}">
                        <a href="#tab-content-form" data-title="Forms"> Form </a>
                    </li>
                    <li class="{$isActive('accordion')}">
                        <a href="#tab-content-accordion" data-title="Accordéons"> Accordéon </a>
                    </li>
                </ul>
            </nav>
            
            <div id="tab-content-button" class="tab-content {$isActive('button')}">
                {$this->getButton()}
            </div>
            <div id="tab-content-image" class="tab-content {$isActive('image')}">
                {$this->getImage()}
            </div>
            <div id="tab-content-form" class="tab-content {$isActive('form')}">
                {$this->getForm()}
            </div>
            <div id="tab-content-accordion" class="tab-content {$isActive('accordion')}">
                {$this->getAccordion()}
            </div>
            
            <script>
                window.addEventListener('load', () => {
                    Array.from(document.querySelectorAll('.tabs ul li a')).map(el => {
                        el.addEventListener('click', e => {
                            e.preventDefault();
                            
                            const active = document.querySelector('.tabs ul li.active');
                            const activeContent = document.querySelector('.tab-content.active');
                            const dist = e.target.getAttribute('href');
                            const title = e.target.getAttribute('data-title');
                            
                            e.target.parentElement.classList.add('active');
                            document.querySelector(dist).classList.add('active');
                            activeContent.classList.remove('active');
                            active.classList.remove('active');
                            
                            document.querySelector('title').innerText = 'Documentation | ' + title;
                        })
                    })
                })
            </script>
        HTML;
    }

    public function get(): string {
        return <<<HTML
            <!doctype html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Documentation | Boutons</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" 
                      rel="stylesheet" 
                      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" 
                      crossorigin="anonymous">
                
                <script type="module" src="/assets/ui-kit/components/index.js"></script>
            </head>
            <body>
                {$this->getTabs('button')}
            </body>
            </html>
        HTML;
    }

    public function getAccordion(): string {
        return <<<HTML
            <div class="container">
                <div class="row">
                    <div class="col-12">
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
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
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
                    </div>
                </div>
            </div>
            
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
        HTML;
    }

    public function getButton(): string {
        return <<<HTML
            <style>
                #tab-content-button .container .row .col-12 {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
            </style>
            
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <k-button type="classic" primary="false" secondary="true" size="big">
                            Créer votre compte
                        </k-button>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <k-button type="classic" primary="true" secondary="false" size="big">
                            Créer votre compte
                        </k-button>
                    </div>
                </div>
            </div>
        HTML;

    }

    public function getForm(): string {
        return <<<HTML
        <style>
            #tab-content-form .container .row:nth-child(2) .col-6,
            #tab-content-form .container .row:first-child .col-12 {
                height: 50px;
                font-size: 2rem;
            }
        </style>
        
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-row justify-content-center align-items-center">
                    Switches
                </div>
            </div>
            
            <div class="row">
                <div class="col-6 pb-4 d-flex flex-row justify-content-center align-items-center" style="border-right: 1px solid black;">
                    Checkboxes
                </div>
                <div class="col-6 pb-4 d-flex flex-row justify-content-center align-items-center">
                    Radios
                </div>
            </div>
            
            <div class="row">
                <div class="col-3 pb-1 d-flex flex-row justify-content-center align-items-center">
                    <k-switch checked="true"></k-switch>
                </div>
                
                <div class="col-3 pb-1 d-flex flex-row justify-content-center align-items-center" style="border-right: 1px solid black;">
                    <k-switch checked="true" on-icon="/assets/ui-kit/components/moon-regular.svg" off-icon="/assets/ui-kit/components/sun-regular.svg"></k-switch>
                </div>
                
                <div class="col-3 pb-1 d-flex flex-row justify-content-center align-items-center">
                    <k-switch type="radio" name="radio" checked="true" on-icon="assets/ui-kit/components/moon-regular.svg" off-icon="assets/ui-kit/components/sun-regular.svg"></k-switch>
                </div>
                
                <div class="col-3 pb-1 d-flex flex-row justify-content-center align-items-center">
                    <k-switch type="radio" name="radio" checked="false"></k-switch>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12 col-md pb-1">
                    <k-input type="text" value="" placeholder="Ceci est un placeholder"></k-input>
                </div>

                <div class="col-12 col-md pb-1">
                    <k-input type="textarea" value="test" placeholder="Ceci est un placeholder"></k-input>
                </div>

                <div class="col-12 col-md pb-1">
                    <k-select>
                        <k-option>test</k-option>

                        <k-option>test 2</k-option>
                    </k-select>
                </div>
            </div>
        </div>
        HTML;
    }

    public function getImage(): string {
        return <<<HTML
        <div class="container">
            <div class="row p-1">
                <div class="col-12 col-md-6 d-flex flex-row justify-content-center align-items-center">
                    <k-image src="/assets/ui-kit/documentation/norsys.png" width="136" height="142"></k-image>
                </div>

                <div class="col-12 col-md-6 d-flex flex-row justify-content-center align-items-center">
                    <k-image src="/assets/ui-kit/documentation/norsys2.png" width="136" height="142" debug="false"></k-image>
                </div>
            </div>
        </div>
        HTML;
    }
}