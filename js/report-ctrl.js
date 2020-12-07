$('#enviarRepo').click((e)=>{
    const direccion = document.getElementById("direccion").value;
    const descripcion = document.getElementById("descripcion").value;
})

const setDisabled = (action = "") => {
    if (action == "ver") {
        document.getElementById("municipios").disabled = true
        document.getElementById("ciudades").disabled = true
        document.getElementById("direccion").disabled = true
        document.getElementById("fechaReporte").disabled = true
        document.getElementById("descripcion").disabled = true
        document.getElementById("addBtn").disabled = true
    }
    else if(action == "editar"){
        document.getElementById("municipios").disabled = false
        document.getElementById("ciudades").disabled = false
        document.getElementById("direccion").disabled = false
        document.getElementById("fechaReporte").disabled = false
        document.getElementById("descripcion").disabled = false
        document.getElementById("addBtn").disabled = false

    }
    else if(action == "agregar"){
        document.getElementById("editBtn").disabled = true
    }
}