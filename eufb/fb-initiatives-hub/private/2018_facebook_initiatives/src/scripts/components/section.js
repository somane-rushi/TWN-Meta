import Siema from 'siema';

export default class Section {

    //////////////////////////////////////////
    //            INITIALISATION            //
    //////////////////////////////////////////

    constructor() {

        const Carousel = new Siema({
            selector: '.stats__carousel',
            loop: true,
            duration: 400,
            onChange: () => this.setActiveNavItem(Carousel),
            perPage: {
                0: 1,
                480: 2
            }
        });

        this.carousel = Carousel;
        this.initCarouselNav(Carousel);
        this.pageWrap = document.getElementById('page__wrap');
        this.pageWrap.addEventListener('scroll', this.onScroll.bind(this));
        this.passiveScrollHandler = this.onPassiveScroll.bind(this);
        this.isLocked = false;

        this.autoPlay();
        this.onScroll();
    }

    autoPlay() {
        this.timeOut = setTimeout(() => this.carousel.next(), 7000);
    }

    initCarouselNav(Carousel) {
        const carouselNav = document.querySelector('.stats__carousel--nav');
        let slides = Carousel.selector.firstChild.children;

        if (window.innerWidth <= 480) {
            for (let i=0; i<slides.length-2; i++) {
                carouselNav.innerHTML += `<div class="stats__carousel--nav-item"></div>`;
            }
        } else {
            if (slides.length > 6) {
                for (let i=0; i<slides.length-4; i++) {
                    carouselNav.innerHTML += `<div class="stats__carousel--nav-item"></div>`;
                }
            }
        }

        let carouselNavItems = document.querySelectorAll('.stats__carousel--nav-item');

        carouselNavItems.forEach((navItem, i) => {
            navItem.id = i;
            navItem.addEventListener('click', this.onCarouselNavClick.bind(this, Carousel));
        });

        this.setActiveNavItem(Carousel, carouselNavItems);
    }

    setActiveNavItem(Carousel) {
        let carouselNavItems = document.querySelectorAll('.stats__carousel--nav-item');
        let currentSlide;

        clearTimeout(this.timeOut);

        if (carouselNavItems.length > 0) {
            if (Carousel.currentSlide < 0) {
                currentSlide = carouselNavItems.length - 1;
            } else {
                currentSlide = Carousel.currentSlide;
            }
            
            let activeNavItem = carouselNavItems[currentSlide];

            carouselNavItems.forEach(navItem => {
                if (navItem.classList.contains('active')) {
                    navItem.classList.remove('active');
                }
            });

            activeNavItem.classList.add('active');
        }

        this.autoPlay();
    }

    //////////////////////////////////////////
    //                METHODS               //
    //////////////////////////////////////////

    fixSectionHeading(theme) {

        //This could do with some tidying up, but it does the job, sort of...

        const heading = document.getElementById(theme).getElementsByClassName('section__heading')[0];
        const subheading = document.getElementById(theme).getElementsByClassName('section__subheading')[0];
        const quoteOne = document.getElementById(theme).getElementsByClassName('quote-one')[0];
        const quoteTwo = document.getElementById(theme).getElementsByClassName('quote-two')[0];
        const themeEl = document.getElementById(theme);        
        const themes = document.querySelectorAll('.theme');
        const scrollBottom = this.pageWrap.scrollTop + document.getElementById('page__wrap').clientHeight - document.getElementById('page').clientHeight;
        const scrollOffset = scrollBottom === 0 ? -1 : Math.abs(themeEl.getBoundingClientRect().top - 5) / window.innerHeight;
        const isFirstTheme = themes[0].id === theme;

        const isQuoteOne = document.getElementById(theme).getElementsByClassName('quote-one').length;
        const isQuoteTwo = document.getElementById(theme).getElementsByClassName('quote-two').length;
        
        if (isFirstTheme) {
            //Handle the first theme differently, because we have one extra scroll (stats panel)
            if (scrollOffset == 0) {
                heading.classList.add('display');
                subheading.classList.add('display');

                if (isQuoteOne) {
                    quoteOne.classList.remove('display');
                }

                if (isQuoteTwo) {
                    quoteTwo.classList.add('display');
                }

            } else if (scrollOffset == 1) {
                heading.classList.add('display');
                subheading.classList.remove('display');

                if (isQuoteOne) {
                    quoteOne.classList.add('display');
                }

                if (isQuoteTwo) {
                    quoteTwo.classList.remove('display');
                }

            } else if (scrollOffset > 1) {
                heading.classList.remove('display');
                subheading.classList.remove('display');

                if (isQuoteOne) {
                    quoteOne.classList.remove('display');
                }

                if (isQuoteTwo) {
                    quoteTwo.classList.remove('display');
                }

            }
        } else if (themeEl.id != 'about-us') {
            // For the rest of the themes...
            if (scrollOffset == 0) {
                heading.classList.add('display');
                subheading.classList.add('display');

                if (isQuoteTwo) {
                    quoteTwo.classList.add('display');
                }

            } else if (scrollOffset > 0) {
                heading.classList.remove('display');
                subheading.classList.remove('display');

                if (isQuoteTwo) {
                    quoteTwo.classList.remove('display');
                }

            }
        }
    }

    animateStats() {
        if (!this.carousel) { return };
       
        const panels = document.querySelectorAll('.panels');

        panels.forEach(panel => {
            const stats = panel.querySelectorAll('.stat');
           
            stats.forEach(stat => {
                this.isInViewport(panel) ? this._addClass(stat, 'stat--displayed') : this._removeClass(stat,'stat--displayed');
            })
        });
    }

    _addClass(elem, className) {
        if (elem.classList.contains(className)) { return };
        elem.classList.add(className);
    }

    _removeClass(elem, className) {
        if (elem.classList.contains(className)) {
            elem.classList.remove(className);
        }
        if (this.addClassTimeout) {
            clearTimeout(this.timeoutClass);
        }
    }

    isInViewport(elem) {
        let rect = elem.getBoundingClientRect();
        const top = rect.top;
        const bottom = rect.bottom;
        const height = bottom - top;
        const topInView = top >= 0 && top < (height - 100) && bottom > height;
        const bottomInView = top < 0 && bottom > 100 && bottom < height;
        
        return topInView || bottomInView;
    }

    animatePrograms() {
        const containers = document.querySelectorAll('.programs-mobile');

        containers.forEach(container => {
            const programs = container.querySelectorAll('.program');

            if ( this.isInViewport(container) && !this.isLocked ) {
                this.isLocked = true;

                programs.forEach((program, index) => {
                    this.addClassTimeout = setTimeout(() => {
                        this._addClass(program, 'program--show');
                    }, (index + 1) * 250);  
                });

                setTimeout(() => {
                    this.isLocked = false;
                }, (programs.length + 1) * 250);
                
            } else if (!this.isLocked) {
                programs.forEach(program => this._removeClass(program, 'program--show'));
            }
        });
    }

    //////////////////////////////////////////
    //                EVENTS                //
    //////////////////////////////////////////

    onScroll() {
        if (this.isSmoothScrolling) return;
        if (!this.debounce) setTimeout(this.passiveScrollHandler, 100);
    }

    onPassiveScroll(Carousel) {
        let theme;

        // On first load, the section will not immediately be set, so find the first section
        if (window.location.hash.substring(1) == '') {
            theme = document.querySelector('[data-scroll-anchor]').name;
        } else {
            theme = window.location.hash.substring(1);
        }
        this.fixSectionHeading(theme);
        this.animateStats();
        this.animatePrograms();
        this.debounce = null;
    }

    onCarouselNavClick(Carousel, e) {
        Carousel.goTo(e.target.id);
    }
}
