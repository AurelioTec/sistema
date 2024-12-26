<?php

namespace App\Helpers;

class Funcoes
{


    public static function gerarNumeroMatricula($nomeAluno)
    {
        // Define uma variável estática para manter o valor entre chamadas
        static $contador = 1;

        // Se o contador atingir 999, reinicia
        if ($contador >= 999) {
            $contador = 1;
        }

        // Obter o ano atual
        $anoAtual = date('Y');

        // Obter a inicial do nome do aluno (primeira letra maiúscula)
        $inicialNome = strtoupper($nomeAluno[0]);

        // Garantir que o número sequencial tenha exatamente 3 dígitos (com padding de zeros à esquerda, se necessário)
        $numeroSequencialFormatado = str_pad($contador, 3, '0', STR_PAD_LEFT);

        // Incrementa o contador após formatar o número sequencial
        $contador++;

        // Concatenar tudo para formar o número da matrícula
        $numeroMatricula = $anoAtual . $inicialNome . $numeroSequencialFormatado;

        return $numeroMatricula;
    }
}
