export default class Programs {

    //////////////////////////////////////////
    //            INITIALISATION            //
    //////////////////////////////////////////

    constructor() {
        this.programs = this.initPrograms();
    }

    initPrograms() {
        let programs = document.querySelectorAll('.flexbox-slide');

        programs.forEach(program => {
            let currentSlider = program.closest('.flexbox-slider');

            program.addEventListener('click', this.onProgramClicked.bind(this, program, currentSlider));
            program.addEventListener('mouseenter', this.onProgramHover.bind(this, program, currentSlider));
        });

        return programs;
    }

    initCloseProgram(openProgram) {
        let closeButton = openProgram.querySelectorAll('.slide__inner-close');
        let currentSlider = closeButton[0].closest('.flexbox-slider');

        closeButton[0].addEventListener('click', this.onCloseClicked.bind(this, currentSlider));
    }

    changeBackground() {
        this.currentSlider.style.backgroundImage = 'url(' + this.background +')';
    }

    //////////////////////////////////////////
    //                EVENTS                //
    //////////////////////////////////////////

    onProgramClicked(clickedProgram, currentSlider) {
        let programs = currentSlider.querySelectorAll('.flexbox-slide');
        
        currentSlider.classList.add('flexbox-slider--opened');

        programs.forEach(program => {
            if (program.classList.contains('flexbox-slide--active')) {
                program.classList.remove('flexbox-slide--active');
            }
            if (program === clickedProgram) {
                program.classList.add('flexbox-slide--active');
            }
        });

        document.getElementById('navigation__dot').style.visibility="hidden";
        this.initCloseProgram(clickedProgram);
    }

    onProgramHover(hoveredProgram, currentSlider) {
            this.background = hoveredProgram.getAttribute('data-image-src');
            this.currentSlider = currentSlider;

            setTimeout(() => this.changeBackground(), 500);
    }

    onCloseClicked(currentSlider, event) {
        event.stopPropagation();

        let programs = currentSlider.querySelectorAll('.flexbox-slide');
        currentSlider.classList.remove('flexbox-slider--opened');
        
        programs.forEach(program => {
            if (program.classList.contains('flexbox-slide--active')) {
                program.classList.remove('flexbox-slide--active');
            }
        })

        document.getElementById('navigation__dot').style.visibility="visible";

        this.stopVideos();
    }

    stopVideos() {
        const videos = document.querySelectorAll('.video iframe');

        if (!videos || !videos.length) {
            return;
        }

        Array.prototype.forEach.call(videos, (el) => {
            let el_src = el.src;

            el.src = el_src;
        });
    }
}
