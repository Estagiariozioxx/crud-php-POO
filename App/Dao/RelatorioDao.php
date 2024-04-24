<?php

class RelatorioDao {
    
    public function read($id_empresa,$id_setor) {
        try {
            if($id_empresa=='' && $id_setor==''){
                $sql = "SELECT E.RAZAOSOCIAL,S.descricao FROM EMPRESA_SETOR N 
                INNER JOIN EMPRESA E ON E.ID=N.EMPRESA_ID
                INNER JOIN SETOR S ON S.ID=N.SETOR_ID
                where E.ATIVO=1 AND S.ATIVO=1;";

            }
            else{
                if($id_empresa != '' && $id_setor != ''){
                    $sql = "SELECT E.RAZAOSOCIAL,S.descricao FROM EMPRESA_SETOR N 
                INNER JOIN EMPRESA E ON E.ID=N.EMPRESA_ID
                INNER JOIN SETOR S ON S.ID=N.SETOR_ID
                where E.ATIVO=1 AND S.ATIVO=1 AND E.ID=".$id_empresa." AND S.ID=".$id_setor;

                }
                else if($id_empresa == ''){
                    $sql = "SELECT E.RAZAOSOCIAL,S.descricao FROM EMPRESA_SETOR N 
                INNER JOIN EMPRESA E ON E.ID=N.EMPRESA_ID
                INNER JOIN SETOR S ON S.ID=N.SETOR_ID
                where E.ATIVO=1 AND S.ATIVO=1 AND S.ID=".$id_setor;

                }
                else{
                    $sql = "SELECT E.RAZAOSOCIAL,S.descricao FROM EMPRESA_SETOR N 
                    INNER JOIN EMPRESA E ON E.ID=N.EMPRESA_ID
                    INNER JOIN SETOR S ON S.ID=N.SETOR_ID
                    where E.ATIVO=1 AND S.ATIVO=1 AND E.ID=".$id_empresa;

                }
            }
            
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            return $lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }

}


?>