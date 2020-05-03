buttons = document.querySelectorAll("button");
var message ="kiki";

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
            var prout = buttons[i];
            console.log(prout)
            prout.addEventListener('click', popup);
        }

    }


)





function redirect()
{
    window.location = '../public/index.php';
}

/*

public function alert($message) {
    $alert = "<script>alert('$message');</script>";
    echo filter_var($alert);
}

public function redirect($url)
{
    $redirect = "<script>window.location = '$url'</script>";
    echo filter_var($redirect);
}
*/