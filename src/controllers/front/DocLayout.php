<?php


namespace NC\controllers\front;

use PhpLib\decorators\Route;

#[Route('/doc')]
class DocLayout
{
    protected function getTabs(string $selected): string {
        return <<<HTML
            <tabs-container active-tab="$selected">
                <tab-items>
                    <tab-item active="false" title="Boutons" item="buttons">
                        Bouton
                    </tab-item>
                    
                    <tab-item active="false" title="Images" item="images">
                        Image
                    </tab-item>
                    
                    <tab-item active="false" title="Forms" item="forms">
                        Form
                    </tab-item>
                    
                    <tab-item active="false" title="Accordéons" item="accordions">
                        Accordéon
                    </tab-item>
                </tab-items>
                
                <tab-content active="false" slot="content" item="buttons"> 
                    {$this->getButton()} 
                </tab-content>
                
                <tab-content active="false" slot="content" item="images"> 
                    {$this->getImage()} 
                </tab-content>
                
                <tab-content active="false" slot="content" item="forms"> 
                    {$this->getForm()} 
                </tab-content>
                
                <tab-content active="false" slot="content" item="accordions"> 
                    {$this->getAccordion()} 
                </tab-content>
            </tabs-container>
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
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            {$this->getTabs('buttons')}
                        </div>
                    </div>
                </div>
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
                tab-content[item="buttons"] .container .row .col-12 {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                }
            </style>
            
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 d-flex flex-row justify-content-center align-items-center">
                        <k-button type="classic" primary="false" secondary="true" size="big">
                            Créer votre compte
                        </k-button>
                    </div>
                    
                    <div class="col-12 col-md-6 d-flex flex-row justify-content-center align-items-center">
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
            tab-content[item="forms"] .container .row:nth-child(2) .col-6,
            tab-content[item="forms"] .container .row:first-child .col-12 {
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