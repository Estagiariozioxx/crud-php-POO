<?php
class EmpresaDao{
    
    public function create(Empresa $empresa) {
        try {
            $sql = "INSERT INTO Empresa (                   
                  razaosocial,nome_fantasia,cnpj)
                  VALUES (
                  :razaosocial,:nome_fantasia,:cnpj)";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":razaosocial", $empresa->getRazaoSocial());
            $p_sql->bindValue(":nome_fantasia", $empresa->getNomeFantasia());
            $p_sql->bindValue(":cnpj", $empresa->getCnpj());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Erro ao Inserir usuario <br>" . $e . '<br>';
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM Empresa where ativo=1";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listaEmpresas($l);
            }
            return $f_lista;
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
     
    public function update(Empresa $empresa) {
        try {

            $sql = "UPDATE Empresa set
                
                  razaosocial=:razaosocial,
                  nome_fantasia=:nome_fantasia,
                  cnpj=:cnpj                                                             
                  WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":razaosocial", $empresa->getRazaoSocial());
            $p_sql->bindValue(":nome_fantasia", $empresa->getNomeFantasia());
            $p_sql->bindValue(":cnpj", $empresa->getCnpj());
            $p_sql->bindValue(":id", $empresa->getId());
            
            return $p_sql->execute();
        } catch (Exception $e) {
            print "Ocorreu um erro ao tentar fazer Update<br> $e <br>";
        }
    }

    public function delete(Empresa $empresa) {
        try {
            $sql = "UPDATE Empresa set
                
            ativo=0                                                           
            WHERE id = :id";
            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":id", $empresa->getId());
            return $p_sql->execute();
        } catch (Exception $e) {
            echo "Erro ao Excluir usuario<br> $e <br>";
        }
    }


    

    private function listaEmpresas($row) {
        $empresa = new Empresa();
        $empresa->setId($row['id']);
        $empresa->setRazaoSocial($row['razaosocial']);
        $empresa->setNomeFantasia($row['nome_fantasia']);
        $empresa->setCnpj($row['cnpj']);

        return $empresa;
    }
 }

 ?>
