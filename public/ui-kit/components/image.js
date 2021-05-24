import { Component } from "./component.js";

export class Image extends Component {
    static get selector() {
        return 'k-image';
    }
    static get observedAttributes() {
        return ['src', 'width', 'height', 'debug'];
    }

    get componentTemplate() {
        return `
		<img src="${this.preloadImage}" data-src="${this.src}" class="load" width="${this.width}px" height="${this.height}px" />
		`;
    }
    get componentStyle() {
        return `
		<style>
			:host {
				display: inline-block;
			}

			img {
				display: block;
			}

			img.error {
				border: 1px solid darkred;
				border-radius: 3px;
			}

			img.load {
				animation: 4s linear infinite alternate clignotage;
			}

			img + span.error {
				display: inline-block;
				color: darkred;
				text-transform: uppercase;
			}

			@keyframes clignotage {
				0% {
					opacity: 0.5;
				}
				50% {
					opacity: 1;
				}
				100% {
					opacity: 0.5;
				}
			}
		</style>`
    }

    get preloadImage() {
        const image = `
	<svg
		xmlns:dc="http://purl.org/dc/elements/1.1/"
		xmlns:cc="http://creativecommons.org/ns#"
		xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
		xmlns:svg="http://www.w3.org/2000/svg"
		xmlns="http://www.w3.org/2000/svg"
		xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
		xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
		width="180.11873mm"
		height="139.79364mm"
		viewBox="0 0 180.11873 139.79364"
		version="1.1"
		id="svg8"
		sodipodi:docname="placeHolder.svg"
		inkscape:version="0.92.3 (2405546, 2018-03-11)">
	   <defs
		  id="defs2" />
	   <sodipodi:namedview
		  id="base"
		  pagecolor="#ffffff"
		  bordercolor="#666666"
		  borderopacity="1.0"
		  inkscape:pageopacity="0.0"
		  inkscape:pageshadow="2"
		  inkscape:zoom="0.35"
		  inkscape:cx="341.4432"
		  inkscape:cy="293.39894"
		  inkscape:document-units="mm"
		  inkscape:current-layer="layer1"
		  showgrid="false"
		  inkscape:window-width="1299"
		  inkscape:window-height="713"
		  inkscape:window-x="67"
		  inkscape:window-y="27"
		  inkscape:window-maximized="1"
		  fit-margin-top="0"
		  fit-margin-left="0"
		  fit-margin-right="0"
		  fit-margin-bottom="0" />
	   <metadata
		  id="metadata5">
		 <rdf:RDF>
		   <cc:Work
			  rdf:about="">
			 <dc:format>image/svg+xml</dc:format>
			 <dc:type
				rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
			 <dc:title></dc:title>
		   </cc:Work>
		 </rdf:RDF>
	   </metadata>
	   <g
		  inkscape:label="Layer 1"
		  inkscape:groupmode="layer"
		  id="layer1"
		  transform="translate(-13.590944,-66.638611)">
		 <rect
			style="opacity:1;fill:#d0d0d0;fill-opacity:1;stroke:none;stroke-width:2.96123242;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:fill markers stroke"
			id="rect826"
			width="180.11873"
			height="139.79364"
			x="13.590944"
			y="66.638611" />
		 <path
			style="opacity:0.675;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:2.98038435;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:fill markers stroke"
			d="M 118.5069,133.51362 84.257994,167.76253 68.290072,151.79461 26.352445,193.73223 h 31.935843 51.939412 68.49781 z"
			id="rect832"
			inkscape:connector-curvature="0" />
		 <circle
			style="opacity:0.675;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.99717033;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:fill markers stroke"
			id="path860"
			cx="58.21706"
			cy="108.55542"
			r="11.772726" />
		 <rect
			style="opacity:1;fill:none;fill-opacity:1;stroke:none;stroke-width:2.96123242;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:fill markers stroke"
			id="rect862"
			width="152.61417"
			height="116.09874"
			x="26.111267"
			y="77.633698" />
	   </g>
	 </svg>`;

        return "data:image/svg+xml;base64," + window.btoa(new XMLSerializer().serializeToString((new DOMParser()).parseFromString(image, 'image/svg+xml').querySelector('svg')));
    }

    get src() {
        return this.getAttribute('src');
    }
    set src(v) {
        this.setAttribute('src', v);
    }

    get width() {
        return parseInt(this.getAttribute('width'));
    }
    set width(v) {
        this.setAttribute('width', v.replace('px', ''));
    }

    get height() {
        return parseInt(this.getAttribute('height'));
    }
    set height(v) {
        this.setAttribute('height', v.replace('px', ''));
    }

    get debug() {
        return this.getAttribute('debug') !== 'true' ? false : true;
    }
    set debug(v) {
        this.setAttribute('debug', v === true ? 'true' : 'false');
    }

    get errorMessage() {
        return this._errorMessage;
    }
    set errorMessage(err) {
        this._errorMessage = err;

        if (this.debug) {
            let spanError = this.root.querySelector('span.error');
            if (spanError && err === '') {
                spanError.remove();
            } else if (spanError) {
                spanError.innerHTML = err;
            } else {
                spanError = document.createElement('span');
                spanError.classList.add('error');
                spanError.innerHTML = err;
                this.root.appendChild(spanError);
            }
        } else {
            let spanError = this.root.querySelector('span.error');
            if (spanError) {
                spanError.remove();
            }
        }
    }

    loadImage(src) {
        if (src !== '') {
            fetch(src)
                .then(r => {
                    if (r.status !== 200) {
                        throw new Error(`image ${window.location.protocol + '//' + window.location.host + src} not found`);
                    }
                    return r.blob()
                })
                .then(b => {
                    const image = this.root.querySelector('img');

                    image.setAttribute('src', URL.createObjectURL(b));
                    const timout = setTimeout(() => {
                        image.classList.remove('load');
                        image.classList.remove('error');
                        image.removeAttribute('width');
                        image.removeAttribute('height');
                        clearTimeout(timout);
                    }, 500);

                    this.errorMessage = '';
                })
                .catch(err => {
                    this.errorMessage = err.message;

                    const image = this.root.querySelector('img');
                    image.classList.add('error');
                })
        }
    }

    connectedCallback() {
        const src = this.root.querySelector('img').getAttribute('data-src');
        this.loadImage(src);
    }

    onSrcChanged() {
        const img = this.root.querySelector('img');
        img.setAttribute('src', this.preloadImage);
        img.classList.add('load');
        img.setAttribute('width', this.width + 'px');
        img.setAttribute('height', this.height + 'px');
        img.setAttribute('data-src', this.src);

        this.loadImage(this.src);
    }

    onWidthChanged() {
        const img = this.root.querySelector('img');
        img.setAttribute('width', this.width + 'px');
    }

    onHeightChanged() {
        const img = this.root.querySelector('img');
        img.setAttribute('height', this.height + 'px');
    }

    onDebugChanged() {
        this.errorMessage = this.errorMessage;
    }
}