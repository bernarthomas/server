<?php
namespace AppBundle\Service;

use AppBundle\Entity\Document as DocumentEntity;
use AppBundle\Entity\Historique;
use Doctrine\ORM\EntityRepository;

class Document
{
    private $actionRepository;
    private $securityTokenStorage;
    private $uploadPath;

    public function __construct(EntityRepository $actionRepository, $securityTokenStorage, $uploadPath)
    {
        $this->actionRepository = $actionRepository;
        $this->uploadPath = $uploadPath;
        $this->securityTokenStorage = $securityTokenStorage;
    }

    public function refreshUpdated(DocumentEntity $document, $actionId)
    {
        $action = $this->actionRepository->find($actionId);
        $utilisateur = $this->securityTokenStorage->getToken()->getUser();
        $historique = new Historique();
        $historique
            ->setAction($action)
            ->setDocument($document)
            ->setDt(new \DateTime())
            ->setTheme(null)
            ->setUtilisateur($utilisateur)
        ;
        $document->addHistorique($historique);

        return $this;
    }

    public function upload($document)
    {
        $fichier = $document->getFichier();
        $nomFichier = $fichier->getClientOriginalName();
        $document->setNomFichier($nomFichier);
        if (null === $fichier) {
            return;
        }
        $fichier->move($this->uploadPath, $nomFichier);
        $document->setNomFichier($nomFichier);

        return $this;
    }

}