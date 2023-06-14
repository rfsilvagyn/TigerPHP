<?php
class Remessas extends Model {
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //OBTER TODAS AS CONTAS
  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  public function adicionar($arquivo, $total_registros, $titulos, $tb_empresas_id){

    //INSERE O REGISTRO DA REMESSA NA TABELA
    $sql = "INSERT INTO tb_remessas SET data_remessa = NOW(), total_registros = :total_registros, tb_empresas_id = :tb_empresas_id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':total_registros', $total_registros);
    $sql->bindValue(':tb_empresas_id', $tb_empresas_id);
    $sql->execute();

    //RETORNA ID INSERIDO
    $id_remessa = $this->db->lastInsertId();

    //MONTA O NOME DO ARQUIVO
    $arquivo = "CB" . date("d") . date("m") . $id_remessa . ".REM";

    //EDITA O CAMPO NOME DO ARQUIVO DO REGISTRO INSERIDO ACIMA
    $sql = "UPDATE tb_remessas SET arquivo = :arquivo WHERE id = :id";
    $sql = $this->db->prepare($sql);
    $sql->bindValue(':arquivo', $arquivo);
    $sql->bindValue(':id', $id_remessa);
    $sql->execute();

    //EDITAR OS CAMPOS REMESSA E DATA DA REMESSA NOS TITULOS DA TABELA CONTAS A RECEBER
    foreach ($titulos as $titulo) {
      $sql = "UPDATE tb_contasreceber SET remessa = :remessa, data_remessa = NOW() WHERE id = :id";
      $sql = $this->db->prepare($sql);
      $sql->bindValue(':remessa', $id_remessa);
      $sql->bindValue(':id', $titulo);
      $sql->execute();
    }

    return $id_remessa;

  }






}
?>
