export default class Tracking {

    //////////////////////////////////////////
    //            INITIALISATION            //
    //////////////////////////////////////////

    constructor() {
        this.initLinkTracking();
    }

    initLinkTracking() {
        let links = document.querySelectorAll('a[href]');
        links.forEach((link) => link.addEventListener('click', this.onLinkClicked.bind(this)));
    }


    //////////////////////////////////////////
    //                  API                 //
    //////////////////////////////////////////

    static trackEvent(category, action, label) {
        console.log('Track event:', category, action, label);

        if(!window.dataLayer) {
            console.warn('Google Tag Manager data layer not found. Tracking may not be operational.');
            window.dataLayer = [];
            return;
        }

        window.dataLayer.push({
            event: category,
            eventAction: action,
            eventLabel: label
        });
    }


    //////////////////////////////////////////
    //                EVENTS                //
    //////////////////////////////////////////

    onLinkClicked(event) {
        Tracking.trackEvent('Link', 'click', event.currentTarget.name);
    }
}
