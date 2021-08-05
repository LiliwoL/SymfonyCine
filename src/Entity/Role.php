<?php

namespace App/Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="Role", indexes={@ORM\Index(name="idMovie", columns={"idMovie"})})
 * @ORM\Entity
 */
class Role
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMovie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idmovie;

    /**
     * @var int
     *
     * @ORM\Column(name="idActor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idactor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="roleName", type="string", length=255, nullable=true)
     */
    private $rolename;


}
