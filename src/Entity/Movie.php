<?php

namespace App/Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movie
 *
 * @ORM\Table(name="Movie", indexes={@ORM\Index(name="codeCountry", columns={"codeCountry"}), @ORM\Index(name="idDirector", columns={"idDirector"})})
 * @ORM\Entity
 */
class Movie
{
    /**
     * @var int
     *
     * @ORM\Column(name="idMovie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmovie;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=80, nullable=false)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer", nullable=false)
     */
    private $year;

    /**
     * @var int|null
     *
     * @ORM\Column(name="idDirector", type="integer", nullable=true)
     */
    private $iddirector;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=20, nullable=false)
     */
    private $genre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="synopsis", type="text", nullable=true)
     */
    private $synopsis;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codeCountry", type="string", length=4, nullable=true)
     */
    private $codecountry;


}
