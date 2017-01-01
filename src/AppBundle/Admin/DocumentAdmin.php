<?php
namespace AppBundle\Admin;

use AppBundle\Form\Type\ModelListType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FormType;

class DocumentAdmin extends AbstractAdmin
{
    private $service;
    private $uploadUrl;

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('libelle')
            ->add('fichier', 'file', ['data_class' => null, 'required' => false])
            ->add(
                'categories',
                'sonata_type_model',
                [
                    'multiple' => true,
                    'by_reference' => false
                ])
            ->add(
                'historiques',
                ModelListType::class,
                [
                    'label' => 'Historique',
                    'disabled' => true
                ])
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('libelle')
            ->add('fichier')
            ->add('categories')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id', null, ['label' => 'N° unique'])
            ->add(
                'fichier.nomFichier',
                null,
                [
                    'label' => 'Document',
                    'template' => 'SonataAdminBundle:CRUD:list_link_field.html.twig',
                    'path' => $this->uploadUrl
                ])
            ->add('categories')
            ->add(
                'historiques',
                null,
                [
                    'label' => 'Dernière action',
                    'template' => 'SonataDoctrineORMAdminBundle:CRUD:list_orm_one_to_many_last_row.html.twig'
                ])
        ;
    }

    public function __construct($code, $class, $baseControllerName, $uploadUrl, $service = null)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->service = $service;
        $this->uploadUrl = $uploadUrl;
    }

    public function prePersist($document) {
        $this->manageFileUpload($document, 1);
    }

    public function preUpdate($document) {
        $this->manageFileUpload($document, 2);
    }

    private function manageFileUpload($document, $actionId) {
        if ($document->getFichier()) {
            $this->service->upload($document);
        }
        $this->service->refreshUpdated($document, $actionId);
    }

    public function getFormTheme() {
        return array_merge(
            parent::getFormTheme(), [
                'SonataAdminBundle:CRUD:model_list_edit.html.twig']
        );
    }
}