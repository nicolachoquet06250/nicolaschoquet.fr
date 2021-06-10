import { Component } from "./component.js";


export class Button extends Component {
    static get selector() {
        return 'k-button';
    }
    static get observedAttributes() {
        return ['type', 'primary', 'secondary', 'size'];
    }

    get useShadow() {
        return true;
    }

    get componentTemplate() {
        return `
		<button data-type="${this.type}">
			<slot></slot>
		</button>`;
    }
    get componentStyle() {
        let style = `
        ${this.cssComponentId} {
            display: inline-block;
        }

		${this.cssComponentId} button {
			border-radius: 4px;
			transition: background, color .3s;
		}`;

        switch (this.type) {
            case 'classic':
                style += `
				${this.cssComponentId} button {
					background: none;
					border: none;
					cursor: pointer;
				}`;
                break;
        }

        if (this.primary) {
            style += `
			${this.cssComponentId} button {
				background: #4869ee;
				color: white;
				border: solid 1px #4869ee;
			}
		
			${this.cssComponentId} button:hover {
				filter: brightness(1.2);
			}`
        } else if (this.secondary) {
            style += `
			${this.cssComponentId} button {
				background: transparent;
				color: #4869ee;
				border: solid 1px #4869ee;
			}
		
			${this.cssComponentId} button:hover {
				background: #4869ee;
				color: white;
				border: solid 1px #4869ee;
			}`
        }

        switch (this.size) {
            case 'big':
                style += `
				${this.cssComponentId} button {
					font-size: 18px;
					padding: 12px 16px;
					font-weight: 700;
				}`
                break;
            case 'medium':
                break;
            case 'small':
                break;
        }

        return `<style>${style}</style>`;
    }

    get type() {
        return this.getAttribute('type');
    }

    get primary() {
        return this.getAttribute('primary') !== null && this.getAttribute('primary') !== 'false';
    }

    get secondary() {
        return this.getAttribute('secondary') !== null && this.getAttribute('secondary') !== 'false';
    }

    get size() {
        return this.getAttribute('size');
    }

    get onClick() {
        if (this.getAttribute('on-click')) {
            let call;
            eval('call = ' + this.getAttribute('on-click'))
            return call;
        }
        return null;
    }

    connectedCallback() {
        if (this.onClick) {
            this.addEventListener('click', this.onClick);
        }
    }

    disconnectedCallback() {
        if (this.onClick) {
            this.removeEventListener('click', this.onClick);
        }
    }

    onTypeChanged() {
        this.render();
    }

    onPrimaryChanged() {
        console.log('primary', this.primary, 'secondary', false);
    }

    onSecondaryChanged() {
        console.log('secondary', this.secondary, 'primary', false);
    }
}