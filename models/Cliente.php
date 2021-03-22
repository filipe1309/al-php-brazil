<?php

require_once 'ValidadorCPF.php';
require_once 'ValidadorCNPJ.php';
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
        $this->cpf_cnpj = $this->removeFormatacao($cpf_cnpj);
        $this->telefone = $this->removeFormatacao($telefone);
        $this->email = $email;
        $this->cep = $this->removeFormatacao($cep);
        $this->endereco = $endereco;
        $this->bairro = $bairro;
        $this->numero = $numero;
        $this->cidade = $cidade;
        $this->uf = $uf;

        $validadorCpf = new ValidadorCPF();
        $validadorCnpj = new ValidadorCNPJ();

        if (!$this->cepValido($cep)) throw new Exception('CEP no formato invalido');
        if (!$this->telefoneValido($telefone)) throw new Exception('Telefone no formato invalido');
        if (!$this->emailValido($email)) throw new Exception('Email no formato invalido');

        if (strlen($cpf_cnpj) > 14) {
            if (!$validadorCnpj->ehValido($cpf_cnpj)) throw new Exception('CNPJ no formato invalido');
        } else {
            if (!$validadorCpf->ehValido($cpf_cnpj)) throw new Exception('CPF no formato invalido');
        }
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

    public function telefoneValido($telefone)
    {
        if (!strlen($telefone) == 15) {
            return false;
        }

        //(99) 99999-9999
        $regexTelefone = "/^\([0-9]{2}\)[0-9]{5}\-[0-9]{4}$/";
        return preg_match($regexTelefone, str_replace(' ', '', $telefone));
    }

    public function emailValido($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function removeFormatacao($info)
    {
        return str_replace(['.', '-', '/', '(', ')', ' '], '', $info);
    }
}
