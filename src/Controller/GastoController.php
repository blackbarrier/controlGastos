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
        
        $total=0;       
        for($i=0;$i<count($listado);$i++){
            $monto=$listado[$i]->getMonto();
            $total+=$monto;            
        };   


        return $this->render('gasto/index.html.twig', [
            "listado"=>$listado,
            "total"=>$total  
        ]);        
    }


    /**
     * @Route("/agregar/{id?null}", name="agregar")
     */
    public function agregar($id, GastoRepository $repogasto )
    {

        if (! $_POST
            || trim($_POST['descripcion'])   === ''
            || trim($_POST['monto'])     === ''
            ) {
            return $this->redirectToRoute('index');
            }

        
        $descripcion=$_POST["descripcion"];
        $monto=$_POST["monto"];

        if($id=="null"){
        $item = new Gasto();
        }else{
        $item = $repogasto->findOneBy(["id"=>$id]); 
        }      
       
        $item->setDescripcion($descripcion);
        $item->setMonto($monto);
        $repogasto->add($item,TRUE);
        
        return $this->redirectToRoute('index');
    }


    /**
     * @Route("/modificar/{id?null}", name="modificar")
     */

    public function modificar($id, GastoRepository  $repogasto)    {
        dd("Estas entrando en el lugar incorrecto");
        // if (! $_POST
        // || trim($_POST['descripcion'])   === ''
        // || trim($_POST['monto'])     === ''
        // ) {
        // return $this->redirectToRoute('index');
        // }
        
        // $descripcion=$_POST["descripcion"];;
        // $monto=$_POST["monto"];

        // $item = $repogasto->findOneBy(["id"=>$id]);        
        // $item->setDescripcion($descripcion);
        // $item->setMonto($monto);
        // $repogasto->add($item, true);
        // return $this->redirectToRoute('index'); 
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

}