<?php

class ValidadorCNPJ
{
    public function ehValido($cnpj)
    {
        if (!self::estaNoformatoDecnpj($cnpj)) return false;

        $cnpjNumero = self::removeFormatacao($cnpj);

        if (!self::verificarNumerosIguais($cnpjNumero)) return false;

        if (!self::validarDigitos($cnpjNumero)) return false;

        return true;
    }

    private static function estaNoformatoDecnpj($cnpj)
    {
        //12.345.678/0001-95
        $regexCnpj = "/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}\/[0-9]{4}\-[0-9]{2}$/";
        return preg_match($regexCnpj, $cnpj);
    }

    private static function removeFormatacao($cnpj)
    {
        return str_replace(['.', '-', '/'], '', $cnpj);
    }

    private static function verificarNumerosIguais($cnpj)
    {
        for ($i = 0; $i <= 14; $i++) {
            if (str_repeat($i, 11) == $cnpj) return false;
        }

        return true;
    }

    private static function validarDigitos($cnpj)
    {
        //12.345.678/0001-95
        $primeiroDigito = 0;
        $segundoDigito = 0;

        for ($i = 0, $peso = 5; $i <= 11; $i++, $peso--) {
            $peso = ($peso < 2) ? 9 : $peso;
            $primeiroDigito += $cnpj[$i] * $peso;
        }

        $calculoD1 = (($primeiroDigito % 11) < 2) ? 0 : (11 - ($primeiroDigito % 11));

        for ($i = 0, $peso = 6; $i <= 12; $i++, $peso--) {
            $peso = ($peso < 2) ? 9 : $peso;
            $segundoDigito += $cnpj[$i] * $peso;
        }

        $calculoD2 = (($segundoDigito % 11) < 2) ? 0 : (11 - ($segundoDigito % 11));

        if (($calculoD1 <> $cnpj[12]) || ($calculoD2 <> $cnpj[13])) return false;

        return true;
    }
}
