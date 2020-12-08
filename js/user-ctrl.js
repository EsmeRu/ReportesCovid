const setDisabled = (action = "") => {
    if (action == "ver") {
        document.getElementById("name").disabled = true
        document.getElementById("email").disabled = true
        document.getElementById("password").disabled = true
        document.getElementById("confirmBtn").style.display='none'
    }
    else if(action == "editar"){
        document.getElementById("name").disabled = false
        document.getElementById("email").disabled = false
        document.getElementById("password").disabled = false
        document.getElementById("confirmBtn").style.display='block'

    }
}