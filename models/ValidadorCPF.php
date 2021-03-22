<?php

class ValidadorCPF
{

    public function ehValido($cpf)
    {
        if (!self::estaNoformatoDeCpf($cpf)) return false;

        $cpfNumero = self::removeFormatacao($cpf);

        if (!self::verificarNumerosIguais($cpfNumero)) return false;

        if (!self::validarDigitos($cpfNumero)) return false;

        return true;
    }

    private static function estaNoformatoDeCpf($cpf)
    {
        //123.456.789-09
        $regexCpf = "/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2}$/";
        return preg_match($regexCpf, $cpf);
    }

    private static function removeFormatacao($cpf)
    {
        return str_replace(['.', '-'], '', $cpf);
    }

    private static function verificarNumerosIguais($cpf)
    {
        for ($i = 0; $i <= 11; $i++) {
            if (str_repeat($i, 11) == $cpf) return false;
        }

        return true;
    }

    private static function validarDigitos($cpf)
    {
        //123.456.789-09
        $primeiroDigito = 0;
        $segundoDigito = 0;

        for ($i = 0, $peso = 10; $i <= 8; $i++, $peso--) {
            $primeiroDigito += $cpf[$i] * $peso;
        }

        for ($i = 0, $peso = 11; $i <= 9; $i++, $peso--) {
            $segundoDigito += $cpf[$i] * $peso;
        }

        $calculoD1 = (($primeiroDigito % 11) < 2) ? 0 : (11 - ($primeiroDigito % 11));
        $calculoD2 = (($segundoDigito % 11) < 2) ? 0 : (11 - ($segundoDigito % 11));

        if (($calculoD1 <> $cpf[9]) || ($calculoD2 <> $cpf[10])) return false;

        return true;
    }
}
