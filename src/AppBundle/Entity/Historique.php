<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique
 *
 * @ORM\Table(name="historique")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HistoriqueRepository")
 */
class Historique
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
     * @var \DateTime
     *
     * @ORM\Column(name="dt", type="datetime")
     */
    private $dt;

    /**
     * @var Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     */
    private $utilisateur;

    /**
     * @var Action
     *
     * @ORM\ManyToOne(targetEntity="Action")
     */
    private $action;

    /**
     * @var Document
     *
     * @ORM\ManyToOne(targetEntity="Document", inversedBy="historiques")
     */
    private $document;

    /**
     * @var Theme
     *
     * @ORM\ManyToOne(targetEntity="Theme", inversedBy="historiques")
     */
    private $theme;

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
     * Set dt
     *
     * @param \DateTime $dt
     *
     * @return Historique
     */
    public function setDt($dt)
    {
        $this->dt = $dt;

        return $this;
    }

    /**
     * Get dt
     *
     * @return \DateTime
     */
    public function getDt()
    {
        return $this->dt;
    }

    /**
     * Set utilisateur
     *
     * @param \AppBundle\Entity\Utilisateur $utilisateur
     *
     * @return Historique
     */
    public function setUtilisateur(\AppBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \AppBundle\Entity\Utilisateur
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set action
     *
     * @param \AppBundle\Entity\Action $action
     *
     * @return Historique
     */
    public function setAction(\AppBundle\Entity\Action $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return \AppBundle\Entity\Action
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set document
     *
     * @param \AppBundle\Entity\Document $document
     *
     * @return Historique
     */
    public function setDocument(\AppBundle\Entity\Document $document = null)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return \AppBundle\Entity\Document
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set theme
     *
     * @param \AppBundle\Entity\Theme $theme
     *
     * @return Historique
     */
    public function setTheme(\AppBundle\Entity\Theme $theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return \AppBundle\Entity\Theme
     */
    public function getTheme()
    {
        return $this->theme;
    }

    public function __toString()
    {
        return $this->action . ' par ' . $this->utilisateur . ' le ' . $this->dt->format('d/m/Y à H:i:s');
    }
}
