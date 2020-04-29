buttonElt = document.querySelector("button");
var message ="kiki";

console.log(buttonElt);

buttonElt.addEventListener("click",function()
    {
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


    })

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