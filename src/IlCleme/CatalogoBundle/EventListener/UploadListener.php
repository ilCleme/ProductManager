<?php

namespace IlCleme\CatalogoBundle\EventListener;

use Oneup\UploaderBundle\Event\PostPersistEvent;
use IlCleme\CatalogoBundle\Entity\Photo as Foto;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;


class UploadListener{

    public function __construct(Registry $doctrine, ContainerInterface $container)
    {
        $this->doctrine = $doctrine;
        $this->container = $container;
    }

    public function onUpload(PostPersistEvent $event)
    {
        $type = $event->getType();

        if ($type == 'gallery'){
            $this->uploadGalleryType($event);
        } elseif ($type == 'planimetrie') {
            $this->uploadPlanimetriaType($event);
        }
    }

    public function uploadGalleryType(PostPersistEvent $event){
        $request = $event->getRequest();
        //$response = $event->getResponse();
        $id_album = $request->headers->get('id-album');

        $em = $this->doctrine->getManager();
        $album = $em->getRepository('IlClemeCatalogoBundle:Album')
            ->find($id_album);

        $file_upload = $event->getFile();

        $imagemanagerResponse = $this->container->get('liip_imagine.controller');

        $filters = $this->container->get('liip_imagine.filter.manager')->getFilterConfiguration()->all();

        foreach($filters as $key => $value){
            $imagemanagerResponse->filterAction($request, $file_upload, $key);
        }

        $foto = new Foto();
        $foto->setNome($file_upload->getFilename());
        $foto->setImg('/'.$file_upload->getPathname());
        $foto->setAlbum($album);
        $foto->setIdTblLingua($this->container->get('language.manager')->getSessionLanguage());

        $em->persist($foto);
        $em->flush();
    }

    public function uploadPlanimetriaType(PostPersistEvent $event){
        $request = $event->getRequest();
        $id_product = $request->headers->get('id-product');

        $file_upload = $event->getFile();

        /*
        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'img_preview');

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'img_small');

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'img_medium');

        $imagemanagerResponse = $imagemanagerResponse = $this->container
            ->get('liip_imagine.controller')
            ->filterAction($this->container->get('request'), $file_upload, 'img_large');
        */
        $em = $this->doctrine->getManager();

        $product = $em->getRepository('IlClemeCatalogoBundle:Product')->find($id_product);
        $product->setPlanimetria('/'.$file_upload->getPathname());

        $em->persist($product);
        $em->flush();
    }

}