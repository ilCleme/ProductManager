<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use QwebCMS\CatalogoBundle\Entity\TblPhoto as Foto;

class FotoController extends Controller
{
    public function cancellaAction($id){

        $em = $this->getDoctrine()->getManager();
        $foto = $this->getDoctrine()
            ->getRepository('QwebCMSCatalogoBundle:TblPhoto')
            ->find($id);

        $em->remove($foto);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            'La foto è stata eliminata!'
        );

        return $this->render(
            'QwebCMSCatalogoBundle:Photo:delete.html.twig'
        );
    }

    public function updatePositionAction(){

        $request = $this->container->get('request');
        $data = $request->query->get('foto');
        $data = json_decode($data, true);

        $em = $this->getDoctrine()->getManager();

        $response = array("code" => 100, "success" => true);

        foreach($data as $key=>$value){

            if($response['success']){
                $foto = $this->getDoctrine()
                    ->getRepository('QwebCMSCatalogoBundle:TblPhoto')
                    ->find($value['id']);

                if (!$foto) {
                    /*$this->get('session')->getFlashBag()->add(
                        'danger',
                        'É avvenuto un errore. Non è stato possibile ordinare le foto.'
                    );*/

                    $response['success']= false;
                    return new Response(json_encode($response));
                }

                if($foto->getPosizione() != $key){
                    $foto->setPosizione($key);
                    $em->persist($foto);
                    $em->flush();
                }
            }
        }

        /*$this->get('session')->getFlashBag()->add(
            'notice',
            'Le foto sono state riordinate, le modifiche saranno visibili solo dopo aver ricaricato la pagina.'
        );*/

        $response = array("code" => 100, "success" => true, "data"=>$data);
        return new Response(json_encode($response));
    }
}
