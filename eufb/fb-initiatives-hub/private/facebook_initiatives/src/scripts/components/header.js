import Tracking from './tracking';

export const SHOW_MENU_CLASSNAME = 'menu--show';

export default class Header {

    //////////////////////////////////////////
    //            INITIALISATION            //
    //////////////////////////////////////////

    constructor() {
        this.initBurgerButton();
        this.initSmoothScroll();

        this.passiveScrollHandler = this.onPassiveScroll.bind(this);
        window.addEventListener('scroll', this.onScroll.bind(this));
        window.addEventListener('mousewheel', this.onMouseWheel.bind(this));
        window.addEventListener('touchstart', this.onTouchStart.bind(this));

        this.onScroll();
    }

    initBurgerButton() {
        let button = document.querySelector('[data-menu-button]');
        button.onclick = () => document.body.classList.toggle(SHOW_MENU_CLASSNAME);
    }

    initSmoothScroll() {
        let links = document.querySelectorAll('[data-smooth-scroll]');
        this.smoothScrollLinkClickedHandler = this.onSmoothScrollLinkClicked.bind(this);

        links.forEach((link) => {
            link.addEventListener('click', this.smoothScrollLinkClickedHandler);
        })
    }


    //////////////////////////////////////////
    //                METHODS               //
    //////////////////////////////////////////

    getCurrentSection() {
        let anchors = document.querySelectorAll('[data-scroll-anchor]');

        let scrollTop = window.scrollY || window.pageYOffset;
        let scrollBottom = scrollTop + window.innerHeight;

        if (document.body.scrollHeight - scrollBottom < 10) {
            return anchors[anchors.length - 1]['name'];
        } else {
            for (let i = anchors.length - 1; i >= 0; i--) {
                let anchor = anchors[i];

                if (anchor.getBoundingClientRect().top <= 0) {
                    return anchor['name'];
                }
            }
        }
    }

    updateAnchorClass(currentSection) {
        let classList = document.body.classList;

        classList.remove(this.anchorClass);

        this.anchorClass = 'section--' + currentSection;

        classList.add(this.anchorClass);
    }

    updateURL(currentSection) {
        history.replaceState('', '', '#' + currentSection);
    }

    smoothScroll(element, duration = 1000) {
        let time;
        let startTime = performance.now();
        let startPosition = window.pageYOffset;

        let pageBottomDelta = document.body.getBoundingClientRect().bottom - window.innerHeight;
        let deltaPosition = Math.min(element.getBoundingClientRect().top, pageBottomDelta);

        let ease = function (t, b, c, d) {
            if ((t /= d / 2) < 1) return c / 2 * t * t + b;
            return -c / 2 * ((--t) * (t - 2) - 1) + b;
        };

        this.scrollAnimation = function () {
            time = Math.min(performance.now() - startTime, duration);
            let position = ease(time, startPosition, deltaPosition, duration);
            window.scroll(0, position);

            if (time >= duration) {
                this.isSmoothScrolling = false;
                this.onScroll();
            } else if (this.isSmoothScrolling) {
                requestAnimationFrame(this.scrollAnimation);
            }
        }.bind(this);

        // Cancel previous animation...
        this.isSmoothScrolling = false;
        cancelAnimationFrame(this.scrollAnimation);

        // Start the new one...
        this.isSmoothScrolling = true;
        requestAnimationFrame(this.scrollAnimation);
    }


    //////////////////////////////////////////
    //                EVENTS                //
    //////////////////////////////////////////

    onScroll() {
        if (this.isSmoothScrolling) return;
        if (!this.debounce) setTimeout(this.passiveScrollHandler, 100);
    }

    onPassiveScroll() {
        let currentSection = this.getCurrentSection();

        if(currentSection !== this.oldSection) {
            this.updateURL(currentSection);
            this.updateAnchorClass(currentSection);
            Tracking.trackEvent('Section', 'scroll', currentSection);
        }

        this.oldSection = currentSection;
        this.debounce = null;
    }

    onSmoothScrollLinkClicked(event) {
        event.preventDefault();

        document.body.classList.remove(SHOW_MENU_CLASSNAME);

        let name = event.currentTarget['href'].split('#')[1];
        let anchor = document.querySelectorAll(`a[name=${name}]`)[0];

        this.updateURL(name);
        this.updateAnchorClass(name);
        this.smoothScroll(anchor);
    }

    onMouseWheel() {
        this.isSmoothScrolling = false;
    }

    onTouchStart() {
        this.isSmoothScrolling = false
    }
}
