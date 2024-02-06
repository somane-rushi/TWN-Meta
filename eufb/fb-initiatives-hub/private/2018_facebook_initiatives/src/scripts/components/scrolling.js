import SmoothScroll from 'smoothscroll';

export default class Scrolling {

    //////////////////////////////////////////
    //            INITIALISATION            //
    //////////////////////////////////////////

    constructor() {
        this.isScrollingActivated = true;
        this.pageEl = document.getElementById('page');
        this.pageWrap = document.getElementById('page__wrap');
        this.header = document.getElementById('header');
        this.isMobile = window.innerWidth <= 960;

        this.currentScrollPos = 0;
        this.oldScrollPosition = 0;

        this.pageWrap.addEventListener('wheel', this.onWheel.bind(this));
        this.pageWrap.addEventListener('scroll', this.onScroll.bind(this));

        if (this.isMobile) {
            this._initSectionAnchorsForMobile();
        }

        this.passiveScrollHandler = this.onPassiveScroll.bind(this);

        // Exception for scrolling freely on the overflow areas of the accordian
        let scrollableElements = document.querySelectorAll('.slide__inner-container-scroll');
        scrollableElements.forEach((el) => {
            el.addEventListener('wheel', this.onScrollableElementWheel.bind(this));
        });

        // Handle citation clicks differently so as not to disrupt the navigation elements
        let citations = document.querySelectorAll('.stat__cite_link');
        citations.forEach((el) => {
            el.addEventListener('click', this.onCitationClick.bind(this));
        });

        // Down Arrow stuff
        this.discoverMoreEl = document.querySelectorAll('.down')[0];
        this.discoverMoreEl.addEventListener('click', this.onDiscoverMoreClicked.bind(this));
        this.showHideDiscoverMore();
        this.progressPageHandler = this.progressPage.bind(this);
    }

    //////////////////////////////////////////
    //                METHODS               //
    //////////////////////////////////////////
    _initSectionAnchorsForMobile() {
        const sections = document.querySelectorAll("#sections_wrapper > div[id*='section']");
        let sectionAnchors = [];

        sections.forEach(({id}) => sectionAnchors.push(id));
        
        if (sectionAnchors.length > 0) {
            this.sectionAnchors = sectionAnchors;
            this.activeSection = sectionAnchors[0];
            sections[0].classList.add('section--active');
        }
    }

    _scrollTo(anchor) {
        const scrollToElem = document.getElementById(anchor);
        const currentlyActiveSection = document.getElementsByClassName('section--active')[0];
        const isLastSection = anchor === this.sectionAnchors[this.sectionAnchors.length - 1];

        if (!currentlyActiveSection) return;

        scrollToElem.scrollIntoView({ 
            behavior: 'smooth',
            block: "start", 
            inline: "nearest"
        });

        scrollToElem.classList.add('section--active');
        currentlyActiveSection.classList.remove('section--active');

        // hide down arrow on initial scroll into last section
        if (isLastSection) {
            setTimeout(() => {
                this.discoverMoreEl.classList.add('down--hide');
            }, 800);
        }
    }

    _scrollToNext() {
        if (!this.sectionAnchors) {
            this._initSectionAnchorsForMobile();
        }

        const activeSection = document.getElementsByClassName('section--active')[0];
        let nextSection = this.sectionAnchors[this.sectionAnchors.indexOf(activeSection.id) + 1];

        if (!nextSection) {
            nextSection = this.sectionAnchors[0];
        }
        
        this._scrollTo(nextSection);
    }

    _downScroll(scrollBy) {
        const scrollToPos = this.pageWrap.scrollTop + scrollBy;

        this._deactivateScrolling();

        if (!this.isScrollingActivated) {
            SmoothScroll(scrollToPos, 500, null, this.pageWrap);
        }

        setTimeout(() => {
            this._activateScrolling();
            this.showHideDiscoverMore();
            this.oldScrollPosition = this.pageWrap.scrollTop;
        }, 750);
    }

    _upScroll(scrollBy) {
        const scrollToPos = this.pageWrap.scrollTop - scrollBy;

        this._deactivateScrolling();

        if (!this.isScrollingActivated) {
            SmoothScroll(scrollToPos, 500, null, this.pageWrap);
        }

        this.oldScrollPosition = this.pageWrap.scrollTop;

        setTimeout(() => {
            this._activateScrolling();
            this.showHideDiscoverMore();
            this.oldScrollPosition = this.pageWrap.scrollTop;
        }, 750);
    }

    _deactivateScrolling() {
        this.isScrollingActivated = false;
    }

    _activateScrolling() {
        this.isScrollingActivated = true;
    }

    showHideDiscoverMore() {
        const isAtBottom = (this.pageWrap.scrollHeight - this.pageWrap.scrollTop === this.pageWrap.clientHeight);
        
        if (isAtBottom) {
            this.discoverMoreEl.classList.add('down--hide');
        } else {
            this.discoverMoreEl.classList.remove('down--hide');
        }
    }

    progressPage() {
        this.pageWrap.scrollBy({
            top: window.innerHeight,
            left: 0,
            behavior: 'smooth'
        });

        setTimeout(() => {
            this.showHideDiscoverMore();
        }, 750);
    }

    //////////////////////////////////////////
    //               EVENTS                 //
    //////////////////////////////////////////

    onWheel(event) {
        event.preventDefault();

        this.overScroll = event.deltaY;

        //Always ensure the navigation dot menu reappears if it's hidden
        //e.g. in the expanded accordian
        document.getElementById('navigation__dot').style.visibility="visible";

        if (!this.isScrollingActivated) return;
        if (!this.debounce) setTimeout(this.passiveScrollHandler, 100);
    }

    onScrollableElementWheel(event) {
        event.stopPropagation();
    }

    onPassiveScroll() {
        const isAtBottom = (this.pageWrap.scrollHeight - this.pageWrap.scrollTop === this.pageWrap.clientHeight);
        const footerHeight = document.querySelector('footer').clientHeight;
        const onlyPartnersSection = document.querySelector('.about__facebook') === null && document.querySelector('.about__companies') !== null;
        let partnersHeight = 0;

        if ( document.getElementById('companies') ) {
            partnersHeight = document.getElementById('companies').clientHeight;
        }
        
        // Checks whether the Partners (logos) section is visible but not the About Us section
        // and changes the final scrollup height accordingly, as the Partners section isn't 100vh.
        if (isAtBottom && onlyPartnersSection && this.overScroll <= -20) {
            this._upScroll(footerHeight + partnersHeight + 10);
        } else if (isAtBottom && !onlyPartnersSection && this.overScroll <= -20) {
            this._upScroll(footerHeight + 10);
        }

        if (this.isScrollingActivated) {
            if (this.overScroll >= 20 && !isAtBottom) {
                this._downScroll(window.innerHeight);
            } else if (this.overScroll <= -20 && !isAtBottom) {
                this._upScroll(window.innerHeight);
            } else {
                return;
            }
        }

        if (isAtBottom) {
            this.discoverMoreEl.classList.add('discover--hide');
        } else {
            this.discoverMoreEl.classList.remove('discover--hide');
        }

        this.debounce = null;
    }

    onScroll() {
        this.currentScrollPos = this.pageWrap.scrollTop;

        const scrollDelta = this.currentScrollPos - this.lastScrollPos;

        if (this.currentScrollPos > window.innerHeight) {
            this.header.classList.add('white');
        } else {
            this.header.classList.remove('white');
        }

        if (scrollDelta > 0) {
            this.header.classList.add('hide');
        } else if (scrollDelta < -10) {
            this.header.classList.remove('hide');
        }

        this.lastScrollPos = this.pageWrap.scrollTop;
        
        if (this.isMobile) this.showHideDiscoverMore();
    }

    onCitationClick() {
        const scrollToBottom = this.pageEl.scrollTop + this.pageEl.clientHeight;
        
        event.preventDefault();
        SmoothScroll(scrollToBottom, 500, null, this.pageWrap);
    }

    onDiscoverMoreClicked() {
        this.isMobile ? this._scrollToNext() : setTimeout(this.progressPageHandler, 100);
    }
}
