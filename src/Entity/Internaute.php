<?php

namespace App/Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Internaute
 *
 * @ORM\Table(name="Internaute")
 * @ORM\Entity
 */
class Internaute
{
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=40, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=30, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prÃ©nom", type="string", length=30, nullable=false)
     */
    private $prã©nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codeCountry", type="string", length=4, nullable=true)
     */
    private $codecountry;


}
