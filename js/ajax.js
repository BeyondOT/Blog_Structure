/* Fonction qui renvoie HttpRequest selon le navigateur utilisé */
function getHttpRequest(){
    let httpRequest;
    if (window.XMLHttpRequest) { // Mozilla, Safari, IE7+ ...
        httpRequest = new XMLHttpRequest();
    } else if (window.ActiveXObject) { // IE 6 and older
        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return httpRequest;
}

/* Fonction qui va supprimer un commentaire  */
export function deleteComment(){
    // links : contient tout les bouttons supprimer
    var links = document.querySelectorAll('.delete-comment');
    var httpRequest;
    var linkId;
    // Boucle pour avoir chaque boutton appart
    for(var i = 0; i < links.length; i++){
        var link = links[i];
        link.onclick = function(e){
            e.preventDefault();
            linkId = this.id;
            httpRequest = getHttpRequest();

            // Check si HttpRequest a bien ete initialisé
            if (!httpRequest) {
                alert('Abandon :( Impossible de créer une instance de XMLHTTP');
                return false;
            }
            httpRequest.onreadystatechange = changeContent;
            httpRequest.open('GET', this.getAttribute('href'),true);
            httpRequest.send();                  
        } 
    }
    function changeContent() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var comment = document.querySelector("#"+CSS.escape(linkId)+".single-comment");
                comment.classList.add("deleted-comment");
                comment.addEventListener('animationend', () => {
                    comment.remove();
                }, {once: true})
                
            } else {
                alert('Un problème est survenu avec la requête.');
            }
        }
    }  
}

/**
 * Ajoute un form de réponse quand l'utilisateur clique sur
 * le boutton répondre 
 */
export function addReplyForm(){
    var replyBtns = document.querySelectorAll('.reply-btn');
    var replyBtnId; 
    for(var i = 0; i < replyBtns.length; i++){
        var replyBtn = replyBtns[i];
        replyBtn.onclick = function(e){
            e.preventDefault();

            // Supprimer les autres réponses ouvertes.
            // Si l'ancien form n'a pas été supprimer alors sortir
            if(deleteOpenedReplyForm() == false){return};

            replyBtnId = this.id;
            // page contient le nom de la page ou se trouve le bouton(soit article soit commentaires)
            var page = this.getAttribute("page");

            var comment = document.querySelector("#"+CSS.escape(replyBtnId)+".single-comment");
            /* Création de la  div qui va contenir le formulaire */
            var replyFormContainer = createReplyForm(replyBtnId, page) ;
            comment.appendChild(replyFormContainer);
            return;
        }
    }
}

/**
 * Enleve les forms de réponse de commentaires ouverts
 * @returns false si la fonction n'a pas supprimer le form
 */
function deleteOpenedReplyForm(){
    // On check si un autre form n'est pas déja ouvert
    var openedReplyForm = document.querySelector('.reply-form-container');
    if(openedReplyForm != null){
        // Si un form est ouvert existe on check son contenu
        var openedReplyInput = document.querySelector('.reply-form-container form textarea');
        // Si textarea est vide alors ont peu enlever le form
        if(openedReplyInput.value.length == 0){
            openedReplyForm.remove();
        }else{
            // Sinon on demande a l'utilisateur ce qu'il veut faire
            if(confirm("Vous avez une réponse en cours, voulez vous continuer ?") == true){
                openedReplyForm.remove();
            }else{
                return false;
            }
        }
    }
}

/**
 * Crée la div qui contient le form de réponse
 * @param {Number} divId Contient l'id de la div qu'on va créer
 * @param {String} page Contient la page où se trouve la div
 * @returns {Div} Contient la div qu'on a crée
 */
function createReplyForm(divId, page){
    var replyFormContainer = document.createElement("div");
    replyFormContainer.classList.add("reply-form-container");
    Object.assign(replyFormContainer, {
        className: 'reply-form-container',
        id: divId
    })

    /* Input Form*/
    var form = document.createElement("form");
    Object.assign(form,{
        className: 'reply-form',
        method: 'POST',
        action: page+"&reply="+divId
    })
    replyFormContainer.appendChild(form);

    /* Le champ de réponse: textarea*/
    var textAreaInput = document.createElement("textarea");
    Object.assign(textAreaInput,{
        className: 'reply-input input-comment',
        id: divId,
        name: 'reply',
        placeholder: 'Réponse...'
    })
    form.appendChild(textAreaInput);

    /* Le boutton pour envoyer la réponse: button*/
    var submitButton = document.createElement("button");
    Object.assign(submitButton, {
        className: 'submit-btn',
        type: 'submit'
    })
    submitButton.innerHTML = 'Répondre';
    form.appendChild(submitButton);

    return replyFormContainer;
}

