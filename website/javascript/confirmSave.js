function confirmerChangement() {
    return "Êtes-vous sûr de vouloir quitter cette page ?";
}

function ajouterEcouteurInputs() {
    var inputs = document.querySelectorAll('input[type="text"], input[type="password"]');

    inputs.forEach(function(input) {
        input.addEventListener('input', function() {
            window.onbeforeunload = confirmerChangement;
        });
    });
}

function ajouterEcouteurLien() {
    var lien = document.getElementById('otp_lien');

    lien.addEventListener('click', function() {
        window.onbeforeunload = confirmerChangement;
    });
}



ajouterEcouteurInputs();
ajouterEcouteurLien();