<?php

namespace App\Entity;

use App\Repository\ChapitreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChapitreRepository::class)
 */
class Chapitre
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
     * @ORM\Column(type="guid")
     */
    private $Nb_Section;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="id_chapitres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Id_cours;

    /**
     * @ORM\OneToMany(targetEntity=Section::class, mappedBy="Id_Chapitre")
     */
    private $List_Section;

    /**
     * @ORM\OneToMany(targetEntity=Ressource::class, mappedBy="Id_Chapitre")
     */
    private $List_Ressource;

    public function __construct()
    {
        $this->List_Section = new ArrayCollection();
        $this->List_Ressource = new ArrayCollection();
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

    public function getNbSection(): ?string
    {
        return $this->Nb_Section;
    }

    public function setNbSection(string $Nb_Section): self
    {
        $this->Nb_Section = $Nb_Section;

        return $this;
    }

    public function getIdCours(): ?Cours
    {
        return $this->Id_cours;
    }

    public function setIdCours(?Cours $Id_cours): self
    {
        $this->Id_cours = $Id_cours;

        return $this;
    }

    /**
     * @return Collection <int, section>
     */
    public function getListSection(): Collection
    {
        return $this->List_Section;
    }

    public function addListSection(section $listSection): self
    {
        if (!$this->List_Section->contains($listSection)) {
            $this->List_Section[] = $listSection;
            $listSection->setIdChapitre($this);
        }

        return $this;
    }

    public function removeListSection(section $listSection): self
    {
        if ($this->List_Section->removeElement($listSection)) {
            // set the owning side to null (unless already changed)
            if ($listSection->getIdChapitre() === $this) {
                $listSection->setIdChapitre(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ressource>
     */
    public function getListRessource(): Collection
    {
        return $this->List_Ressource;
    }

    public function addListRessource(ressource $listRessource): self
    {
        if (!$this->List_Ressource->contains($listRessource)) {
            $this->List_Ressource[] = $listRessource;
            $listRessource->setIdChapitre($this);
        }

        return $this;
    }

    public function removeListRessource(ressource $listRessource): self
    {
        if ($this->List_Ressource->removeElement($listRessource)) {
            // set the owning side to null (unless already changed)
            if ($listRessource->getIdChapitre() === $this) {
                $listRessource->setIdChapitre(null);
            }
        }

        return $this;
    }
}
