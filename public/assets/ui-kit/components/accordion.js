import {Component} from "./component.js";

class Accordion extends Component {
    get useShadow() {
        return true;
    }

    get componentTemplate() {
        return `
        <ul class="accordion" id="simple-accordion">
            <li class="accordion-item">
                  <label for="accordion-item-internet-${this.name}" class="accordion-item-header">
                      <input type="${this.inputType}" id="accordion-item-internet-${this.name}" name="${this.name}">
            
                      <label for="accordion-item-internet-${this.name}">Internet</label>
            
                      <span class="accordion-item-header-icon"></span>
                  </label>
            
                  <div class="accordion-item-body">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                          maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                          maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                          maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                  </div>
            </li>
        
            <li class="accordion-item">
                  <label for="accordion-item-tv-${this.name}" class="accordion-item-header">
                      <input type="${this.inputType}" id="accordion-item-tv-${this.name}" name="${this.name}">
            
                      <label for="accordion-item-tv-${this.name}">TV d'Orange</label>
            
                      <span class="accordion-item-header-icon"></span>
                  </label>
            
                  <div class="accordion-item-body">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                          maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                          maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                          maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                  </div>
            </li>
        
            <li class="accordion-item">
                  <label for="accordion-item-aucun-service-${this.name}" class="accordion-item-header">
                      <input type="${this.inputType}" id="accordion-item-aucun-service-${this.name}" name="${this.name}">
            
                      <label for="accordion-item-aucun-service-${this.name}">Aucun Service</label>
            
                      <span class="accordion-item-header-icon"></span>
                  </label>
            
                  <div class="accordion-item-body">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                          maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                          maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet assumenda dolore, et explicabo facere harum magnam <br>
                          maxime nemo non quam quia repudiandae, similique unde, veritatis. Distinctio nisi nobis ullam.</p>
                  </div>
             </li>
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

    onChange(e) {
        const target = e.target;
        const body = target.parentElement.nextElementSibling;

        Array.from(this.root.querySelectorAll(`${this.cssComponentId} input[type="${this.inputType}"]`)).map(i => {
            if (!i.checked && i.parentElement.nextElementSibling.classList.contains('show')) {
                i.parentElement.nextElementSibling.classList.remove('show');
            }
        })

        body.classList[target.checked ? 'add' : 'remove']('show');
    }

    connectedCallback() {
        Array.from(this.root.querySelectorAll(`${this.cssComponentId} input[type="${this.inputType}"]`))
            .map(i => i.addEventListener('change', this.onChange.bind(this)));

        Array.from(this.root.querySelectorAll(`${this.cssComponentId} input[type="${this.inputType}"]`))
            .map(i => i.parentElement.nextElementSibling.classList[i.checked ? 'add' : 'remove']('show'));
    }
}

export class SimpleAccordion extends Accordion {
    static get selector() {
        return 'simple-accordion'
    }

    get inputType() {
        return 'radio';
    }
}

export class MultiAccordion extends Accordion {
    static get selector() {
        return 'multi-accordion'
    }

    get inputType() {
        return 'checkbox';
    }
}
