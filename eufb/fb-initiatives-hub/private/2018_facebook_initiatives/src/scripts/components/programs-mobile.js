export default class MobilePrograms {

    //////////////////////////////////////////
    //            INITIALISATION            //
    //////////////////////////////////////////

    constructor() {
        this.programs = this.initPrograms();
        this.programContent = this.initProgramContent();
    }

    initPrograms() {
        let programs = document.querySelectorAll('.programs-mobile .program');

        programs.forEach(program => {
            program.addEventListener('click', this.openProgram.bind(this, program));
        });

        return programs;
    }

    initProgramContent() {
        let programContent = document.querySelectorAll('.programs-mobile .program__content');

        programContent.forEach(program => {
            program.addEventListener('click', this.closeAllPrograms.bind(this, program));
        });

        return programContent;
    }

    //////////////////////////////////////////
    //                METHODS               //
    //////////////////////////////////////////

    closeAllPrograms() {
        this.programs.forEach(program => {
            program.classList.remove('open');
        })

        document.body.classList.remove('program--open');

        this.stopVideos();
    }

    openProgram(program) {
        program.classList.add('open');
        document.body.classList.add('program--open');

        this.currentProgram = program;
    }

    //////////////////////////////////////////
    //                EVENTS                //
    //////////////////////////////////////////

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
