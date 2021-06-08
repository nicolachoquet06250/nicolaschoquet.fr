import { Component } from "./component.js";

export class Select extends Component {
    static get selector() {
        return 'k-select';
    }
    static get observedAttributes() {
        return [];
    }

    get useShadow() {
        return true;
    }

    get componentTemplate() {
        return `
		<button class="dropdown">
			<div>
				<span>Test dropdown</span>

				<ul class="list">
					<slot class="list-item"></slot>
				</ul>
			</div>
		</button>`;
    }
    get componentStyle() {
        return `<style>
			:host {
				display: inline-block;
			}

			.dropdown {
				cursor: pointer;
				border: 1px solid #2a2e5e;
				background: #171933;
				border-radius: 3px;
				color: #d4dcff;
				padding: 10px 35px 10px 20px;
				display: flex;
				justify-content: center;
				align-items: center;
				width: max-content;
				outline: 0;
				min-height: 44px;
				position: relative;
				padding-left: 0;
			}

			.dropdown div {
				display: flex;
				flex-direction: column;
			}

			.dropdown div span {
				padding-left: 20px;
			}

			.dropdown div .list {
				display: none;
			}

			.dropdown:active div .list,
			.dropdown:focus div .list {
				display: flex;
				flex-direction: column;
				list-style: none;
				align-items: start;
				justify-content: start;
				padding-left: 0;
			}

			.dropdown:active, 
			.dropdown:focus {
				outline: 1px solid gray;
			}

			.dropdown::after {
				content: '▼';
				position: absolute;
				right: 5px;
			}

			.dropdown:active::after, 
			.dropdown:focus::after {
				content: '▲';
			}
		</style>`;
    }

    get defaultDropdownTitle() {
        return 'Test dropdown'
    }

    connectedCallback() {
        Array.from(this.root.querySelectorAll('.list-item')).map(e => e.addEventListener('click', _e => {
            const content = _e.target.innerHTML;
            console.log(_e.target, content);
            this.root.querySelector('span').innerHTML = content;
            e.parentElement.parentElement.parentElement.blur();
        }));
    }
}

export class Option extends Component {
    static get selector() {
        return 'k-option';
    }
    static get observedAttributes() {
        return [];
    }

    get useShadow() {
        return true;
    }

    get componentTemplate() {
        return `<li>
			<slot></slot>
		</li>`;
    }
    get componentStyle() {
        return `<style>
			:host {
				display: flex;
				width: 100%;
				text-align: left;
			}

			li {
				padding: 10px 20px;
				width: 100%;
			}

			li:hover {
				background: #4869ee;
			}
		</style>`;
    }
}