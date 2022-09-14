<?php


namespace Model;

class Propuesta extends ActiveRecord{
    protected static $tabla='propuestas';
    protected static $columnasDB=['id','adquisicion','cliente','algoritmo','valorPesoDolar','valorPeso','utilidadVendedor','transporte','sumaPorcentaje','provedor','numeroVenta'
                                    ,'margenNegociacion','item','gastoOperativo','flete','diasMaximos','diasHabiles','creditoPorcentaje','credito','costoPorItem','costeEmpresa','clienteNombre'];
    public $id;
    public $adquisicion;
    public $cliente;
    public $algoritmo;
    public $valorPesoDolar;
    public $valorPeso;
    public $utilidadVendedor;
    public $transporte;
    public $sumaPorcentaje;
    public $provedor;
    public $numeroVenta;
    public $margenNegociacion;
    public $item;
    public $gastoOperativo;
    public $flete;
    public $diasMaximos;
    public $diasHabiles;
    public $creditoPorcentaje;
    public $credito;
    public $costoPorItem;
    public $costeEmpresa;
    public $clienteNombre;
    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->adquisicion=$args['adquisicion'] ?? '';
        $this->cliente=$args['cliente'] ?? '';
        $this->algoritmo=$args['algoritmo'] ?? '';
        $this->valorPesoDolar=$args['valorPesoDolar'] ?? '';
        $this->valorPeso=$args['valorPeso'] ?? '';
        $this->utilidadVendedor=$args['utilidadVendedor'] ?? '';
        $this->transporte=$args['transporte'] ?? '';
        $this->sumaPorcentaje=$args['sumaPorcentaje'] ?? '';
        $this->provedor=$args['provedor'] ?? '';
        $this->numeroVenta=$args['numeroVenta'] ?? '';
        $this->margenNegociacion=$args['margenNegociacion'] ?? '';
        $this->item=$args['item'] ?? '';
        $this->gastoOperativo=$args['gastoOperativo'] ?? '';
        $this->flete=$args['flete'] ?? '';
        $this->diasMaximos=$args['diasMaximos'] ?? '';
        $this->diasHabiles=$args['diasHabiles'] ?? '';
        $this->creditoPorcentaje=$args['creditoPorcentaje'] ?? '';
        $this->credito=$args['credito'] ?? '';
        $this->costoPorItem=$args['costoPorItem'] ?? '';
        $this->costeEmpresa=$args['costeEmpresa'] ?? '';
        $this->clienteNombre=$args['clienteNombre'] ?? '';
    }
    //Mensajes de validacion para la creacion de una cuenta
   
}