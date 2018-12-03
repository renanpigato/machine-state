<?php

namespace System;

use StateMachine\EntradaQuery;
use StateMachine\EstadoQuery;
use StateMachine\TransicaoQuery;

class App { 

    private static $instance;
    private $entradas;
    private $estados;
    private $transicoes;

    public function __construct() {}
  
    public static function getInstance() {
  
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
        }
  
        return self::$instance;
    }

    public function init() {
        $this->execute();
        require_once('views/true_table.php');
    }
  
    protected function execute()
    {
        $this->entradas      = EntradaQuery::create()->find()->getData();
        $this->transicoes    = TransicaoQuery::create()->find()->getData();
        $estados             = EstadoQuery::create()->find()->getData();
        $estadosExibir       = [];

        do {

          $estado            = current($estados);
          $estadosExibir[]   = $estado;
          $transicoesEstado  = $estado->getTransicaosRelatedByIdEstadoDestino();

          if(!empty($transicoesEstado)) {
            
            $transicoesEstado = $transicoesEstado->getIterator();

            do {
              $transicaoEstado = $transicoesEstado->getCurrent();
              $estadoFuturo    = EstadoQuery::create()->filterById($transicaoEstado->getIdEstadoDestino())->findOne();
              
              // kill($estadoFuturo);
              $estadosExibir[] = $estadoFuturo;
            } while (!$transicoesEstado->isLast());
          }
          
        } while (next($estados));

        $this->estados = $estadosExibir;
    }

    /**
     * @return mixed
     */
    public function getEntradas()
    {
        return $this->entradas;
    }

    /**
     * @param mixed $entradas
     *
     * @return self
     */
    public function setEntradas($entradas)
    {
        $this->entradas = $entradas;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEstados()
    {
        return $this->estados;
    }

    /**
     * @param mixed $estados
     *
     * @return self
     */
    public function setEstados($estados)
    {
        $this->estados = $estados;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTransicoes()
    {
        return $this->transicoes;
    }

    /**
     * @param mixed $transicoes
     *
     * @return self
     */
    public function setTransicoes($transicoes)
    {
        $this->transicoes = $transicoes;

        return $this;
    }
}
