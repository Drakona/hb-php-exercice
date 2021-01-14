<?php
declare(strict_types=1);
/**
 * Des exemples d'utilisation de la classe Beanie:
 * $b = new Beanie(); // On crée un nouvel objet (selon la classe) Beanie. Ce new appelle le constructeur
 * $b->id = 2; // met à jour la propriété id de l'objet si la propriété est publique (définie avec le mot clé public)
 * echo $b->id; // affiche ce qui affiche le contenu de la propriété id de l'objet, si la propriété est publique
 *
 * $b->setName('un nom'); // met à jour la propriété name (et fait peut être d'autres opérations) si la méthode setName() est publique
 */

class Beanie
{
    /** @var array */
    const AVAILABLE_SIZES = ['S', 'M', 'L', 'XL'];

    /** @var array */
    const AVAILABLE_MATERIALS = [
        'wool'     => 'Laine',
        'cashmere' => 'Cachemire',
        'silk'     => 'Soie',
    ];

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name = 'bonnet';

    /**
     * @var float
     */
    public $price;

    /**
     * @var float
     */
    public $priceHT;

    /**
     * @var string|null
     */
    public $description;

    /**
     * @var string|null
     */
    public $image = 'laine.webp';

    /**
     * @var array
     */
    public $materials = [];

    /**
     * @var array
     */
    public $sizes = [];

    /**
     * Le contructeur de notre classe Beanie, il va être appelé quand on va faire :
     * $bonnet = new Beanie();
     *
     * ATTENTION : ne pas confondre la variable $bonnet (instance de l'objet Beanie), de la classe Beanie (plan de fabrication d'un objet de type Beanie)
     *
     * @param float $price
     */
    public function __construct($price = 0.0)
    {
        // Ici, on peut passer une valeur de prix directement dans le constructeur et notre objet sera à jour en conséquence.
        // new Beanie(12); mettra à jour la propriété $this->price
        $this->setPrice($price);
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param float $prixTTC
     */
    public function setPrice(float $prixTTC)
    {
        $this->price = $prixTTC;
        $this->priceHT = $prixTTC / 1.2;
    }

    /**
     * On vérifie si la propriété size de notre object contient la valeur $size demandé
     * La documentation de in_array() : https://www.php.net/manual/fr/function.in-array.php
     *
     * @param string $size
     *
     * @return bool
     */
    public function hasSize(string $size): bool
    {
        // On profite que in_array renvoie un booléen pour en retourner directement la valeur
        return in_array($size, $this->sizes);
    }

    /**
     * On vérifie si la propriété material de notre object contient la valeur $material demandé
     * La documentation de in_array() : https://www.php.net/manual/fr/function.in-array.php
     *
     * @param string $material
     *
     * @return bool
     */
    public function hasMaterial(string $material): bool
    {
        // On profite que in_array renvoie un booléen pour en retourner directement la valeur
        return in_array($material, $this->materials);
    }
}
