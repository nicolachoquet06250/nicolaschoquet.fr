export class Component extends HTMLElement {
    static get selector() {
        return 'my-component';
    }

    get useShadow() {
        return false;
    }

    set template(val) {
        this._templateVars = val;
    }
    get template() {
        let template = `
			${this.componentStyle}
			${this.componentTemplate}
		`;
        for (let k of Object.keys(this._templateVars || {})) {
            template = template.replace(k, this._templateVars[k])
        }

        return template;
    }

    get root() {
        return this.useShadow ? this.shadow : this;
    }

    get componentTemplate() {
        return ``;
    }

    get componentStyle() {
        return ``;
    }

    get uniqId() {
        const id = () => Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
        if (!this._uniqId) {
            this._uniqId = id() + id();
        }
        return this._uniqId;
    }

    get cssComponentId() {
        if (this.useShadow) {
            return ':host';
        } else {
            return `[data-component_id="${this.uniqId}"]`;
        }
    }

    constructor() {
        super();

        this.setAttribute('data-component_id', this.uniqId);

        if (this.useShadow) {
            this.shadow = this.attachShadow({ mode: 'closed' });
        }

        this.render();
    }

    render() {
        if (this.useShadow) {
            this.shadow.innerHTML = this.template;
        } else {
            this.innerHTML = this.template;
        }
    }

    attributeChangedCallback(name, oldV, newV) {
        const getCallbackNamePartFromName = name => name.split('-')
            .map(p => `${p.substr(0, 1).toUpperCase()}${p.substr(1, p.length - 1).toLowerCase()}`)
            .join('')
        const onChangedCallback = `on${getCallbackNamePartFromName(name)}Changed`;

        if (!this.changes) {
            this.changes = {};
        }

        if (!this.changes[name] && oldV !== null) {
            this.changes[name] = {
                oldV: null,
                newV: null
            };
        }

        if (oldV !== null && this.changes[name]) {
            this.changes[name].oldV = oldV;
        }

        if (newV !== null && this.changes[name]) {
            this.changes[name].newV = newV;
        }

        if (this.changes[name] && this.changes[name].oldV !== null && this.changes[name].newV !== null) {
            if (onChangedCallback in this) {
                this[onChangedCallback](this.changes[name].oldV, this.changes[name].newV);
                delete this.changes[name];
            }
        }
    }

    static create() {
        customElements.define(this.selector, this);
    }
}