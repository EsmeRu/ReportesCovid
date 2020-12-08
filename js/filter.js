
$( "#filtro" ).change(function( event ) {
    event.preventDefault();
    const filter = $( "#filtro" ).val();
    console.log(filter)
    fetch('./filters.php', {
        method: 'POST', // or 'PUT'
        body: JSON.stringify(filter), // data can be `string` or {object}!
        headers:{
          'Content-Type': 'application/json'
        }   
    })
    .then(response => response.json())
    .then(data => console.log(data));
  });
  