import SmoothScroll from 'smoothscroll';
import Tracking from './tracking';

export const SHOW_MENU_CLASSNAME = 'menu--show';
export const CURRENT_ITEM_CLASSNAME = 'current';

export default class Header {

    //////////////////////////////////////////
    //            INITIALISATION            //
    //////////////////////////////////////////

    constructor() {
        this.oldScrollPosition = 0;
        this.isScrollingActivated = true;
        this.pageWrap = document.getElementById('page__wrap');
        this.pageWrap.addEventListener('scroll', this.onScroll.bind(this));

        this.pageWrap.addEventListener('mousewheel', this.onMouseWheel.bind(this));
        this.pageWrap.addEventListener('touchstart', this.onTouchStart.bind(this));

        this.initBurgerButton();
        this.initSmoothScroll();
        this.getCurrentSection();

        this.passiveScrollHandler = this.onPassiveScroll.bind(this);

        document.getElementById('header__home_button').addEventListener('click', this.onHomeClick.bind(this));

        this.onScroll();
    }

    initBurgerButton() {
        let buttons = document.querySelectorAll('[data-menu-button]');

        buttons.forEach(button => {
            button.onclick = () => document.body.classList.toggle(SHOW_MENU_CLASSNAME);
        });
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

        let scrollTop = this.pageWrap.scrollTop;
        let scrollBottom = scrollTop + this.pageWrap.innerHeight;

        if (scrollTop < 10) {
            this.setCurrentItem(anchors[0]['name']);

            return anchors[0];
        } else {
            for (let i = anchors.length - 1; i >= 0; i--) {
                let anchor = anchors[i];

                if (anchor.getBoundingClientRect().top <= 5) {
                    this.setCurrentItem(anchor['name'])
                    return anchor;
                }
            }
        }
    }

    setCurrentItem(currentSection) {
        let current = document.querySelectorAll(`[data-section="#${currentSection}"]`);
        let links = document.querySelectorAll('[data-smooth-scroll]');

        links.forEach(function(element) {
            element.classList.remove(CURRENT_ITEM_CLASSNAME);
        });

        current.forEach(function(element) {
            element.classList.add(CURRENT_ITEM_CLASSNAME);
        });
    }

    updateAnchorClass(currentSection) {
        let classList = document.body.classList;
        let themeColour = currentSection.dataset.themeColour;

        classList.remove(this.anchorClass);

        this.anchorClass = 'section--' + currentSection.name;

        classList.add(this.anchorClass);

        document.body.style.background = themeColour;
        document.body.style.transition = 'background 0.5s';
    }

    updateURL(currentSection) {
        history.replaceState('', '', '#' + currentSection.name);
    }

    //////////////////////////////////////////
    //                EVENTS                //
    //////////////////////////////////////////

    onScroll(event) {
        if (this.isSmoothScrolling) return;
        if (!this.debounce) setTimeout(this.passiveScrollHandler, 100);
    }

    onPassiveScroll() {
        let currentSection = this.getCurrentSection();

        if(currentSection !== this.oldSection) {
            this.updateURL(currentSection);
            this.updateAnchorClass(currentSection);
            Tracking.trackEvent('Section', 'scroll', currentSection.name);
        }

        this.oldSection = currentSection;
        this.debounce = null;
    }

    onSmoothScrollLinkClicked(event) {
        event.preventDefault();

        document.body.classList.remove(SHOW_MENU_CLASSNAME);

        let name = event.currentTarget['href'].split('#')[1];
        let anchor = document.querySelectorAll(`a[name=${name}]`)[0];

        SmoothScroll(anchor, 750, null, this.pageWrap);
    }

    onMouseWheel() {
        this.isSmoothScrolling = false;
    }

    onTouchStart() {
        this.isSmoothScrolling = false
    }

    onHomeClick() {
        SmoothScroll(0, 500, null, this.pageWrap);
    }
}
