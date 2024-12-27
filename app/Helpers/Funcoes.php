<?php

namespace App\Helpers;

class Funcoes
{


    public static function gerarNumeroMatricula($nomeAluno, $lastnumatricula)
    {
        // Obter o ano atual
        $anoAtual = date('Y');

        // Obter a inicial do nome do aluno (primeira letra maiúscula)
        $inicialNome = strtoupper($nomeAluno[0]);
        
        // Determinar o próximo número sequencial
        if ($lastnumatricula) {
            $ultimoSequencial = intval(substr($lastnumatricula, -3)); // Pega os últimos 3 dígitos
            $novoSequencial = $ultimoSequencial + 1;
        } else {
            $novoSequencial = 1;
        }

        // Garantir que o número sequencial tenha exatamente 3 dígitos (com padding de zeros à esquerda, se necessário)
        $numeroSequencialFormatado = str_pad($novoSequencial, 3, '0', STR_PAD_LEFT);

        // Concatenar tudo para formar o número da matrícula
        $numeroMatricula = "{$anoAtual}{$inicialNome}{$numeroSequencialFormatado}";

        return $numeroMatricula;
    }
}
