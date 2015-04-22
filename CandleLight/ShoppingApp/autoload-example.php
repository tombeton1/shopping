<?php
/**
 * Created by PhpStorm.
 * User: lenny
 * Date: 22/04/15
 * Time: 01:41
 */
// Elke file waar je autoloading wil toepassen moet deze file geinclude worden
require_once '../vendor/autoload.php';

// aliasen van de namespace dat je wil instantiaten bv. member
use ShoppingApp\Bo\Member as Member;

// instantie maken van classe
$Member = new Member();

/* telkens er een nieuwe classe wordt aangemaakt moet je met de command-line naar de root van het project gaan en dan "composer dump-autoload -o'
uitvoeren als je dit niet doet wordt de nieuwe classe niet herkend in de autoloader