
$( "#btnFiltro" ).click(function( event ) {
    event.preventDefault();

    const filtro_municipio = $( "#filtro_municipio" ).val();
    const filtro_ciudad = $( "#filtro_ciudad" ).val();
    const filtro_estatus = $( "#filtro_estatus" ).val();
    let data = {};

    if(filtro_municipio) {
        data = {...data, filtro_municipio};
    }
    if(filtro_ciudad) {
        data = {...data, filtro_ciudad};
    }
    if(filtro_estatus) {
        data = {...data, filtro_estatus};
    }
    console.log(data)
    $.ajax({
        type: "POST",
        url: './filters.php',
        data,
        success: function(filter){ 
            console.log(filter)
            if(filter.length > 0) {
                updateTable(filter)
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No hay registros con esa característica',
                    footer: ''
                  })
            }
        },
        dataType: "json"
      });

  });

const updateTable = (data = []) => {
    const table = document.getElementById("tableRows");
    let result = "";
    data.forEach(element => {
        const color = element.StatusRepo === 'Confirmado' ? 'green;' : element.StatusRepo === 'En proceso' ? 'blue;' : element.StatusRepo === 'Rechazado' ? 'red;' : 'grey;';
         result += `
            <tr class="tr-shadow">
            <td>${element.NombreCliente}</td>
            <td>${element.NombreMunicipio}</td>
            <td>${element.NombreCiudad}</td>
            <td>${element.Dirección}</td>
            <td>${element.Fecha}</td>
            <td style="color: ${color}">${element.StatusRepo}</td>
            <td >
                <div class="flex-container" style="justify-content: space-evenly;">
                    <a class="item" title="eliminar">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                    <a href="./reporte.php?action=ver&id=${element.idReporte}" class="item" title="Más" name="Reporte" id="${element.idReporte}">
                    <i class="fas fa-ellipsis-h"></i>
                    </a>
                </div>
            </td>
        </tr>
        <tr class="spacer"></tr>
        `
    })

    table.innerHTML = result
}

document.querySelectorAll("#ocultar").forEach(btn=>{
    btn.addEventListener("click",e =>{
        const parentDiv = e.target.parentElement
        const parentTd = parentDiv.parentElement
        const parentTr = parentTd.parentElement
        const parentTbody = parentTr.parentElement
        const parentTable = parentTbody.parentElement
        parentTable.removeChild(parentTbody);
    })
});

