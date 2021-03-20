<?php

class Viagem
{
    public $origem;
    public $destino;
    public $data_ida;
    public $data_volta;
    public $classe;
    public $adultos;
    public $criancas;
    public $preco;

    public function __construct(
        $origem,
        $destino,
        $data_ida,
        $data_volta,
        $classe,
        $adultos,
        $criancas,
        $preco
    ) {
        $this->origem = $origem;
        $this->destino = $destino;
        $this->data_ida = $data_ida;
        $this->data_volta = $data_volta;
        $this->classe = $classe;
        $this->adultos = $adultos;
        $this->criancas = $criancas;
        $this->preco = $preco;
    }
}
