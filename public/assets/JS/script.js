let elements = document.getElementsByClassName("delete");

let myFunction = Swal.fire({
        title: 'Êtes-vous sûr(e)?',
        text: "La suppression sera définitive.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Supprimer'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Suppression réussie',
                'success'
            )
        }
    });

for (let i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', myFunction, false);
}