import { Component } from "./component.js";

export class Switch extends Component {
    static get selector() {
        return 'k-switch';
    }
    static get observedAttributes() {
        return ['on-icon', 'off-icon', 'icon', 'checked'];
    }

    get componentTemplate() {
        return `
		<input type="${this.type}" name="${this.name}" id="switch-${this.uniqId}" ${this.checked ? 'checked="checked"' : ''}>
        
		<label for="switch-${this.uniqId}">
			<span class="switch"></span>
			
			<slot></slot>
        </label>`;
    }

    get componentStyle() {
            return `
		<style>
			${this.cssComponentId} input {
				position: absolute;
				top: 0;
				left: 0;
				opacity: 0;
				cursor: pointer;
				min-height: auto;
			}
			
			${this.cssComponentId} label {
				display: flex;
				align-items: center;
				justify-content: flex-start;
				cursor: pointer;
				margin-bottom: 0 !important;
				width: min-content;
			}
			
			${this.cssComponentId} .switch::before {
				content: "";
				display: block;
				height: 24px;
				width: 24px;
				background: #1b1e3d;
				border: 1px solid #2a2e5e;
				box-shadow: 0 1px 4px rgba(213,222,233,.2);
				border-radius: 100px;
				transition: transform .3s;
				${this.offIcon ? `background-image: url(${this.offIcon})` : ''}
			}
			
			${this.cssComponentId} input:checked + label .switch::before {
				transform: translateX(31px);
				background: #4869ee;
				border-color: #8491c7;
				box-shadow: 0 1px 4px rgba(0,0,0,.2);
				${this.onIcon ? `background-image: url(${this.onIcon})` : ''}
			}

			${this.cssComponentId} .switch {
				flex: none;
				width: 55px;
				height: 26px;
				display: inline-block;
				background: #f7fafb;
				border: 1px solid #d5e3ec;
				box-shadow: 0 1px 4px rgba(213,222,233,.2);
				border-radius: 100px;
				margin-right: calc(1 * 8px);
				transition: background .3s;
			}

			${this.cssComponentId} input:checked + label .switch {
				flex: none;
				width: 55px;
				height: 26px;
				display: inline-block;
				background: #171933;
				border: 1px solid #2a2e5e;
				box-shadow: 0 1px 4px rgba(213,222,233,.2);
				border-radius: 100px;
				margin-right: calc(1 * 8px);
				transition: background .3s;
				background: #0f1224 !important;
			}
		</style>`;
	}

	get onIcon() {
		return this.getAttribute('on-icon') ?? this.icon;
	}
	set onIcon(v) {
		this.setAttribute('on-icon', v);
	}

	get offIcon() {
		return this.getAttribute('off-icon') ?? this.icon;
	}
	set offIcon(v) {
		this.setAttribute('off-icon', v);
	}

	get icon() {
		return this.getAttribute('icon') ?? null;
	}
	set icon(v) {
		this.setAttribute('icon', v);
	}

	get checked() {
		return this.getAttribute('checked') === 'true';
	}
	set checked(v) {
		this.setAttribute('checked', (v === true ? 'true' : 'false'));
	}

	get value() {
		return this.checked;
	}
	set value(v) {
		this.checked = v;
	}

	get type() {
		return this.getAttribute('type') ?? 'checkbox';
	}
	set type(v) {
		this.validateType(v);
		this.setAttribute('type', v);
	}

	get name() {
		return this.getAttribute('name');
	}
	set name(v) {
		this.setAttribute('name', v);
	}

	validateType(v) {
		const expected = ['checkbox', 'radio'];
		if (expected.indexOf(v) === -1) {
			throw new TypeError('type expected in ' + expected + ', ' + v + ' given');
		}
	}

	connectedCallback() {
		this.root.querySelector(`#switch-${this.uniqId}`).addEventListener('change', e => {
			this.checked = e.target.checked;
			this.dispatchEvent(new Event('change', e));
		});
	}

	onCheckedChanged(oldV, newV) {
		this.render();
	}

	onTypeChanged(oldType) {
		try {
			this.validateType(this.type);
		} catch (e) {
			this.type = oldType;
		}
	}
}