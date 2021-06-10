import { Component } from "./component.js";


export class TabsContainer extends Component {
    static get selector() {
        return 'tabs-container';
    }

    static get observedAttributes() {
        return ['active-tab'];
    }

    get useShadow() {
        return true;
    }

    get componentTemplate() {
        return `
        <nav class="tabs">
            <slot></slot>
        </nav>
        
        <slot name="content"></slot>
        `;
    }

    get componentStyle() {
        return `
        <style>
            ${this.cssComponentId} {
                width: 100%;
            }
        </style>
        `;
    }

    get activeTab() {
        return this.getAttribute('active-tab');
    }

    set activeTab(activeTab) {
        this.setAttribute('active-tab', activeTab);
    }

    onActiveTabChanged() {
        const items = Array.from(this.querySelector('tab-items').querySelectorAll('tab-item')).map(i => {
            i.active = i.item === this.activeTab
            return i;
        });

        const elements = items.map(i => [i.active, i.item]);

        Array.from(this.querySelectorAll('tab-content')).map(i => {
            i.active = i.item === this.activeTab
            return i;
        });

        elements.map(arr => {
            if (arr[0]) {
                const tabWillActive = this.querySelector(`tab-content[item="${arr[1]}"]`);
                if (tabWillActive) {
                    tabWillActive.active = true;
                }
            }
        })
    }

    connectedCallback() {
        const items = this.querySelector('tab-items');

        items.addEventListener('all-items-loaded', e => {
            let items = e.detail.items;

            items = items.map(i => {
                i.active = i.item === this.activeTab
                return i;
            });

            const elements = items.map(i => [i.active, i.item]);

            Array.from(this.querySelectorAll('tab-content')).map(i => {
                i.active = i.item === this.activeTab
                return i;
            });

            elements.map(arr => {
                if (arr[0]) {
                    const tabWillActive = this.querySelector(`tab-content[item="${arr[1]}"]`);
                    if (tabWillActive) {
                        tabWillActive.active = true;
                    }
                }
            })
        })
    }
}

export class TabItems extends Component {
    static get selector() {
        return 'tab-items';
    }

    get useShadow() {
        return true;
    }

    get componentTemplate() {
        return `<ul class="tab-list">
            <slot></slot>
        </ul>`;
    }

    get componentStyle() {
        return `
        <style>
            ${this.cssComponentId} {
                width: 100%;
            }
            
            ${this.cssComponentId} .tab-list {
                list-style: none;
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                padding-left: 0;
                border-bottom: 1px solid black;
            }
        </style>
        `;
    }

    connectedCallback() {
        const items = Array.from(this.querySelectorAll('tab-item'));

        this.dispatchEvent(new CustomEvent('all-items-loaded', {
            detail: {
                items
            }
        }));
    }
}

export class TabItem extends Component {
    static get selector() {
        return 'tab-item';
    }

    static get observedAttributes() {
        return ['active'];
    }

    get useShadow() {
        return true;
    }

    get componentTemplate() {
        return `
        <li class="tab-item ${this.active ? 'active' : ''}"> 
            <slot></slot>
        </li>
        `;
    }

    get componentStyle() {
        return `
        <style>
            ${this.cssComponentId} {
                width: 100%;
            }
            
            ${this.cssComponentId} .tab-item {
                display: flex;
                width: 100%;
                height: 50px;
                justify-content: center;
                align-items: center;
                color: black;
                text-decoration: none;
                cursor: pointer;
                font-size: 1.5rem;
            }
            
            ${this.cssComponentId} .tab-item.active {
                border-bottom: 2px solid black;
            }
        </style>
        `;
    }

    get active() {
        return this.hasAttribute('active') && this.getAttribute('active') === 'true';
    }

    set active(active) {
        this.setAttribute('active', (active ? 'true' : 'false'));
    }

    get title() {
        return this.getAttribute('title');
    }

    set title(title) {
        this.setAttribute('title', title);
    }

    get item() {
        return this.getAttribute('item');
    }

    set item(item) {
        this.setAttribute('item', item);
    }

    onActiveChanged() {
        this.render();
    }

    connectedCallback() {
        this.addEventListener('click', e => {
            e.preventDefault();

            this.parentElement.parentElement.activeTab = this.item;
        })
    }
}

export class TabContent extends Component {
    static get selector() {
        return 'tab-content';
    }

    static get observedAttributes() {
        return ['active'];
    }

    get useShadow() {
        return true;
    }

    get componentTemplate() {
        return `
        <div class="tab-content ${this.active ? 'active' : ''}">
            <slot></slot>
        </div>
        `;
    }

    get componentStyle() {
        return `
        <style>
            ${this.cssComponentId} .tab-content {
                display: none;
            }
            
            ${this.cssComponentId} .tab-content.active {
                display: block;
            }
        </style>
        `;
    }

    get item() {
        return this.getAttribute('item');
    }

    set item(item) {
        this.setAttribute('item', item);
    }

    get active() {
        return this.getAttribute('active') && this.getAttribute('active') === 'true';
    }

    set active(active) {
        this.setAttribute('active', (active ? 'true' : 'false'));
    }

    onActiveChanged() {
        this.render();
    }
}