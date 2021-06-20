import { Component } from "./component.js";

export class Input extends Component {
    static get selector() {
        return 'k-input';
    }
    static get observedAttributes() {
        return ['type'];
    }

    get componentTemplate() {
            return `
		${this.type !== 'textarea' ? `<input type="${this.type}" value="${this.value}" placeholder="${this.placeholder}" />` : ''}
		${this.type === 'textarea' ? `<textarea placeholder="${this.placeholder}">${this.value}</textarea>` : ''}
		`;
    }

    get componentStyle() {
        return `<style>
			input, select, textarea {
				border: 1px solid #2a2e5e;
				background: #171933;
				border-radius: 3px;
				color: #d4dcff;
				padding: calc(1.5 * 8px) calc(1 * 8px);
				display: block;
				width: 100%;
				outline: 0;
				min-height: 44px;
			}

			input, select {
				font-size: inherit;
				font-family: inherit;
			}

			${this.type === 'textarea' ? `
			textarea {
				border: 1px solid #2a2e5e;
				background: #171933;
				border-radius: 3px;
				color: #d4dcff;
				padding: calc(1.5 * 8px) calc(1 * 8px);
				display: block;
				width: calc(100% - 20px);
				outline: 0;
				min-height: 150px;
				font-size: inherit;
				font-family: inherit;
				line-height: inherit;
				resize: none;
			}
			` : ''}
		</style>`
    }

    get type() {
        return this.getAttribute('type') !== null ? this.getAttribute('type') : 'text';
    }
    set type(v) {
        this.setAttribute('type', v);
    }

    get value() {
        return this.getAttribute('value') !== null ? this.getAttribute('value') : '';
    }
    set value(v) {
        this.setAttribute('value', v);
    }

    get placeholder() {
        return this.getAttribute('placeholder') !== null ? this.getAttribute('placeholder') : '';
    }
    set placeholder(v) {
        this.setAttribute('placeholder', v);
    }

	onInputHandler(e) {
		this.value = e.target.value;
		console.log(e)
	}

	connectedCallback() {
		const input = this/* .shadow */.querySelector('input');
		const textarea = this/* .shadow */.querySelector('textarea');

		if (input) {
			input.addEventListener('input', this.onInputHandler.bind(this))
		} else if (textarea) {
			textarea.addEventListener('input', this.onInputHandler.bind(this))
		}
	}

	disconnectedCallback() {
		const input = this/* .shadow */.querySelector('input');
		const textarea = this/* .shadow */.querySelector('textarea');

		if (input) {
			input.removeEventListener('input', this.onInputHandler.bind(this))
		} else if (textarea) {
			textarea.removeEventListener('input', this.onInputHandler.bind(this))
		}
	}

    onTypeChanged() {
		this.disconnectedCallback();
		this.render();
		this.connectedCallback();
    }
}