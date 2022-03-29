<?php

namespace App\Entity;

use App\Repository\ObjectifRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjectifRepository::class)
 */
class Objectif
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Description;

    /**
     * @ORM\ManyToMany(targetEntity=Section::class, mappedBy="List_Objectif")
     */
    private $List_Sections;

    
    public function __construct()
    {
        $this->List_Sections = new ArrayCollection();
        $this->list_Ressource = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection<int, Section>
     */
    public function getListSections(): Collection
    {
        return $this->List_Sections;
    }

    public function addListSection(Section $listSection): self
    {
        if (!$this->List_Sections->contains($listSection)) {
            $this->List_Sections[] = $listSection;
            $listSection->addListObjectif($this);
        }

        return $this;
    }

    public function removeListSection(Section $listSection): self
    {
        if ($this->List_Sections->removeElement($listSection)) {
            $listSection->removeListObjectif($this);
        }

        return $this;
    }

    
}
