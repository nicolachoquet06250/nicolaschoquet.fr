import {Component} from "./component.js";

class Accordion extends Component {
    get useShadow() {
        return true;
    }

    get componentTemplate() {
        return `
        <ul class="accordion" id="simple-accordion">
             <slot></slot>
        </ul>
        `;
    }

    get componentStyle() {
        return `
            <style>
            ${this.cssComponentId} * {
                font-family: sans-serif;
            }
    
            ${this.cssComponentId} .accordion {
                list-style: none;
                padding-left: 0;
            }
    
            ${this.cssComponentId} .accordion .accordion-item {
                margin-top: 5px;
                margin-bottom: 5px;
                min-height: 50px;
                border-bottom: 1px solid black;
            }
    
            ${this.cssComponentId} .accordion .accordion-item .accordion-item-header {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                cursor: pointer;
            }
    
            ${this.cssComponentId} .accordion .accordion-item .accordion-item-header input[type="${this.inputType}"] {
                display: none;
            }
    
            ${this.cssComponentId} .accordion .accordion-item .accordion-item-header label {
                font-size: 2rem;
            }
    
            ${this.cssComponentId} .accordion .accordion-item .accordion-item-header input[type="${this.inputType}"] + label + .accordion-item-header-icon::after {
                content: 'v';
                font-size: 2rem;
            }
    
            ${this.cssComponentId} .accordion .accordion-item .accordion-item-header input[type="${this.inputType}"]:checked + label + .accordion-item-header-icon::after {
                content: '^';
                font-size: 2rem;
            }
    
            ${this.cssComponentId} .accordion .accordion-item .accordion-item-header input[type="${this.inputType}"]:checked + label,
            ${this.cssComponentId} .accordion .accordion-item .accordion-item-header input[type="${this.inputType}"]:checked + label + .accordion-item-header-icon {
                color: #FD6902FF;
            }
    
            ${this.cssComponentId} .accordion .accordion-item .accordion-item-body {
                display: none;
            }
    
            ${this.cssComponentId} .accordion .accordion-item .accordion-item-body.show {
                display: block;
            }
        </style>
        `;
    }

    get inputType() {
        return '';
    }

    get name() {
        return this.getAttribute('name') ?? '';
    }

    set name(name) {
        this.setAttribute('name', name);
    }

    constructor() {
        super();
        this.inputs = [];
    }

    onChange(e) {
        const target = e.target;
        const body = target.parentElement.nextElementSibling;

        this.inputs.map(input => {
            if (this.inputType === 'radio' && input.getAttribute('id') !== target.getAttribute('id') && input.checked) {
                input.checked = false;
                input.parentElement.nextElementSibling.classList.remove('show');
            }

            if (input.getAttribute('id') === target.getAttribute('id')) {
                let checked;
                if (this.inputType === 'radio') {
                    checked = input.getAttribute('value');
                } else {
                    checked = [];
                    this.inputs.reduce((r, c) => {
                        if (c.checked) {
                            r.push(c.getAttribute('value'));
                        }
                        return r;
                    }, []).map(e => checked.push(e));
                }

                this.dispatchEvent(new CustomEvent('change', {
                    detail: {
                        target: input,
                        value: input.getAttribute('value'),
                        checked
                    }
                }))
            }
        })

        body.classList[target.checked ? 'add' : 'remove']('show');
    }

    connectedCallback() {
        this.inputs.map(i => i.addEventListener('change', this.onChange.bind(this)));
        this.inputs.map(i => i.parentElement.nextElementSibling.classList[i.checked ? 'add' : 'remove']('show'));
    }
}

export class SimpleAccordion extends Accordion {
    static get selector() {
        return 'simple-accordion'
    }

    get inputType() {
        return 'radio';
    }

    connectedCallback() {
        const items = Array.from(this.querySelectorAll('accordion-item'));
        let cmp = 0;

        items.map(el => el.addEventListener('load', () => {
            this.inputs.push(el.root.querySelector(`input[type="${this.inputType}"]`));
            cmp++;
            if (cmp === items.length) {
                super.connectedCallback();
            }
        }));
    }
}

export class MultiAccordion extends Accordion {
    static get selector() {
        return 'multi-accordion'
    }

    get inputType() {
        return 'checkbox';
    }

    connectedCallback() {
        const items = Array.from(this.querySelectorAll('accordion-item'));
        let cmp = 0;

        items.map(el => el.addEventListener('load', () => {
            this.inputs.push(el.root.querySelector(`input[type="${this.inputType}"]`));

            cmp++;
            if (cmp === items.length) {
                super.connectedCallback();
            }
        }));
    }
}

export class AccordionItem extends Component {
    get useShadow() {
        return true;
    }

    static get selector() {
        return 'accordion-item';
    }

    get id() {
        return this.getAttribute('id');
    }

    get value() {
        return this.getAttribute('value');
    }

    set value(value) {
        this.setAttribute('value', value);
    }

    get componentTemplate() {
        return `
        <li class="accordion-item">
              <label for="${this.id}-${this.parentElement.name}" class="accordion-item-header">
                  <input type="${this.parentElement.inputType}" id="${this.id}-${this.parentElement.name}" name="${this.parentElement.name}" value="${this.value}">
        
                  <label for="${this.id}-${this.parentElement.name}">
                        <slot name="title"></slot>
                  </label>
        
                  <span class="accordion-item-header-icon"></span>
              </label>
        
              <div class="accordion-item-body">
                  <slot name="content"></slot>
              </div>
        </li>
        `;
    }

    get componentStyle() {
        return `
        <style>
            ${this.cssComponentId} * {
                font-family: sans-serif;
            }
    
            ${this.cssComponentId} .accordion-item {
                margin-top: 5px;
                margin-bottom: 5px;
                min-height: 50px;
                border-bottom: 1px solid black;
            }
    
            ${this.cssComponentId} .accordion-item .accordion-item-header {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
                cursor: pointer;
            }
    
            ${this.cssComponentId} .accordion-item .accordion-item-header input[type="${this.parentElement.inputType}"] {
                display: none;
            }
    
            ${this.cssComponentId} .accordion-item .accordion-item-header label {
                font-size: 2rem;
            }
    
            ${this.cssComponentId} .accordion-item .accordion-item-header input[type="${this.parentElement.inputType}"] + label + .accordion-item-header-icon::after {
                content: '<';
                font-size: 2rem;
            }
    
            ${this.cssComponentId} .accordion-item .accordion-item-header input[type="${this.parentElement.inputType}"] + label + .accordion-item-header-icon {
                transform: rotate(-90deg);
                transition: transform .2s linear;
            }
    
            ${this.cssComponentId} .accordion-item .accordion-item-header input[type="${this.parentElement.inputType}"]:checked + label + .accordion-item-header-icon {
                transform: rotate(90deg);
            }
    
            ${this.cssComponentId} .accordion-item .accordion-item-header input[type="${this.parentElement.inputType}"]:checked + label,
            ${this.cssComponentId} .accordion-item .accordion-item-header input[type="${this.parentElement.inputType}"]:checked + label + .accordion-item-header-icon {
                color: #FD6902FF;
            }
    
            ${this.cssComponentId} .accordion-item .accordion-item-body {
                display: none;
            }
    
            ${this.cssComponentId} .accordion-item .accordion-item-body.show {
                display: block;
            }
        </style>
        `;
    }

    connectedCallback() {
        this.dispatchEvent(new Event('load'))
    }
}
