<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DocumentRepository")
 */
class Document
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=100)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="fichier", type="string", length=100, nullable=true)
     */
    private $fichier;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fichier", type="string", length=100, nullable=true)
     */
    private $nomFichier;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Historique", mappedBy="document", cascade={"persist"})
     */
    private $historiques;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Theme", mappedBy="documents")
     */
    private $themes;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Categorie", inversedBy="documents")
     * @ORM\JoinTable(name="categorie_documents")
     */
    private $categories;

    /**
     * Document constructor.
     */
    public function __construct()
    {

        $this->historiques = new ArrayCollection();
        $this->categories = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Document
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Add historique
     *
     * @param \AppBundle\Entity\Historique $historique
     *
     * @return Document
     */
    public function addHistorique(\AppBundle\Entity\Historique $historique)
    {
        $this->historiques[] = $historique;

        return $this;
    }

    /**
     * Remove historique
     *
     * @param \AppBundle\Entity\Historique $historique
     */
    public function removeHistorique(\AppBundle\Entity\Historique $historique)
    {
        $this->historiques->removeElement($historique);
    }

    /**
     * Get historiques
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistoriques()
    {
        return $this->historiques;
    }

    /**
     * Add category
     *
     * @param \AppBundle\Entity\Categorie $category
     *
     * @return Document
     */
    public function addCategory(\AppBundle\Entity\Categorie $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Categorie $category
     */
    public function removeCategory(\AppBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add theme
     *
     * @param \AppBundle\Entity\Theme $theme
     *
     * @return Document
     */
    public function addTheme(\AppBundle\Entity\Theme $theme)
    {
        $this->themes[] = $theme;

        return $this;
    }

    /**
     * Remove theme
     *
     * @param \AppBundle\Entity\Theme $theme
     */
    public function removeTheme(\AppBundle\Entity\Theme $theme)
    {
        $this->themes->removeElement($theme);
    }

    /**
     * Get themes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getThemes()
    {
        return $this->themes;
    }

    /**
     * Set fichier
     *
     * @param UploadedFile $fichier
     *
     * @return Document
     */
    public function setFichier(UploadedFile $fichier = null)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return UploadedFile
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    public function setNomFichier($nomFichier)
    {
        $this->nomFichier = $nomFichier;

        return $this;
    }

    public function getNomFichier()
    {
        return $this->nomFichier;
    }
}
