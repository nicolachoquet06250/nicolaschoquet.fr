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
        'module@/assets/ui-kit/components/index.js'
    ];

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
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="apps-card">
                    <div class="header">
                        <img src="/assets/images/norsys-presences.png">
                    </div>

                    <div class="body">
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