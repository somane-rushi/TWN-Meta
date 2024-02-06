import Siema from 'siema';

export default class Companies {
    
    //////////////////////////////////////////
    //            INITIALISATION            //
    //////////////////////////////////////////

    constructor() {
        if (document.querySelector('.companies__carousel') == null) {
            return;
        }

        const siemaSelector = document.querySelector('.companies__carousel');
        const siemaSelectorItems = siemaSelector.children.length;

        const CompaniesCarousel = new Siema({
            selector: siemaSelector,
            loop: true,
            duration: 400,
            perPage: {
                0: 1,
                960: siemaSelectorItems >= 3 ? 3 : siemaSelectorItems,
            }
        });

        setInterval(() => CompaniesCarousel.next(), 3000);
    }
}
