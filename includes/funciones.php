<?php
require __DIR__ . '/../vendor/autoload.php';
define('CARPETA_IMAGENES',$_SERVER['DOCUMENT_ROOT'] . '/imagenes');
define('CARPETA_ARCHIVO',$_SERVER['DOCUMENT_ROOT'] . '/archivos');
function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
//Comprobar si es valido el id que se extrae del GET
function validarOredireccionar(string $url)
{
    $id=$_GET['id'];
    $id=filter_var($id,FILTER_VALIDATE_INT);
    if(!$id){
        header("Location: ${url}");
    }
    return $id;
}
function expira()
{
    $fechaGuardada=$_SESSION["ultimoAcceso"];
    $ahora=date("Y-n-j H:i:s");
    $tiempo_transcurido=(strtotime($ahora)-strtotime($fechaGuardada));
    if($tiempo_transcurido >=1200){
        session_destroy();
       
    }
}
// Muestra los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        case 5: 
            $mensaje='Enviado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}
//Verificar que la persona sea el admin
function isAuth(){
    $valor=$_SESSION['login'];
    if(!isset($valor) || $_SESSION['rol']!=="0"){
        header('Location: /');
    }
}
//Verificar que la persona sea un Lider
function isLider()
{
    $valor=$_SESSION['login'];
    if(!isset($valor) || $_SESSION['rol']!=="1"){
        header('Location: /');
    }
}
//Verficiar que la persona sea un Usuario
function isUsuario()
{
    $valor=$_SESSION['login'];
    if(!isset($valor) || $_SESSION['rol']!=="2"){
        header('Location: /');
    }
}
function crearPDF($tablon,$grupos,$tareas,$usuarioTareas)
{
    
    require 'build/fpdf/fpdf.php';
    $pdf=new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Times','B',20);
    $pdf->Image('build/img/logo-terzett.png',0,0,70);
    $pdf->setXY(80,15);
    $pdf->Cell(100,8,utf8_decode ($tablon->nombre),0,1,'C',0);
    $pdf->Ln(5);
    $pdf->SetX(90);
    $pdf->Cell(100,8,"Lider:"."". utf8_decode($tablon->lider),0,1,'C',0);
    $pdf->Ln(5);
    $pdf->SetX(80);
    $pdf->Cell(100,8,"Fecha de creacion: ". " ".$tablon->fecha,0,1,'C',0);
    $pdf->Ln(20);
    $pdf->SetFillColor(233,229,235);
    $pdf->SetDrawColor(61,61,61);
    foreach($grupos as $grupo){
        $pdf->setX(1);
        $pdf->Cell(70,8,utf8_decode($grupo->nombre),1,0,'C',0);
        $pdf->Cell(60,8,'Personas',1,0,'C',0);
        $pdf->Cell(40,8,'Estado',1,0,'C',0);
        $pdf->Cell(45,8,'Fecha',1,1,'C',0);
       

        foreach($tareas as $tarea)
        {
            if($tarea->IdGrupo==$grupo->id)
            {
                $pdf->setX(1);
                $pdf->Cell(70,8,utf8_decode($tarea->nombre),0,0,'C',0);
                foreach($usuarioTareas as $usuarioTarea)
                {
                    $pdf->setX(70);
                    if($tarea->id==$usuarioTarea->IdTarea)
                    {
                        $pdf->Cell(60,8,utf8_decode($usuarioTarea->nombre),0,1,'C',0);
                        $pdf->setX(35);
                    }
                    
                    

                }
                $pdf->setX(132);
                if($tarea->estado=='0')
                {
                    $pdf->Cell(40,-8,"Nueva",0,0,'C',0);
                }elseif($tarea->estado=='1')
                {
                    $pdf->Cell(40,-8,"Proceso",0,0,'C',0);
                }elseif($tarea->estado=='2')
                {
                    $pdf->Cell(40,-8,"Estancada",0,0,'C',0);
                }elseif($tarea->estado=='3')
                {
                    $pdf->Cell(40,-8,"Lista",0,0,'C',0);
                }
                $pdf->setX(170);
                $pdf->Cell(45,-8,$tarea->fecha,0,0,'C',0);
            }
            
             
        }
        $pdf->Ln(25);
        // $pdf->Cell(15,8,'Personas',0,0,'C',0);
        // $pdf->Cell(130,8,'Estado',0,0,'C',0);
        // $pdf->Cell(-15,8,'Fecha',0,1,'C',0);
        
        // $pdf->Cell(15,8,'20%',0,0,'C',0);
        // $pdf->Cell(130,8,'30%',0,0,'C',0);
        // $pdf->Cell(-15,8,'40%',0,1,'C',0); 
        // $pdf->Ln(15);

    }    
    
    
    




    
    $pdf->Output();
}
