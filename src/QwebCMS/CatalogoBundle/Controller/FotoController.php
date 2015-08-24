<?php

namespace QwebCMS\CatalogoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
