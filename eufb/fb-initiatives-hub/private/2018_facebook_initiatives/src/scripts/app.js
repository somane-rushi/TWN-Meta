import Section from './components/section';
import Programs from './components/programs';
import MobilePrograms from './components/programs-mobile';
import Header from './components/header';
import Companies from './components/companies';
import Scrolling from './components/scrolling';

/**
 * App - Main application
 */
class App {

    /**
     * constructor - Create instance of Application
     */
    constructor() {
        new Scrolling();
        new Section();
        new Programs();
        new MobilePrograms();
        new Header();
        new Companies();
    }
}

export default App;
