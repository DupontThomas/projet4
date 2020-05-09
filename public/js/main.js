
/*Display a popup when a button is clicked*/
buttons = document.querySelectorAll("button");
var message ="";

window.addEventListener("load", function()
    {
        var popup = function(event)
        {
            var buttonElt = event.target;

            if (buttonElt.classList.contains("modifyPost"))
            {
                message = "Ce chapitre a bien été modifié.";
                alert(message);
            }
            else if (buttonElt.classList.contains("deletePost"))
            {
                message = "Ce chapitre a bien été supprimé."
                alert(message);
            }
            else if (buttonElt.classList.contains("reportComment"))
            {
                message = "Ce commentaire a bien été signalé."
                alert(message);
            }
        }
        for(var i=0;i<buttons.length;i++){
            var count = buttons[i];
            count.addEventListener('click', popup);
        }
    }
)

/*display an extract of the posts*/
var extract = document.querySelectorAll(".extract");
for ( let i=0;i<extract.length;i++) {
    let count = extract[i];
    count.innerHTML = count.innerHTML.substr(0,300)+"...";
}

