<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,)
     */
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $Description;

    /**
     * @ORM\Column(type="date")
     */
    private $DatedeCreation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Langue;

    /**
     * @ORM\OneToMany(targetEntity=Chapitre::class, mappedBy="Id_cours" )
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_chapitres;

    public function __construct()
    {
        $this->id_chapitres = new ArrayCollection();
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

    public function getDatedeCreation(): ?\DateTimeInterface
    {
        return $this->DatedeCreation;
    }

    public function setDatedeCreation(\DateTimeInterface $DatedeCreation): self
    {
        $this->DatedeCreation = $DatedeCreation;

        return $this;
    }

    public function getLangue(): ?string
    {
        return $this->Langue;
    }

    public function setLangue(string $Langue): self
    {
        $this->Langue = $Langue;

        return $this;
    }

    /**
     * @return Collection<int, chapitre>
     */
    public function getIdChapitres(): Collection
    {
        return $this->id_chapitres;
    }

    public function addIdChapitre(chapitre $idChapitre): self
    {
        if (!$this->id_chapitres->contains($idChapitre)) {
            $this->id_chapitres[] = $idChapitre;
            $idChapitre->setIdCours($this);
        }

        return $this;
    }

    public function removeIdChapitre(chapitre $idChapitre): self
    {
        if ($this->id_chapitres->removeElement($idChapitre)) {
            // set the owning side to null (unless already changed)
            if ($idChapitre->getIdCours() === $this) {
                $idChapitre->setIdCours(null);
            }
        }

        return $this;
    }
}
