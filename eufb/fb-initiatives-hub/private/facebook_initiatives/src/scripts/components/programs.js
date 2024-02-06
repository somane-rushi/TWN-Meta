import Tracking from "./tracking";

export default class Programs {

    //////////////////////////////////////////
    //            INITIALISATION            //
    //////////////////////////////////////////

    constructor() {
        this.filters = this.initFilters();
        this.programs = this.initPrograms();
        this.heroes = document.querySelectorAll('[data-programs-hero]');
        this.grid = document.querySelector('[data-programs-grid]');

        window.addEventListener('resize', this.onResize.bind(this));
        this.onResize();

        this.updateFilter('');
    }

    initPrograms() {
        let programs = document.querySelectorAll('[data-program]');

        programs.forEach(program => {
            program.addEventListener('click', this.onProgramClicked.bind(this, program));
        });

        return programs;
    }

    initFilters() {
        let filters = document.querySelectorAll('[data-filter]');

        filters.forEach(filter => {
            filter.addEventListener('click', this.onFilterClicked.bind(this, filter.attributes['data-filter'].value));
        });

        return filters;
    }

    //////////////////////////////////////////
    //                METHODS               //
    //////////////////////////////////////////

    updatePrograms() {
        const gridRect = this.grid.getBoundingClientRect();

        this.programs.forEach(program => {
            const programRect = program.getBoundingClientRect();

            if (programRect.right === gridRect.right && programRect.left !== gridRect.left) {
                program.classList.add('program--right');
            } else {
                program.classList.remove('program--right');
            }

            if (programRect.bottom === gridRect.bottom && gridRect.height > programRect.height * 2) {
                program.classList.add('program--bottom');
            } else {
                program.classList.remove('program--bottom');
            }
        });
    }

    updateFilter(filter) {
        this.filters.forEach(filterElement => {
            if (filterElement.attributes['data-filter'].value === filter) {
                filterElement.classList.add('selected');
            } else {
                filterElement.classList.remove('selected');
            }
        });

        this.programs.forEach(programElement => {
            let tags = programElement.attributes['data-tags'].value.split(' ');

            if (!filter || tags.indexOf(filter) >= 0) {
                programElement.classList.remove('program--hidden');
            } else {
                programElement.classList.add('program--hidden');
            }
        });

        this.heroes.forEach(heroElement => {
            let tags = heroElement.attributes['data-tags'].value.split(' ');

            if (filter) {
                if (tags.indexOf(filter) >= 0) {
                    heroElement.classList.remove('programs__hero--hidden');
                } else {
                    heroElement.classList.add('programs__hero--hidden');
                }
            } else {
                if (tags.length === 1 && !tags[0]) {
                    heroElement.classList.remove('programs__hero--hidden');
                } else {
                    heroElement.classList.add('programs__hero--hidden');
                }
            }
        });

        this.onResize();
    }

    //////////////////////////////////////////
    //                EVENTS                //
    //////////////////////////////////////////

    onProgramClicked(clickedProgram) {
        this.programs.forEach(program => {
            if (program === clickedProgram) {
                if (!program.classList.contains('program--expanded')) {
                    let headingText = program.querySelector('.program__heading').textContent;
                    Tracking.trackEvent('Program', 'open', headingText);
                }

                program.classList.toggle('program--expanded');
            } else {
                program.classList.remove('program--expanded');
            }
        });

    }

    onFilterClicked(filter) {
        this.updateFilter(filter);
    }

    onResize() {
        clearTimeout(this.resizeTimeout);
        this.resizeTimeout = setTimeout(this.onPassiveResize.bind(this), 100);
    }

    onPassiveResize() {
        this.updatePrograms();
    }
}
