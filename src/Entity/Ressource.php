<?php

namespace App\Entity;

use App\Repository\RessourceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RessourceRepository::class)
 */
class Ressource
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Chapitre::class, inversedBy="List_Ressource")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Id_Chapitre;

    /**
     * @ORM\ManyToOne(targetEntity=Section::class, inversedBy="list_Ressource")
     */
    private $section;

    public function getIdChapitre(): ?Chapitre
    {
        return $this->Id_Chapitre;
    }

    public function setIdChapitre(?Chapitre $Id_Chapitre): self
    {
        $this->Id_Chapitre = $Id_Chapitre;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    
}
