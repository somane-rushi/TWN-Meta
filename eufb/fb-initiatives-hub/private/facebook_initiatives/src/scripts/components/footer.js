export default class Footer {

    //////////////////////////////////////////
    //            INITIALISATION            //
    //////////////////////////////////////////

    constructor() {
        this.initCountrySelector();
    }

    initCountrySelector() {
        const countrySelector = document.querySelector('[data-country-selector]');
        if(!countrySelector) return;

        countrySelector.addEventListener('change', this.onCountrySelectorChanged.bind(this));
    }


    //////////////////////////////////////////
    //                EVENTS                //
    //////////////////////////////////////////

    onCountrySelectorChanged(event) {
        window.location = event.target.value;
    }
}
