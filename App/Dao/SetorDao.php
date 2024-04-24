<?php
class SetorDao{
    
    public function create(Setor $setor, $id_empresa) {
        try {
            $sql = "INSERT INTO setor (descricao)
                  VALUES (:descricao)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":descricao", $setor->getDescricao());
            if($p_sql->execute()){
                $sql = "INSERT INTO empresa_setor (Empresa_id,setor_id)
                  VALUES (:empresa_id,:setor_id)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":empresa_id", $id_empresa);
            $p_sql->bindValue(":setor_id", Conexao::getConexao()->lastInsertId());
        

            if($p_sql->execute()) {
                return true; // Sucesso
            } else {
                $error = $p_sql->errorInfo();
                echo "Erro ao inserir na tabela empresa_setor: " . $error[2];
                exit;
                return false; // Falha
            }
            

            }
            return false;
            
        } catch (Exception $e) {
            print "Erro ao Inserir <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM setor where ativo=1";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaSetor($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
     
    public function update(Setor $setor) {
        try {

            $sql = "UPDATE setor set
                
                  descricao=:descricao                                                         
                  WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":descricao", $setor->getDescricao());
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function delete(Setor $setor) {
        try {
            $sql = "UPDATE setor set
                
            ativo=0                                                           
            WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id", $empresa->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir usuario<br> $e <br>";
        }
    }


    

    private function listaSetor($row) {
        $setor= new Setor();
        $setor->setId($row['id']);
        $setor->setDescricao($row['descricao']);

        return $setor;
    }
 }

 ?>
