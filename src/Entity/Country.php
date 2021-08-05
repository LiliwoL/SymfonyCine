<?php

namespace App/Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Country
 *
 * @ORM\Table(name="Country")
 * @ORM\Entity
 */
class Country
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=4, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false, options={"default"="Unknown"})
     */
    private $name = 'Unknown';

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=30, nullable=false)
     */
    private $language;


}
