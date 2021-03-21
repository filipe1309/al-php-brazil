<?php

class Cliente
{
    public $nome;
    public $cpf_cnpj;
    public $telefone;
    public $email;
    public $cep;
    public $endereco;
    public $bairro;
    public $numero;
    public $cidade;
    public $uf;


    public function __construct(
        $nome,
        $cpf_cnpj,
        $telefone,
        $email,
        $cep,
        $endereco,
        $bairro,
        $numero,
        $cidade,
        $uf
    ) {
        $this->nome = $nome;
        $this->cpf_cnpj = $cpf_cnpj;
        $this->telefone = $telefone;
        $this->email = $email;
        $this->cep = $cep;
        $this->endereco = $endereco;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->cidade = $cidade;
        $this->uf = $uf;

        if (!$this->cepValido($cep)) throw new Exception('CEP no formato invalido');
    }

    public function cepValido($cep)
    {
        if (!strlen($cep) == 10) {
            return false;
        }

        //81.510-320
        $regexCep = "/^[0-9]{2}\.[0-9]{3}\-[0-9]{3}$/";
        return preg_match($regexCep, $cep);
    }
}
