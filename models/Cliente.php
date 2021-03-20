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
    }
}
