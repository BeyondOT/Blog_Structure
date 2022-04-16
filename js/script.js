import * as navBar from './navBar.js';
import * as ajax from './ajax.js';
//import * as veriForm from './veriForm.js';

// TODO:  Dynamic input Error handling

const app = () =>{
    navBar.navSlide();
    ajax.addReplyForm();
    ajax.deleteComment();

}

app();