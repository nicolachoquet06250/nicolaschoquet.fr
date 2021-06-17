<?php


namespace NC\controllers\front;


use NC\controllers\Layout;
use PhpLib\decorators\Route as RouteAttribute;

#[RouteAttribute('/')]
class Home extends Layout
{
    protected string $title = 'Home';

    protected array $styles = [
        'https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css'
    ];

    protected array $startScripts = [
        'module@/assets/ui-kit/components/index.js'
    ];

    protected string $style = <<<CSS
        body, html {
            margin: 0;
            padding: 0;
            font-family: "HoloLens MDL2 Assets", sans-serif;
        }
        
        nav {
            border-bottom: 2px solid #5e17eb;
        }
    
        nav > div {
            display: flex;
            flex-direction: row;
        }
        
        nav > div > div:nth-child(2) {
            width: 100%;
            display: flex;
        }
        
        .logo {
            height: 50px;
            width: 60px;
            background-image: url(/assets/images/nicolas-choquet-logo.png);
            background-position: right;
            background-size: contain;
            background-repeat: no-repeat;
            padding-left: 10px;
        }

        ul {
            padding-left: 0;
            list-style: none;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            flex: 0.5;
            margin: 0;
        }

        ul > li {
            display: flex;
            width: 100%;
            justify-content: center;
            align-items: center;
            height: 50px;
            font-weight: 700;
            position: relative;
        }

        ul > li.active:after {
            content: '';
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #5e17eb;
        }

        .account-card {
            border-radius: 5px;
            height: 40px;
            width: 150px;
            border: 1px solid #5e17eb;
            align-self: center;
            margin-right: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center; 
        }
        
        .account-card > .profile-picture {
            width: 25px;
            height: 25px;
            border-radius: 25px;
            border: 2px solid darkgreen;
            margin-left: 5px;
            background-size: cover;
            background-position: center;
            background-color: white;
            background-image: url(/assets/images/nicolas-choquet-logo.png);
        }
        
        .account-card > .full-name {
            font-weight: 600;
            font-size: 12px;
        }

        .account-card > button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .account-card > button > svg {
            scale: 0.5;
        }
        
        .apps-card {
            width: 100%;
            height: max-content;
            margin-top: 5px;
            position: relative;
        }
        
        .apps-card > .header {
            width: 100%;
            height: 400px;
            box-sizing: border-box;
            position: relative;
            display: flex;
            clip-path: polygon(0 0, 100% 0, 100% 74%, 0% 100%);
        }
        
        .apps-card > .header:after {
            content: ''; 
            position: absolute;
            right: -5px;
            left: -5px;
            top: calc(100% - 54px);
            background: #5e17eb;
            height: 2px;
            transform: rotate(-9.7deg);
        }

        .apps-card > .header > img {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 400px;
            width: 100%;
            clip-path: polygon(0 0, 100% 0, 100% 74%, 0% 100%);
        }
        
        .apps-card > .header + h1 {
            transform: rotate(-9.7deg);
            position: absolute;
            right: 0;
            top: 340px;
        }
    CSS;

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
                <div class="profile-picture"></div>
                
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
            <div class="row">
                <div class="col-6 offset-3">
                    <div class="apps-card">
                         <div class="header">
                            <img src="/assets/images/norsys-presences.png">
                         </div>
                        <h1>Norsys Présences</h1>
                        
                        <tabs-container active-tab="description">
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
                    </div>
                </div>
            </div>
        </div>
    HTML;
}