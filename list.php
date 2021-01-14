<?php
    //on change le titre de notre page. La variable $pageTitle est appelée dans header.php.
    $pageTitle = 'Liste des bonnets';
    include 'includes/header.php';

    // On fait une copie de notre tableau de produits. Ca n'est pas forcément nécessaire,
    // mais si on filtre directement sur $mesProduits, on modifie ce tableau pour toute la suite du chargement de la page.
    $products = $mesProduits;

    // On initialise des variables qui vont contenir les valeurs de nos filtres (pour l'affichage surtout).
    $size = null;
    $material = null;
    $minPrice = null;
    $maxPrice = null;

    // On regarde si on a le paramètre size dans notre URL et s'il n'est pas vide
    if (!empty($_GET['size'])) {
        // On le met dans notre variable pour l'afficher plus tard
        $size = $_GET['size'];
        // On filtre la liste des produits avec array_filter()
        // Cette fonction parcourt notre tableau et, pour chaque élément, va renvoyer true ou false,
        // selon si elle correspond ou non à notre filtre.
        $products = array_filter($products, function (Beanie $product) use ($size) {
            // Notre filtre vérifie si notre objet a la taille demandée (par exemple 'S')
            // Si c'est le cas, on renvoie true et on garde ce bonnet dans notre tableau $products, sinon on l'enlève.
            return $product->hasSize($size); // On a créé une méthode dans notre classe Beanie pour répondre à cette question
        });
    }

    // On reproduit le même fonctionnement pour les matières
    if (!empty($_GET['material'])) {
        $material = $_GET['material'];
        $products = array_filter($products, function (Beanie $product) use ($material) {
            // Notre filtre vérifie si notre objet est fabriqué avec la matière demandée (par exemple, en laine)
            // Si c'est le cas, on renvoie true et on garde ce bonnet dans notre tableau $products, sinon on l'enlève.
            return $product->hasMaterial($material); // On a créé une méthode dans notre classe Beanie pour répondre à cette question
        });
    }

    if (!empty($_GET['minPrice'])) {
        $minPrice = $_GET['minPrice'];
        $products = array_filter($products, function (Beanie $product) use ($minPrice) {
            return $product->price >= $minPrice;
        });
    }

    if (!empty($_GET['maxPrice'])) {
        $maxPrice = $_GET['maxPrice'];
        $products = array_filter($products, function (Beanie $product) use ($maxPrice) {
            return $product->price <= $maxPrice;
        });
    }
?>
<!-- Notre formulaire de filtres va se soumettre sur la même page et les données de ses champs vont être mis dans l'url -->
<form action="" method="GET">
    <select name="size" id="size">
        <option value="">Taille</option>
        <?php
        // On appelle notre constante de classe pour récupérer un tableau des tailles disponibles
        foreach (Beanie::AVAILABLE_SIZES as $availableSize) {
            ?>
        <!-- Pour afficher les valeurs, j'utilise les balises echo courtes pour ne pas avoir à taper le echo à chaque fois -->
        <!-- J'ajoute également l'attribut selected si cette option est celle qui est déjà entrée dans le formulaire -->
        <option value="<?= $availableSize; ?>" <?= $size == $availableSize ? 'selected' : ''; ?>>
            <?= $availableSize; ?>
        </option>
        <?php
        }
    ?>
    </select>
    <select name="material" id="material">
        <option value="">Matière</option>
        <?php
        // On appelle notre constante de classe pour récupérer un tableau des matières disponibles
        // Ici, notre tableau de matières est composé de noms formels, utilisés en interne (en anglais et minuscule dans mon cas)
        // en tant qu'index du tableau, et de noms réels, en français, pour l'affichage.
        foreach (Beanie::AVAILABLE_MATERIALS as $key => $translation) {
            ?>
        <!-- Pour afficher les valeurs, j'utilise les balises echo courtes pour ne pas avoir à taper le echo à chaque fois -->
        <!-- J'ajoute également l'attribut selected si cette option est celle qui est déjà entrée dans le formulaire -->
        <option value="<?= $key; ?>" <?= $material == $key ? 'selected' : ''; ?>>
            <?= $translation; ?>
        </option>
        <?php
        }
    ?>
    </select>
    <!-- Pour les filtres de prix, je mets la valeur déjà entrée pour la ré-afficher -->
    <input type="number" name="minPrice" min="0" max="100"
        value="<?= $minPrice; ?>">
    <input type="number" name="maxPrice" min="0" max="100"
        value="<?= $maxPrice; ?>">

    <button type="submit">Valider</button>
</form>
<!-- La balise table défini le cadre du table, tr une ligne et th des cellules de titre (affiché en gras et avec du texte centré par défaut) -->
<table>
    <tr>
        <th>
            Nom du produit
        </th>
        <th>
            Prix HT
        </th>
        <th>
            Prix TTC
        </th>
        <th>
            Description
        </th>
        <th>
            Actions
        </th>
    </tr>
    <!-- n'importe où dans notre html, on peut faire appel à php pour ajouter du texte, faire des calculs, etc. -->
    <?php
            // pour appeler les différentes lignes de notre tableau, on parcourt le tableau $products,
            // défini dans le fichier vars.php (disponible dans ce fichier grâce à l'import en début de fichier)
            foreach ($products as $produit) {
                // On appelle la fonction afficheProduit, en passant en paramètre le produit en cours
                afficheProduit($produit);
            }
        ?>
</table>

<?php include 'includes/footer.php';
