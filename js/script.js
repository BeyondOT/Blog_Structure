import * as navBar from './navBar.js';
import * as ajax from './ajax.js';

// TODO:  Dynamic input Error handling (use hidden css class)

const app = () =>{
    navBar.navSlide();
    ajax.deleteComment();
}

app();