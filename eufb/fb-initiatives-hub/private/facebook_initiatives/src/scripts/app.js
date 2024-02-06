import Header from './components/header';
import Programs from './components/programs';
import Tracking from './components/tracking';
import Footer from './components/footer';

/**
 * App - Main application
 */
class App {

    /**
     * constructor - Create instance of Application
     */
    constructor() {
        new Header();
        new Tracking();
        new Programs();
        new Footer();
    }
}

export default App;
