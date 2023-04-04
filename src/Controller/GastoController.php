<?php

namespace App\Controller;

use App\Entity\Gasto;
use App\Repository\GastoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GastoController extends AbstractController

{
    /**
     * @Route("/", name="index")
     */
    public function index(GastoRepository $repogasto): Response
    {
        $listado = $repogasto->findAll();

        return $this->render('gasto/index.html.twig', [
            "listado"=>$listado
        ]);        
    }


    /**
     * @Route("/agregar", name="agregar")
     */
    public function agregar(GastoRepository $repogasto )
    {
        $descripcion=$_POST["descripcion"];
        $monto=$_POST["monto"];
        $item = new Gasto();
        $item->setDescripcion($descripcion);
        $item->setMonto($monto);
        $repogasto->add($item,TRUE);
        
        return $this->redirectToRoute('index');
    }


    /**
     * @Route("/modificar/{id?null}", name="modificar")
     */

    public function modificar($id, GastoRepository  $repogasto)    {
        
        $descripcion=$_POST["descripcion"];;
        $monto=$_POST["monto"];

        $item = $repogasto->findOneBy(["id"=>$id]);        
        $item->setDescripcion($descripcion);
        $item->setMonto($monto);
        $repogasto->add($item, true);
        return $this->redirectToRoute('index'); 
        }    


    /**
     * @Route("/eliminar/{id}", name="eliminar")
     */
    public function eliminar($id, GastoRepository  $repogasto)     
    {
    
        $item = $repogasto->findOneBy(["id"=>$id]);
        $repogasto->remove($item,true);
        return $this->redirectToRoute('index');       
        }

    
    /**
     * @Route("/prueba", name="prueba")
     */
    public function prueba()     
    {    
        dd("FALLLAA");
    }

     /**
     * @Route("/prueba2", name="prueba2")
     */
    public function prueba2()     
    {    
        dd("EXITOOOOOOOOOO");
    }

}