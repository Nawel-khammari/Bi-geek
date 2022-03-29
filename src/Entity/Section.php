<?php

namespace App\Entity;

use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SectionRepository::class)
 */
class Section
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
     * @ORM\ManyToOne(targetEntity=Chapitre::class, inversedBy="List_Section")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Id_Chapitre;

    /**
     * @ORM\ManyToMany(targetEntity=Objectif::class, inversedBy="List_Sections")
     */
    private $List_Objectif;

    /**
     * @ORM\OneToMany(targetEntity=Ressource::class, mappedBy="section")
     */
    private $list_Ressource;

    public function __construct()
    {
        $this->List_Objectif = new ArrayCollection();
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

    public function getIdChapitre(): ?Chapitre
    {
        return $this->Id_Chapitre;
    }

    public function setIdChapitre(?Chapitre $Id_Chapitre): self
    {
        $this->Id_Chapitre = $Id_Chapitre;

        return $this;
    }

    /**
     * @return Collection<int, Objectif>
     */
    public function getListObjectif(): Collection
    {
        return $this->List_Objectif;
    }

    public function addListObjectif(Objectif $listObjectif): self
    {
        if (!$this->List_Objectif->contains($listObjectif)) {
            $this->List_Objectif[] = $listObjectif;
        }

        return $this;
    }

    public function removeListObjectif(Objectif $listObjectif): self
    {
        $this->List_Objectif->removeElement($listObjectif);

        return $this;
    }

    /**
     * @return Collection<int, Ressource>
     */
    public function getListRessource(): Collection
    {
        return $this->list_Ressource;
    }

    public function addListRessource(Ressource $listRessource): self
    {
        if (!$this->list_Ressource->contains($listRessource)) {
            $this->list_Ressource[] = $listRessource;
            $listRessource->setSection($this);
        }

        return $this;
    }

    public function removeListRessource(Ressource $listRessource): self
    {
        if ($this->list_Ressource->removeElement($listRessource)) {
            // set the owning side to null (unless already changed)
            if ($listRessource->getSection() === $this) {
                $listRessource->setSection(null);
            }
        }

        return $this;
    }
}
