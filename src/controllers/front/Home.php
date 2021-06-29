<?php


namespace NC\controllers\front;


use NC\controllers\Layout;
use PhpLib\decorators\Route as RouteAttribute;

#[RouteAttribute('/')]
class Home extends Layout
{
    protected string $title = 'Home';

    protected array $styles = [
        'https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css',
        'https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap',
        'https://fonts.googleapis.com/icon?family=Material+Icons',
        //'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css',
        //'/assets/styles/applications.css'
    ];

    protected array $startScripts = [
        'https://unpkg.com/material-components-web@latest/dist/material-components-web.js',
        'module@/assets/ui-kit/components/index.js',
        //'module@/assets/components/project.js'
    ];

    protected string $style = <<<CSS
        body, html {
            font-family: Roboto, sans-serif;
            -moz-osx-font-smoothing: grayscale;
            -webkit-font-smoothing: antialiased;
            margin: 0;
            padding: 0;
        }

        .mdc-card__title {
            font-size: 1.25rem;
            line-height: 2rem;
            font-weight: 500;
            letter-spacing: .0125em;
            text-decoration: inherit;
            text-transform: inherit;
        }

        .mdc-card__subhead {
            font-size: .875rem;
            line-height: 1.25rem;
            font-weight: 400;
            letter-spacing: .0178571429em;
            text-decoration: inherit;
            text-transform: inherit;
            opacity: .6;
        }

        .mdc-card__supporting-text {
            font-size: .875rem;
            line-height: 1.25rem;
            font-weight: 400;
            letter-spacing: .0178571429em;
            text-decoration: inherit;
            text-transform: inherit;
            opacity: .6;
        }

        card__media + .mdc-card-wrapper__text-section {
            padding-top: 16px;
        }
        
        .mdc-card__media--16-9::before {
            margin-top: 0;
        }

        .mdc-card-wrapper__text-section {
            padding-left: 16px;
            padding-right: 16px;
        }
        
        .mdc-card__media--wrapper {
            position: relative;
        }
        
        .mdc-card__media--wrapper-slider {
            height: 500px;
            overflow: hidden;
            position: relative;
            z-index: 0;
        }
        
        .mdc-card__media--wrapper-slider__img-container {
            --width: 0px;
            --item-index: 0;
            width: var(--width);
            position: absolute;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            left: calc(var(--width) * var(--item-index));
            overflow: hidden;
        }
        
        .mdc-card__media--wrapper-slider .mdc-card__media--wrapper-slider__img-container img {
            height: 100%;
        }

        .mdc-card__media--wrapper .mdc-touch-target-wrapper {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            position: absolute;
            bottom: -25px;
            right: 0;
            left: 0;
            height: 50px;
        }
        
        .mdc-card.app-card .mdc-card__actions {
            justify-content: space-around;
        }
        
        .mdc-list {
            padding: 0;
        }
        
        a.mdc-list-item {
            padding: 16px;
        }

        .theme--primary {
            background-color: var(--mdc-theme-primary);
            color: var(--mdc-theme-on-primary);
        }
        
        .comments-bloc-card.mdc-card {
            position: relative;
        }
        
        .comments-bloc-card.mdc-card::after {
            content: '';
            display: block;
            border-radius: 100px;
            width: 100px;
            height: 100px;
            background: purple;
            background-image: url(/assets/images/nicolas-choquet.jpg);
            background-size: cover;
            border: 4px solid darkgreen;
            position: absolute;
            right: -50px;
            left: unset;
            top: -50px;
            box-shadow: 0px 2px 1px -1px rgba(0, 0, 0, 0.2),0px 1px 1px 0px rgba(0, 0, 0, 0.14),0px 1px 3px 0px rgba(0,0,0,.12);
        }
        
        .comment-card {
            margin-top: 5px;
            margin-bottom: 10px;
        }
        
        .comment-card .mdc-card-wrapper__text-section {
            display: flex;
            justify-content: start;
            align-items: start;
        }

        .comment-card .mdc-card-wrapper__text-section .profile-picture {
            width: 100px;
            height: 100px;
            overflow: hidden;
            margin-top: 5px;
            border-radius: var(--mdc-shape-medium, 4px);
        }
        
        .comment-card .mdc-card-wrapper__text-section .profile-picture img {
            width: 100%;
        }

        .comment-card .mdc-card-wrapper__text-section p {
            max-width: 1000px;
        }

        .comment-card .mdc-card-wrapper__text-section .comment-profile {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding-left: 10px;
        }

        .mdc-card__media--wrapper-slider .previous-btn,
        .mdc-card__media--wrapper-slider .next-btn {
            font-family: 'Material Icons';
            display: block;
            scale: 3;
            position: absolute;
            top: 45%;
            cursor: pointer;
            z-index: 2;
            width: 20px;
            height: 20px;
            transition: scale .3s linear;
        }

        .mdc-card__media--wrapper-slider .previous-btn:hover,
        .mdc-card__media--wrapper-slider .next-btn:hover {
            scale: 4;
        }

        .mdc-card__media--wrapper-slider .previous-btn {
            left: 20px;
        }

        .mdc-card__media--wrapper-slider .next-btn {
            right: 20px;
        }

        @media screen and (max-width: 850px) {
            .comments-bloc-card.mdc-card::after {
                right: 0;
            }
        }
    CSS;

    protected string $jsScript = <<<JS
        window.addEventListener('load', () => {
            const { MDCTopAppBar } = mdc.topAppBar;
            const { MDCDrawer } = mdc.drawer;
            const { MDCList } = mdc.list;
            const { MDCRipple } = mdc.ripple;
            
            const list = MDCList.attachTo(document.querySelector('.mdc-list'));
            list.wrapFocus = true;
            
            const topAppBar = MDCTopAppBar.attachTo(document.getElementById('app-bar'));
            const drawer = MDCDrawer.attachTo(document.querySelector('.mdc-drawer'));
            
            topAppBar.setScrollTarget(document.getElementById('main-content'));
            topAppBar.listen('MDCTopAppBar:nav', () => {
                drawer.open = !drawer.open;
            });
            
            const fabRipple = new MDCRipple(document.querySelector('.mdc-fab'));
            
            const resize = () => {
                Array.from(document.querySelectorAll('.mdc-card__media--wrapper-slider .mdc-card__media--wrapper-slider__img-container')).map((i, index) => {
                    i.style.setProperty('--width', i.parentElement.parentElement.offsetWidth + 'px')
                    i.style.setProperty('--item-index', index.toString())
                })
            }
            
            resize()
            
            window.addEventListener('resize', resize)
        });
    JS;

    protected string $menu = <<<HTML
        <header class="mdc-top-app-bar" id="app-bar">
            <div class="mdc-top-app-bar__row">
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
                    <button class="material-icons mdc-top-app-bar__navigation-icon mdc-icon-button" aria-label="Open navigation menu">menu</button>
                    
                    <img class="mdc-top-app-bar__title" src="/assets/images/nicolas-choquet-logo.png" style="width: auto; height: 100%">
                    
                    <span class="mdc-top-app-bar__title">
                        Mes applications
                    </span>
                </section>
                
                <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end" role="toolbar">
                    <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Favorite">favorite</button>
                    <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Search">search</button>
                    <button class="material-icons mdc-top-app-bar__action-item mdc-icon-button" aria-label="Options">more_vert</button>
                </section>
            </div>
        </header>
        
        <aside class="mdc-drawer mdc-drawer--modal" id="app-bar">
            <div class="mdc-drawer__content">
            <nav class="mdc-list">
                <a class="mdc-list-item mdc-list-item--activated" href="#" aria-current="page" tabindex="0">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">Mes applications</span>
                </a>
                
                <a class="mdc-list-item" href="#">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">À propos</span>
                </a>
                
                <a class="mdc-list-item" href="#">
                <span class="mdc-list-item__ripple"></span>
                <span class="mdc-list-item__text">Contact</span>
                </a>
            </nav>
            </div>
        </aside>
        
        <div class="mdc-drawer-scrim"></div>
    HTML;

    protected string $content = <<<HTML
        <main class="mdc-top-app-bar--fixed-adjust" id="main-content">
            <div class="mdc-layout-grid">
                <div class="mdc-layout-grid__inner">
                    <div class="mdc-layout-grid__cell--span-2"></div>
                    
                    <div class="mdc-layout-grid__cell--span-8">
                        <!-- projet 1 -->
                        <div class="card-container">
                            <div class="mdc-card app-card" style="margin-bottom: 70px">
                                <div class="mdc-card__media mdc-card__media--16-9 mdc-card__media--wrapper">
                                    <div class="mdc-card__media--wrapper-slider">
                                        <div class="previous-btn">chevron_left</div>

                                        <div class="mdc-card__media--wrapper-slider__img-container">
                                            <img src="data:image/svg+xml,%3Csvg%20width%3D%22344%22%20height%3D%22194%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%3E%3Cdefs%3E%3Cpath%20id%3D%22a%22%20d%3D%22M-1%200h344v194H-1z%22%2F%3E%3C%2Fdefs%3E%3Cg%20transform%3D%22translate(1)%22%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cmask%20id%3D%22b%22%20fill%3D%22%23fff%22%3E%3Cuse%20xlink%3Ahref%3D%22%23a%22%2F%3E%3C%2Fmask%3E%3Cuse%20fill%3D%22%23BDBDBD%22%20xlink%3Ahref%3D%22%23a%22%2F%3E%3Cg%20mask%3D%22url(%23b)%22%3E%3Cpath%20d%3D%22M173.65%2069.238L198.138%2027%20248%20112.878h-49.3c.008.348.011.697.011%201.046%200%2028.915-23.44%2052.356-52.355%2052.356C117.44%20166.28%2094%20142.84%2094%20113.924c0-28.915%2023.44-52.355%2052.356-52.355%2010%200%2019.347%202.804%2027.294%207.669zm0%200l-25.3%2043.64h50.35c-.361-18.478-10.296-34.61-25.05-43.64z%22%20fill%3D%22%23757575%22%2F%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" >
                                        </div>
                                        
                                        <div class="mdc-card__media--wrapper-slider__img-container">
                                            <img src="data:image/svg+xml,%3Csvg%20width%3D%22344%22%20height%3D%22194%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%3E%3Cdefs%3E%3Cpath%20id%3D%22a%22%20d%3D%22M-1%200h344v194H-1z%22%2F%3E%3C%2Fdefs%3E%3Cg%20transform%3D%22translate(1)%22%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cmask%20id%3D%22b%22%20fill%3D%22%23fff%22%3E%3Cuse%20xlink%3Ahref%3D%22%23a%22%2F%3E%3C%2Fmask%3E%3Cuse%20fill%3D%22%23BDBDBD%22%20xlink%3Ahref%3D%22%23a%22%2F%3E%3Cg%20mask%3D%22url(%23b)%22%3E%3Cpath%20d%3D%22M173.65%2069.238L198.138%2027%20248%20112.878h-49.3c.008.348.011.697.011%201.046%200%2028.915-23.44%2052.356-52.355%2052.356C117.44%20166.28%2094%20142.84%2094%20113.924c0-28.915%2023.44-52.355%2052.356-52.355%2010%200%2019.347%202.804%2027.294%207.669zm0%200l-25.3%2043.64h50.35c-.361-18.478-10.296-34.61-25.05-43.64z%22%20fill%3D%22%23757575%22%2F%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" >
                                        </div>
                                        
                                        <div class="mdc-card__media--wrapper-slider__img-container">
                                            <img src="data:image/svg+xml,%3Csvg%20width%3D%22344%22%20height%3D%22194%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%3E%3Cdefs%3E%3Cpath%20id%3D%22a%22%20d%3D%22M-1%200h344v194H-1z%22%2F%3E%3C%2Fdefs%3E%3Cg%20transform%3D%22translate(1)%22%20fill%3D%22none%22%20fill-rule%3D%22evenodd%22%3E%3Cmask%20id%3D%22b%22%20fill%3D%22%23fff%22%3E%3Cuse%20xlink%3Ahref%3D%22%23a%22%2F%3E%3C%2Fmask%3E%3Cuse%20fill%3D%22%23BDBDBD%22%20xlink%3Ahref%3D%22%23a%22%2F%3E%3Cg%20mask%3D%22url(%23b)%22%3E%3Cpath%20d%3D%22M173.65%2069.238L198.138%2027%20248%20112.878h-49.3c.008.348.011.697.011%201.046%200%2028.915-23.44%2052.356-52.355%2052.356C117.44%20166.28%2094%20142.84%2094%20113.924c0-28.915%2023.44-52.355%2052.356-52.355%2010%200%2019.347%202.804%2027.294%207.669zm0%200l-25.3%2043.64h50.35c-.361-18.478-10.296-34.61-25.05-43.64z%22%20fill%3D%22%23757575%22%2F%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" >
                                        </div>

                                        <div class="next-btn">chevron_right</div>
                                    </div>
                                
                                    <div class="mdc-touch-target-wrapper">
                                        <button class="mdc-fab mdc-fab--mini mdc-fab--touch theme--primary">
                                            <div class="mdc-fab__ripple"></div>
                                            <span class="material-icons">arrow_back_ios_new</span>
                                            <div class="mdc-fab__touch"></div>
                                        </button>
                                        
                                        <button class="mdc-fab mdc-fab--mini mdc-fab--touch theme--primary">
                                            <div class="mdc-fab__ripple"></div>
                                            <span class="material-icons">arrow_forward_ios</span>
                                            <div class="mdc-fab__touch"></div>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="mdc-card-wrapper__text-section">
                                    <h2 class="mdc-card__title">Norsys Présences</h2>
                                    
                                    <h3 class="mdc-card__subhead">Gestion de présences dans les agences Norsys</h3>
                                </div>
                                
                                <div class="mdc-card-wrapper__text-section">
                                    <p class="mdc-card__supporting-text">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, deleniti dignissimos eius eligendi excepturi facilis in laudantium magni, modi odio odit quasi rem saepe sequi vel. A beatae dolorem placeat sunt tempore. Aliquid assumenda commodi, illum incidunt ipsa ipsam iure laborum nobis placeat quibusdam recusandae, sed sunt ut veniam voluptatum.
                                    </p>
                                </div>
                                
                                <div class="mdc-card__actions">
                                    <button class="mdc-button mdc-card__action mdc-card__action--button mdc-ripple-upgraded">
                                        <span class="mdc-button__label">https://github.com/nicolachoquet06250/nicolaschoquet.fr.git</span>
                                        <div class="mdc-button__ripple"></div>
                                    </button>
                                    
                                    <span>Créé le 18/06/2021</span>
                                </div>
                            </div>
                            
                            <div class="mdc-card comments-bloc-card" style="margin-bottom: 20px;">
                                <div class="mdc-card-wrapper__text-section">
                                    <h2 class="mdc-card__title">Commentaires</h2>
                                </div>
                                
                                <div class="mdc-card-wrapper__text-section">
                                    <k-input type="textarea" placeholder="Saisisser votre commentaire ici..."></k-input>
                                </div>
                                
                                <div class="mdc-card__actions">
                                    <button class="mdc-button mdc-card__action mdc-card__action--button mdc-ripple-upgraded">
                                        <span class="mdc-button__label">Envoyer</span>
                                        <div class="mdc-button__ripple"></div>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="mdc-card comments-card">
                                <div class="mdc-card-wrapper__text-section">
                                    <div class="mdc-card comment-card">
                                        <div class="mdc-card-wrapper__text-section">
                                            <div class="profile-picture">
                                                <img src="/assets/images/nicolas-choquet.jpg">
                                            </div>
                                        
                                            <div class="comment-profile">
                                                <h2 class="mdc-card__title">Moi</h2>
                                                
                                                <h3>Hier</h3>
                                            </div>
                                        </div>
                                    
                                        <div class="mdc-card-wrapper__text-section">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab deleniti, ex expedita incidunt laboriosam nesciunt perspiciatis quidem quo soluta tenetur?
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <div class="mdc-card comment-card">
                                        <div class="mdc-card-wrapper__text-section">
                                            <div class="profile-picture">
                                                <img src="/assets/images/maman-et-yann.jpg">
                                            </div>
                                        
                                            <div class="comment-profile">
                                                <h2 class="mdc-card__title">Karine A.</h2>
                                                
                                                <h3>Il y a 2 jours</h3>
                                            </div>
                                        </div>
                                    
                                        <div class="mdc-card-wrapper__text-section">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab deleniti, ex expedita incidunt laboriosam nesciunt perspiciatis quidem quo soluta tenetur?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mdc-layout-grid__cell--span-2"></div>
                </div>
            </div>
        </main>
        
        <!--<div class="container-fluid">
            <div class="row" id="top"></div>
            <div class="row">
                <div class="col-lg-2 d-flex flex-column justify-content-center align-items-center button-container">
                    <button class="button previous">
                        <img src="/assets/images/chevron-right-left.svg">
                    </button>
                </div>

                <div class="col-12 col-lg-8 apps-card-container">
                    <apps-card id="item-0" user='{"firstname": "Nicolas", "lastname": "Choquet", "picture": "/assets/images/nicolas-choquet.jpg"}'
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

                    <apps-card id="item-1" user='{"firstname": "Nicolas", "lastname": "Choquet", "picture": "/assets/images/nicolas-choquet.jpg"}'
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
        </div>-->
    HTML;
}