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

        nav + .container {
            margin-top: 50px;
        }
        
        nav {
            border-bottom: 2px solid #5e17eb;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1;
            background: white;
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
            border-radius: 25px;
            border: 2px solid darkgreen;
            margin-left: 5px;
            background-size: cover;
            background-position: center;
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .account-card > .profile-picture > img {
            width: 100%;
            height: 100%;
            border-radius: 25px;
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
            background: #d8d8d8;
            padding-bottom: 10px;
            border-radius: 15px;
        }
        
        .apps-card > .header {
            width: 100%;
            height: 400px;
            box-sizing: border-box;
            position: relative;
            display: flex;
            clip-path: polygon(0 0, 100% 0, 100% 74%, 0% 100%);
            border: 2px solid #5e17eb;
            border-radius: 15px 15px 0 0;
        }

        .apps-card > .header > img {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 400px;
            width: 100%;
            clip-path: polygon(0 0, 100% 0, 100% 74%, 0% 100%);
            border-radius: 15px 15px 0 0;
        }
        
        .apps-card > .header + h1 {
            transform: rotate(-16deg);
            position: absolute;
            right: 10px;
            top: 330px;
            font-weight: 700;
        }

        @media screen and (min-width: 992px) {
            .apps-card > .header + h1 {
                transform: rotate(-14deg);
                position: absolute;
                right: 10px;
                top: 330px;
            }
        }

        @media screen and (min-width: 1200px) {
            .apps-card > .header + h1 {
                transform: rotate(-9.7deg);
                position: absolute;
                right: 10px;
                top: 330px;
            }
        }

        #norsys-presences-tabs {
            display: inline-block;
            margin-top: 20px;
            margin-left: 30px;
            margin-right: 30px;
            width: auto;
        }

        #norsys-presences-tabs p {
            padding-left: 10px;
        }

        .apps-card > .header + h1 + tabs-container + .footer {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding-left: 40px;
            padding-right: 40px;
        }

        .apps-card > .header + h1 + tabs-container + .footer + hr {
            height: 2px;
            color: white;
        }

        .comment-form-bloc {
            height: 300px;
            width: auto;
            padding-left: 10px;
            padding-right: 10px;
            margin-left: 10px;
            margin-right: 10px;
            margin-top: 70px;
            background: white;
            position: relative;
            border-radius: 15px;
        }

        .comment-form-bloc .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 100px;
            border: 4px solid green;
            position: absolute;
            top: -50px;
            background: white;
            left: calc(50% - 50px);
        }

        .comment-form-bloc .profile-picture img {
            width: 100%;
            height: 100%;
            border-radius: 100px;
        }

        .comment-form-bloc .input-group {
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: end;
            top: 80px;
        }

        .comment-form-bloc .input-group > k-input {
            width: 100%;
            margin-bottom: 10px;
        }

        .comments {
            display: flex;
            flex-direction: column;
            justify-content: start;
            align-items: start;
            margin-top: 15px;
            margin-left: 10px;
            margin-right: 10px;
        }

        .comments .comment {
            display: flex;
            flex-direction: row;
        }

        .comments .comment {
            width: 80%;
            border: 1px solid white;
            margin-bottom: 25px;
        }

        .comments .right-comment .left-bloc,
        .comments .left-comment .right-bloc {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding-left: 10px;
        }

        .comments .comment .comment-head {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        .comments .comment .comment-text {
            margin-top: 10px;
        }

        .comments .comment .comment-head .poster {
            margin-right: 10px;
            font-weight: 700;
        }

        .comments .comment .profile-picture, 
        .comments .comment .profile-picture img {
            max-width: 60px;
            height: auto;
        }

        .comments .right-comment {
            align-self: end;
        }

        .comments .comment .profile-picture {
            height: 60px;
            overflow: hidden;
            background: white;
        }

        .comments .right-comment.online {
            border-left: 4px solid darkgreen;
        }

        .comments .left-comment.online {
            border-right: 4px solid darkgreen;
        }

        .comments .comment.online .profile-picture {
            border: 2px solid darkgreen;
        }

        .comments .right-comment.outline {
            border-left: 4px solid darkred;
        }

        .comments .left-comment.outline {
            border-right: 4px solid darkred;
        }

        .comments .comment.outline .profile-picture {
            border: 2px solid darkred;
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
        <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
                <div class="apps-card">
                    <div class="header">
                        <img src="/assets/images/norsys-presences.png">
                    </div>

                    <h1>Norsys Présences</h1>
                    
                    <tabs-container id="norsys-presences-tabs" active-tab="description">
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

                    <div class="footer">
                        <a href="#">https://github.com/nicolachoquet06250/norsys-pr...</a>
                        <span>Créé il y a 2 jours</span>
                    </div>

                    <hr />

                    <div class="comment-form-bloc">
                        <div class="profile-picture">
                            <img src="https://scontent-frt3-1.xx.fbcdn.net/v/t1.6435-9/122094899_1645210225659993_4058643094356988337_n.jpg?_nc_cat=107&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=UXd0bbB0aC8AX-HtVo5&_nc_ht=scontent-frt3-1.xx&oh=652deb1690fd09620b4cb406c9d12ff6&oe=60CF5D6E" />
                        </div>
                        <div class="input-group">
                            <k-input type="textarea" value="" placeholder="Saisissez votre commentaire ici ..."></k-input>

                            <k-button type="classic" primary="false" secondary="true" size="big">
                                Envoyer
                            </k-button>
                        </div>
                    </div>

                    <div class="comments">
                        <div class="comment right-comment online">
                            <div class="left-bloc">
                                <div class="comment-head">
                                    <span class="date"> Hier </span>
                                    <div class="poster"> Moi </div>
                                </div>

                                <div class="comment-text">
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi debitis iure amet quidem dolorum omnis dolor. 
                                        Fugit, optio eveniet ratione eos animi soluta architecto laboriosam aspernatur fuga dolorem placeat eius culpa, 
                                        reprehenderit laborum rerum tempora maxime, error possimus facilis ut vitae necessitatibus omnis inventore explicabo. 
                                        Tempora quisquam maiores cupiditate magnam.
                                    </p>
                                </div>
                            </div>

                            <div class="right-bloc">
                                <div class="profile-picture">
                                    <img src="https://scontent-frt3-1.xx.fbcdn.net/v/t1.6435-9/122094899_1645210225659993_4058643094356988337_n.jpg?_nc_cat=107&ccb=1-3&_nc_sid=09cbfe&_nc_ohc=UXd0bbB0aC8AX-HtVo5&_nc_ht=scontent-frt3-1.xx&oh=652deb1690fd09620b4cb406c9d12ff6&oe=60CF5D6E" />
                                </div>
                            </div>
                        </div>

                        <div class="comment left-comment outline">
                            <div class="left-bloc">
                                <div class="profile-picture">
                                    <img src="https://scontent-frt3-1.xx.fbcdn.net/v/t1.6435-9/100074061_3340287869337371_1716245584039378944_n.jpg?_nc_cat=104&ccb=1-3&_nc_sid=ad2b24&_nc_ohc=2VpF1gjF59AAX-2ZxfS&_nc_ht=scontent-frt3-1.xx&oh=0a314efbcc62e949a58bd76924d7e66b&oe=60D0686F" />
                                </div>
                            </div>

                            <div class="right-bloc">
                                <div class="comment-head">
                                    <span class="date"> Il y a 2 jours </span>
                                    <div class="poster"> Karine A. </div>
                                </div>

                                <div class="comment-text">
                                    <p>
                                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Commodi debitis iure amet quidem dolorum omnis dolor. 
                                        Fugit, optio eveniet ratione eos animi soluta architecto laboriosam aspernatur fuga dolorem placeat eius culpa, 
                                        reprehenderit laborum rerum tempora maxime, error possimus facilis ut vitae necessitatibus omnis inventore explicabo. 
                                        Tempora quisquam maiores cupiditate magnam.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    HTML;
}