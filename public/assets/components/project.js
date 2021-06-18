import {Component} from '../ui-kit/components/component.js';

export class Project extends Component {
    get useShadow() {
        return true;
    }

    static get selector() {
        return 'apps-card';
    }

    get componentTemplate() {
        return `
        <div class="apps-card">
            <div class="header">
                <slot name="header-img"></slot>
            </div>

            <div class="body">
                <slot name="body"></slot>

                <div class="footer">
                    <a href="#">${this.githubLink}.</a>
                    <span>${this.createdAt}</span>
                </div>

                <hr>

                <div class="comment-form-bloc">
                    <div class="profile-picture">
                        <img src="${this.user.picture}">
                    </div>

                    <div class="input-group">
                        <k-input type="textarea" value="" placeholder="Saisissez votre commentaire ici ..."></k-input>
                        <k-button type="classic" secondary="true" size="big"> Envoyer </k-button>
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
                            <img src="/assets/images/maman-et-yann.jpg" />
                        </div>
                    </div>

                    <div class="right-bloc">
                        <div class="comment-head">
                            <div class="poster"> Karine A. </div>
                            <span class="date"> Il y a 2 jours </span>
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
        `;
    }

    get componentStyle() {
        return `
        <style>
            ${this.cssComponentId} {
                display: block;
                width: 100%;
            }

            .apps-card {
                width: 100%;
                height: max-content;
                margin-top: 5px;
                position: relative;
                background: #d8d8d8;
                padding-bottom: 10px;
                border-radius: 15px 15px 0 0;
            }

            .apps-card > .header {
                width: 100%;
                height: 400px;
                box-sizing: border-box;
                position: relative;
                display: flex;
                clip-path: polygon(0 0, 100% 0, 100% 74%, 0% 100%);
                border-radius: 15px 15px 0 0;
            }

            .apps-card > .header > ::slotted(img) {
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 400px;
                width: 100%;
                clip-path: polygon(0 0, 100% 0, 100% 74%, 0% 100%);
                border-radius: 15px 15px 0 0;
            }

            .apps-card > .header + .body ::slotted(h1) {
                text-align: right;
                padding-right: 10px;
                font-weight: 700;
            }

            .apps-card ::slotted(tabs-container) {
                display: inline-block;
                margin-top: 20px;
                margin-left: 30px;
                margin-right: 30px;
                width: auto;
            }

            .apps-card ::slotted(tabs-container) p {
                padding-left: 10px;
            }

            .apps-card > .header + .body .footer {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                padding-left: 40px;
                padding-right: 40px;
            }

            .apps-card > .header .body .footer + hr {
                height: 2px;
                color: white;
            }

            .apps-card .comment-form-bloc {
                width: auto;
                padding-left: 10px;
                padding-right: 10px;
                margin-left: 10px;
                margin-right: 10px;
                margin-top: 70px;
                background: white;
                position: relative;
                border-radius: 15px;
                padding-bottom: 20px;
            }

            .apps-card .comment-form-bloc .profile-picture {
                width: 100px;
                height: 100px;
                border-radius: 100px;
                border: 4px solid green;
                position: absolute;
                top: -50px;
                background: white;
                left: calc(50% - 50px);
            }

            .apps-card .comment-form-bloc .profile-picture img {
                width: 100%;
                height: 100%;
                border-radius: 100px;
            }

            .apps-card .comment-form-bloc .input-group {
                display: flex;
                flex-direction: column;
                justify-content: start;
                align-items: end;
                padding-top: 60px;
            }

            .apps-card .comment-form-bloc .input-group > k-input {
                width: 100%;
                margin-bottom: 10px;
                display: flex;
            }

            .apps-card .comments {
                display: flex;
                flex-direction: column;
                justify-content: start;
                align-items: start;
                margin-top: 15px;
                margin-left: 10px;
                margin-right: 10px;
            }

            .apps-card .comments .comment {
                display: flex;
                flex-direction: row;
            }

            .apps-card .comments .comment {
                width: 100%;
                border: 1px solid white;
                margin-bottom: 25px;
            }

            .apps-card .comments .right-comment .left-bloc,
            .apps-card .comments .left-comment .right-bloc {
                display: flex;
                flex: 1;
                flex-direction: column;
                padding-left: 10px;
            }

            .apps-card .comments .comment .comment-head {
                width: 100%;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            .apps-card .comments .comment .comment-text {
                margin-top: 10px;
            }

            .apps-card .comments .comment .comment-head .poster {
                margin-right: 10px;
                font-weight: 700;
            }

            .apps-card .comments .comment .comment-head .date {
                margin-right: 10px;
            }

            .apps-card .comments .comment .profile-picture, 
            .apps-card .comments .comment .profile-picture img {
                max-width: 60px;
                height: auto;
            }

            .apps-card .comments .right-comment {
                align-self: end;
            }

            .apps-card .comments .comment .profile-picture {
                height: 60px;
                overflow: hidden;
                background: white;
            }

            .apps-card .comments .right-comment.online {
                border-left: 4px solid darkgreen;
            }

            .apps-card .comments .left-comment.online {
                border-right: 4px solid darkgreen;
            }

            .apps-card .comments .comment.online .profile-picture {
                border: 2px solid darkgreen;
            }

            .apps-card .comments .right-comment.outline {
                border-left: 4px solid darkred;
            }

            .apps-card .comments .left-comment.outline {
                border-right: 4px solid darkred;
            }

            .apps-card .comments .comment.outline .profile-picture {
                border: 2px solid darkred;
            }



            @media screen and (min-width: 992px) {
                .apps-card > .header + .body ::slotted(h1) {
                    position: absolute;
                    right: 10px;
                    top: 330px;
                }
            }

            @media screen and (min-width: 1200px) {
                .apps-card {
                    display: inline-block;
                    width: 100%;
                    height: max-content;
                    margin-top: 5px;
                    position: relative;
                    background: #d8d8d8;
                    padding-bottom: 10px;
                    border-radius: 15px;
                    margin-bottom: 20px;
                }

                .apps-card > .header + .body ::slotted(h1) {
                    transform: rotate(-7deg);
                    position: absolute;
                    right: 10px;
                    top: 330px;
                }

                .apps-card .comment-form-bloc {
                    padding-left: 30px;
                    padding-right: 30px;
                    margin-left: 100px;
                    margin-right: 100px;
                }

                .apps-card .comments .comment {
                    width: 80%;
                }
            }
        </style>
        `;
    }

    get user() {
        return JSON.parse(this.getAttribute('user')) ?? {};
    }
    set user(user) {
        this.setAttribute('user', JSON.stringify(user));
    }

    get createdAt() {
        return this.getAttribute('created-at') ?? new Date().toLocaleDateString('fr-FR');
    }

    get githubLink() {
        return this.getAttribute('github-link') ?? 'https://github.com/nicolachoquet06250?tab=repositories';
    }
}

Project.create();