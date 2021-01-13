<?php
    include 'includes/header.php';

    //Par exemple, on peut appeler le lien : cart-remove.php?id=666 pour enlever un bonnet ayant pour id 666.
    if (isset($_GET['id'])) {
        // On passe l'id de notre objet, puisque (pour le moment), c'est la seule information que l'on utilise
        $cart->remove($_GET['id']);
    }

    header('Location: cart.php');
