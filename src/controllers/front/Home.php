<?php


namespace NC\controllers\front;


use NC\controllers\Layout;
use PhpLib\decorators\Route as RouteAttribute;

#[RouteAttribute('/')]
class Home extends Layout
{
    protected string $title = 'Home';

    protected array $styles = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css',
        '/assets/styles/applications.css'
    ];

    protected array $startScripts = [
        'module@/assets/ui-kit/components/index.js',
        'module@/assets/components/project.js'
    ];

    protected string $jsScript = <<<JS
        window.addEventListener('load', () => {
            const cards = Array.from(document.querySelectorAll('apps-card'));
            const cardWidth = () => document.querySelector('apps-card').offsetWidth;
            const cardHeight = () => document.querySelector('apps-card').offsetHeight;
            const cardsContainer = document.querySelector('.apps-card-container');
            const resizeCards = () => {
                cardsContainer.style.setProperty('--item-height', cardHeight() + 'px');

                let cmp = 0;
                for (let card of cards) {
                    card.style.left = cmp * cardWidth() + 'px';
                    cmp++;
                }
            }

            cardsContainer.style.setProperty('--item-width', cardWidth() + 'px');

            resizeCards();

            window.addEventListener('resize', () => {
                resizeCards();
            })

            document.querySelector('.button.next').addEventListener('click', () => {
                const currentItemId = parseInt((cardsContainer.getAttribute('data-current') ?? '0'));
                let lastItemId = currentItemId + 1;

                if (!document.querySelector('#item-' + lastItemId)) {
                    lastItemId = 0;
                }

                window.location.href = '#item-' + lastItemId;

                cardsContainer.setAttribute('data-current', lastItemId)
            })

            document.querySelector('.button.previous').addEventListener('click', () => {
                const currentItemId = parseInt((cardsContainer.getAttribute('data-current') ?? '0'));
                let lastItemId = currentItemId - 1;

                if (!document.querySelector('#item-' + lastItemId)) {
                    lastItemId = cards.length - 1;
                }

                window.location.href = '#item-' + lastItemId;

                cardsContainer.setAttribute('data-current', lastItemId)
            })

            document.querySelector('.button.to-top').addEventListener('click', () => {
                window.location.href = "#top"
            });
        })
    JS;

    protected string $menu = <<<HTML
    <nav>
        <div>
            <div class="logo"></div>
            <div>
                <ul>
                    <li class="active">Applications</li>
                    <li>Videos</li>
                    <li>A propos</li>
                    <li>Contact</li>
                </ul>
            </div>
            <div class="account-card">
                <div class="profile-picture">
                    <img src="https://scontent-frt3-1.xx.fbcdn.net/v/t1.6435-9/122094899_1645210225659993_4058643094356988337_n.jpg?_nc_cat=107&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=UXd0bbB0aC8AX-HtVo5&_nc_ht=scontent-frt3-1.xx&oh=652deb1690fd09620b4cb406c9d12ff6&oe=60CF5D6E">
                </div>
                
                <span class="full-name">Nicolas C.</span>
                
                <button type="button" class="settings">
                    <svg id="i-settings" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M13 2 L13 6 11 7 8 4 4 8 7 11 6 13 2 13 2 19 6 19 7 21 4 24 8 28 11 25 13 26 13 30 19 30 19 26 21 25 24 28 28 24 25 21 26 19 30 19 30 13 26 13 25 11 28 8 24 4 21 7 19 6 19 2 Z" />
                        <circle cx="16" cy="16" r="4" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
    HTML;

    protected string $content = <<<HTML
    <div class="container-fluid">
        <div class="row" id="top"></div>
        <div class="row">
            <div class="col-lg-2 d-flex flex-column justify-content-center align-items-center button-container">
                <button class="button previous">
                    <img src="/assets/images/chevron-right-left.svg">
                </button>
            </div>

            <div class="col-12 col-lg-8 apps-card-container">
                <apps-card id="item-0" user='{"firstname": "Nicolas", "lastname": "Choquet", "picture": "https://scontent-frt3-1.xx.fbcdn.net/v/t1.6435-9/122094899_1645210225659993_4058643094356988337_n.jpg?_nc_cat=107&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=UXd0bbB0aC8AX-HtVo5&_nc_ht=scontent-frt3-1.xx&oh=652deb1690fd09620b4cb406c9d12ff6&oe=60CF5D6E"}'
                            github-link="https://github.com/nicolachoquet06250/norsys-pr..."
                            created-at="Créé le 18/06/2021">
                    <img src="/assets/images/norsys-presences.png" slot="header-img">
                    <img src="/assets/images/norsys-presences.png" slot="header-img">

                    <h1 slot="body">Norsys Présences</h1>
                    
                    <tabs-container id="norsys-presences-tabs" active-tab="description" slot="body">
                        <tab-items>
                            <tab-item active="false" title="Description" item="description"> Description </tab-item>
                        </tab-items>
                        
                        <tab-content slot="content" item="description">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                                Accusantium adipisci, animi, culpa cupiditate dicta eius eveniet ex, iusto maxime modi natus necessitatibus nobis obcaecati quaerat qui quia quidem rerum sint soluta vitae. 
                                Aut doloremque ducimus esse expedita incidunt minima repellendus sint sit vel velit! Aspernatur doloremque nostrum optio quibusdam sint.
                            </p>
                        </tab-content>
                    </tabs-container>
                </apps-card>

                <apps-card id="item-1" user='{"firstname": "Nicolas", "lastname": "Choquet", "picture": "https://scontent-frt3-1.xx.fbcdn.net/v/t1.6435-9/122094899_1645210225659993_4058643094356988337_n.jpg?_nc_cat=107&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=UXd0bbB0aC8AX-HtVo5&_nc_ht=scontent-frt3-1.xx&oh=652deb1690fd09620b4cb406c9d12ff6&oe=60CF5D6E"}'
                            github-link="https://github.com/nicolachoquet06250/norsys-pr..."
                            created-at="Créé le 18/06/2021">
                    <img src="/assets/images/norsys-presences.png" slot="header-img">

                    <h1 slot="body">Norsys Présences 2</h1>
                    
                    <tabs-container id="norsys-presences-tabs" active-tab="description" slot="body">
                        <tab-items>
                            <tab-item active="false" title="Description" item="description"> Description </tab-item>
                        </tab-items>
                        
                        <tab-content slot="content" item="description">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                                Accusantium adipisci, animi, culpa cupiditate dicta eius eveniet ex, iusto maxime modi natus necessitatibus nobis obcaecati quaerat qui quia quidem rerum sint soluta vitae. 
                                Aut doloremque ducimus esse expedita incidunt minima repellendus sint sit vel velit! Aspernatur doloremque nostrum optio quibusdam sint.
                            </p>
                        </tab-content>
                    </tabs-container>
                </apps-card>
            </div>

            <div class="col-lg-2 d-flex flex-column justify-content-center align-items-center button-container">
                <button class="button next">
                    <img src="/assets/images/chevron-right-left.svg">
                </button>

                <button class="button to-top">
                    <img src="/assets/images/chevron-top.svg">
                </button>
            </div>
        </div>
    </div>
    HTML;
}