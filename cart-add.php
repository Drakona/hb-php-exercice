<?php
    include 'includes/header.php';

    //Par exemple, on peut appeler le lien : cart-add.php?id=666 pour ajouter le bonnet ayant pour id 666.
    if (isset($_GET['id'])) {
        // On passe l'id de notre objet, puisque (pour le moment), c'est la seule information que l'on utilise
        $cart->add($_GET['id']);
    }

    header('Location: cart.php');
