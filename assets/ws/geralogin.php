<?php

$nome = $_GET['nome'];

function geraLogin($nome, $ultimoExtenso = true)
{
  $nome_ = ucWords(strtolower($nome));
  $nomeExplodido = explode(' ', $nome_);
  $arrayComposicao = ['Da', 'Das', 'De', 'Di', 'Do', 'Dos', 'Du'];
  foreach ($arrayComposicao as $composicao) {
    $key = array_search($composicao, $nomeExplodido);
    if ($key) {
      unset($nomeExplodido[$key]);
    }
  }
  $ultimoNome = '';
  if ($ultimoExtenso) {
    $ultimoNome = end($nomeExplodido);
    array_pop($nomeExplodido);
  }
  $nome = implode(' ', $nomeExplodido);
  preg_match_all('/\s?([A-Z])/', $nome, $matches);
  $resultado = implode('', $matches[1]);
  return strtolower($resultado).strtolower($ultimoNome);
}
echo geralogin($nome);
?>
