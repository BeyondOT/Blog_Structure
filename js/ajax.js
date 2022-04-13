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
    var link;
    // Boucle pour avoir chaque boutton appart
    for(var i = 0; i < links.length; i++){
        link = links[i];
        link.onclick = function(e){
            e.preventDefault();
            httpRequest = getHttpRequest();

            // Check si HttpRequest a bien ete initialisé
            if (!httpRequest) {
                alert('Abandon :( Impossible de créer une instance de XMLHTTP');
                return false;
            }
            //TODO: Comprendre comment ajax  marche vraiment
            httpRequest.open('GET', this.getAttribute('href'),true);
            httpRequest.send();
            var comment = document.querySelector("#"+CSS.escape(this.id)+".admin-comment-wrapper");
            comment.classList.add('deleted-comment');     
            
        } 
    }
}

function changeContent() {
	
}


