<?php

Class Gabinete{
    
    private $pdo; 
     
    
    public function __construct(){
      try{
        $host='localhost';  
        $porta= '3308';  
        $dbname='gabinete';  
        $user='root';  
        $senha=''; 
        $this->pdo = new PDO('mysql:host='.$host.';port='.$porta.';dbname='.$dbname,$user,$senha);
        
        } catch (PDOException $e){
        echo " erro de banco de dados: ".$e->getMessage();
        exit();
        }
        catch(Exception $e){
          echo " erro genérico  : ".$e->getMessage();
          exit();
        }
      }
 
    //CADASTROS
      public function cadastrar_Obra($duracao,$nome,$orcamento,$estado,$fiscal,$construtor,$fotos=array()){
        $cmd=$this->pdo->prepare("SELECT id FROM obra WHERE nome= :n"); 
        $cmd->bindValue(":n",$nome);
        $cmd->execute();
        
        if($cmd->rowCount()>0){
          return false;
        }
 
        else
          $cmd=$this->pdo->prepare("INSERT INTO obra(duracao,nome,orcamento,estado,fk_fiscalizacao_id,fk_costrucao_id) VALUES (:d,:n,:o,:e,:f,:c)" );
          $cmd->bindValue(":n",$nome);
          $cmd->bindValue(":d",$duracao);
          $cmd->bindValue(":o",$orcamento);
          $cmd->bindValue(":e",$estado);
          $cmd->bindValue(":f",$fiscal);
          $cmd->bindValue(":c",$construtor);
          $cmd->execute();
          $id_obra=$this->pdo->LastInsertId();

          //INSERIR AS IMAGENS

        if (count($fotos)>0) {
        for ($i=0; $i <count($fotos) ; $i++) { 
          $nome_foto=$fotos[$i];
          $cmd=$this->pdo->prepare("INSERT INTO imagens(nome,fk_obra_id) VALUES (:n,:f)" );
          $cmd->bindValue(":n",$nome_foto);
          $cmd->bindValue(":f",$id_obra);
          $cmd->execute();
        
          }
        }
        return true;  
      }    

      public function cadastrar_Usuario($nome,$senha,$email){
        $cmd=$this->pdo->prepare("SELECT id FROM usuario WHERE email= :e"); 
        $cmd->bindValue(":e",$email);
        $cmd->execute();
        if($cmd->rowCount()>0){
          return false;
        }
        else $cmd=$this->pdo->prepare("INSERT INTO usuario(nome,senha,email) VALUES (:n,:s,:e)" );
        $cmd->bindValue(":e",$email);
        $cmd->bindValue(":n",$nome);
        $cmd->bindValue(":s",md5($senha));
        $cmd->execute();
          return true;
        }
      
      public function cadastrar_empresa($categoria,$numero,$ano,$nome){
          $cmd=$this->pdo->prepare("SELECT id FROM empresas WHERE numero_de_cadastro=:n"); 
          $cmd->bindValue(":e",$nome);
          $cmd->execute();

          if($cmd->rowCount()>0){
            return false;
          }

          else 
            $cmd=$this->pdo->prepare("INSERT INTO empresas(categoria,numero_cadastro,ano,nome) VALUES (:c,:nc,:a,:n)" );
            $cmd->bindValue(":n",$nome);  
            $cmd->bindValue(":nc",$numero);
            $cmd->bindValue(":a",$ano);
            $cmd->bindValue(":c",$categoria);
            $cmd->execute();
            return true;
        }
        
      public function cadastrar_relatorio($nome,$ponto_situacao,$irregularidades,$recomendacoes,$exec_financeira,$exec_fisica,$id_obra,$fotos=array()){
          $cmd=$this->pdo->prepare("INSERT INTO relatorio(nome,ponto_situacao,irregularidades,recomendacoes,exec_financeira,exec_fisica,fk_obra_id) VALUES (:n,:ps,:ir,:re,:fn,:fs,:o)" );
          $cmd->bindValue(":n",$nome);
          $cmd->bindValue(":ps",$ponto_situacao);
          $cmd->bindValue(":ir",$irregularidades);
          $cmd->bindValue(":re",$recomendacoes);
          $cmd->bindValue(":fn",$exec_financeira);
          $cmd->bindValue(":fs",$exec_fisica);
          $cmd->bindValue(":o",$id_obra);
          $cmd->execute();
         $id_r=$this->pdo->LastInsertId();
          
          if (count($fotos)>0) {
            for ($i=0; $i <count($fotos) ; $i++) { 
              $nome_foto=$fotos[$i];
              $cmd=$this->pdo->prepare("INSERT INTO imagens(nome,fk_relatorio_id) VALUES (:n,:f)" );
              $cmd->bindValue(":n",$nome_foto);
              $cmd->bindValue(":f",$id_r);
              $cmd->execute();
               }
             }
           
        }
		
      public function cadastrar_foto_usuario($id,$fotos=array()){          
          if (count($fotos)>0) {
            for ($i=0; $i <count($fotos) ; $i++) { 
              $nome_foto=$fotos[$i];
              $cmd=$this->pdo->prepare("INSERT INTO imagens(nome,fk_usuario_id) VALUES (:n,:f)" );
              $cmd->bindValue(":n",$nome_foto);
              $cmd->bindValue(":f",$id);
              $cmd->execute();
               }
             }
           
        } 
		
      public function cadastrar_foto_obra($id,$fotos=array()){          
          if (count($fotos)>0) {
            for ($i=0; $i <count($fotos) ; $i++) { 
              $nome_foto=$fotos[$i];
              $cmd=$this->pdo->prepare("INSERT INTO imagens(nome,fk_obra_id) VALUES (:n,:f)" );
              $cmd->bindValue(":n",$nome_foto);
              $cmd->bindValue(":f",$id);
              $cmd->execute();
               }
             }
           
        }
		
    //........BUSCAR TUDO

        public function buscar_obras(){
          $cmd=$this->pdo->query('SELECT *FROM obra ORDER BY nome');
          if ( $cmd->rowCount()>0) {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
          }
          else {
            $dados=array();
          }
          return $dados;
        }
        
        public function buscar_empresas(){
          $cmd=$this->pdo->query('SELECT * FROM empresas ORDER BY nome');
          if ( $cmd->rowCount()>0) {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
          }
          else {
            $dados=array();
          }
          return $dados;
        }
        
        public function buscar_relatorios(){
          $cmd=$this->pdo->query('SELECT *FROM relatorio');

          if ( $cmd->rowCount()>0) {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
          }
          else {
            $dados=array();
          }
          return $dados;
        }
        
        public function buscar_usuarios(){
          $cmd=$this->pdo->query('SELECT *FROM usuario');
          if ( $cmd->rowCount()>0) {
            $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
          }
          else {
            $dados=array();
          }
          return $dados;
        }
        
    //........BUSCAR APENAS UM

      public function buscar_Uma_obra($id){
        $cmd=$this->pdo->prepare("SELECT * FROM obra WHERE id=:id " );
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        
        if ( $cmd->rowCount()>0) {
          $dados=$cmd->fetch(PDO::FETCH_ASSOC);
        }
        else {
          $dados=array();
        }
        return $dados;
      }
      
      public function buscar_Uma_empresa($id){
        $cmd=$this->pdo->prepare("SELECT * FROM empresas WHERE id=:id " );
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        
        if ( $cmd->rowCount()>0) {
          $dados=$cmd->fetch(PDO::FETCH_ASSOC);
        }
        else {
          $dados=array();
        }
        return $dados;
      }
      
      public function buscar_Um_usuario($id){
        $cmd=$this->pdo->prepare("SELECT * FROM usuario WHERE id=:id " );
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        
        if ( $cmd->rowCount()>0) {
          $dados=$cmd->fetch(PDO::FETCH_ASSOC);
        }
        else {
          $dados=array();
        }
        return $dados;
      }
      
      public function buscar_Um_relatorio($id){
        $cmd=$this->pdo->prepare("SELECT * FROM relatorio WHERE id=:id " );
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        
        if ( $cmd->rowCount()>0) {
          $dados=$cmd->fetch(PDO::FETCH_ASSOC);
        }
        else {
          $dados=array();
        }
        return $dados;
      }


    
    //........BUSCAR IMAGENS

      public function buscar_Obra_imagens($id){
      
        $cmd=$this->pdo->prepare("SELECT nome FROM imagens WHERE fk_obra_id=:id " );
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        
        if ( $cmd->rowCount()>0) {
          $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
          $dados=array();
        }
        return $dados;

      }
      
      public function buscar_Relatorio_imagens($id){
      
        $cmd=$this->pdo->prepare("SELECT * FROM imagens WHERE fk_relatorio_id=:id " );
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        
        if ( $cmd->rowCount()>0) {
          $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
          $dados=array();
        }
        return $dados;

      }
      
      public function buscar_Usuario_imagens($id){
      
        $cmd=$this->pdo->prepare("SELECT nome FROM imagens WHERE fk_usuario_id=:id " );
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        
        if ( $cmd->rowCount()>0) {
          $dados=$cmd->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
          $dados=array();
        }
        return $dados;

      }
      
      public function buscar_imagem_perfil_usuario($id){
        $res=array();
        $cmd=$this->pdo->prepare("SELECT * FROM imagens WHERE fk_usuario_id= :id"); 
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        $res=$cmd->fetch(PDO::FETCH_ASSOC);
      return $res;
        
      }
      
      public function buscar_imagem_perfil_obra($id){
        $res=array();
        $cmd=$this->pdo->prepare("SELECT * FROM imagens WHERE fk_obra_id= :id"); 
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        $res=$cmd->fetch(PDO::FETCH_ASSOC);
      return $res;
        
      }
    
     //EXCLUIR

        public function eliminar_usuario($id){
          $cmd=$this->pdo->prepare("DELETE FROM usuario WHERE id=:id " );
          $cmd->bindValue(":id",$id);
          $cmd->execute();
        }

        public function eliminar_obra($id){
            $cmd=$this->pdo->prepare("DELETE FROM obra WHERE id=:id " );
            $cmd->bindValue(":id",$id);
            $cmd->execute();
        }
        
        public function eliminar_imagem($id){
          $cmd=$this->pdo->prepare("DELETE FROM imagens WHERE id=:id " );
          $cmd->bindValue(":id",$id);
          $cmd->execute();
        }

        public function eliminar_empresa($id){
          $cmd=$this->pdo->prepare("DELETE FROM empresas WHERE id=:id " );
          $cmd->bindValue(":id",$id);
          $cmd->execute();
        }
        
        public function eliminar_relatorio($id){
          $cmd=$this->pdo->prepare("DELETE FROM relatorio WHERE id=:id " );
          $cmd->bindValue(":id",$id);
          $cmd->execute();
        }
        public function eliminar_relatorios_obra($id){
          $cmd=$this->pdo->prepare("DELETE FROM relatorio WHERE fk_obra_id=:id " );
          $cmd->bindValue(":id",$id);
          $cmd->execute();
        }
        
        public function eliminar_imagens_Obra($id){
          $cmd=$this->pdo->prepare("DELETE FROM imagens WHERE fk_obra_id=:id " );
          $cmd->bindValue(":id",$id);
          $cmd->execute();
        }
        
        public function eliminar_imagens_Relatorio($id){
          $cmd=$this->pdo->prepare("DELETE FROM imagens WHERE fk_relatorio_id=:id " );
          $cmd->bindValue(":id",$id);
          $cmd->execute();
        }
        
        public function eliminar_imagens_Usuario($id){
          $cmd=$this->pdo->prepare("DELETE FROM imagens WHERE fk_usuario_id=:id " );
          $cmd->bindValue(":id",$id);
          $cmd->execute();
        }



        //EDITAR DADOS
        public function editar_usuario($id,$nome,$email){
          $cmd=$this->pdo->prepare("UPDATE usuario SET nome=:n,email=:e WHERE id= :id"); 
            $cmd->bindValue(":id",$id);
            $cmd->bindValue(":n",$nome);  
            $cmd->bindValue(":e",$email);
            $cmd->execute();
        }
        public function editar_senha($id,$senha){
          $cmd=$this->pdo->prepare("UPDATE usuario SET senha=:s, WHERE id= :id"); 
            $cmd->bindValue(":id",$id);
            $cmd->bindValue(":s",$senha);  
            $cmd->execute();
        }

        public function editar_relatorio($id,$nome,$ponto_situacao,$irregularidades,$recomendacoes,$exec_financeira,$exec_fisica){
          $cmd=$this->pdo->prepare("UPDATE relatorio SET nome=:n,ponto_situacao=:ps,irregularidades=:ir,recomendacoes=:re,exec_financeira=:fn,exec_fisica=:fs WHERE id= :id"); 
          $cmd->bindValue(":id",$id);
          $cmd->bindValue(":n",$nome);
          $cmd->bindValue(":ps",$ponto_situacao);
          $cmd->bindValue(":ir",$irregularidades);
          $cmd->bindValue(":re",$recomendacoes);
          $cmd->bindValue(":fn",$exec_financeira);
          $cmd->bindValue(":fs",$exec_fisica);
          $cmd->execute();
        }

        public function editar_empresa($id,$categoria,$numero_cadastro,$ano,$nome){
          $cmd=$this->pdo->prepare("UPDATE empresas SET categoria=:c,numero_cadastro=:nc,ano=:a,nome=:n WHERE id= :id"); 
          $cmd->bindValue(":id",$id);
          $cmd->bindValue(":n",$nome);  
          $cmd->bindValue(":nc",$numero_cadastro);
          $cmd->bindValue(":a",$ano);
          $cmd->bindValue(":c",$categoria);
          $cmd->execute();
        }
        
        public function editar_obra($id,$duracao,$nome,$orcamento,$estado,$fiscal,$construtor){
          $cmd=$this->pdo->prepare("UPDATE obra SET duracao=:d,nome=:n,orcamento=:o,estado=:e,fk_fiscalizacao_id=:f,fk_costrucao_id=:c WHERE id=:id"); 
          $cmd->bindValue(":id",$id);
          $cmd->bindValue(":n",$nome);
          $cmd->bindValue(":d",$duracao);
          $cmd->bindValue(":o",$orcamento);
          $cmd->bindValue(":e",$estado);
          $cmd->bindValue(":f",$fiscal);
          $cmd->bindValue(":c",$construtor);
          $cmd->execute();
        } 
        
         //LOGIN
        
         public function login($email,$senha){

          $cmd=$this->pdo->prepare("SELECT * FROM usuario WHERE email= :e AND senha=:s"); 
          $cmd->bindValue(":e",$email);
          $cmd->bindValue(":s",$senha);
          $cmd->execute();
          if($cmd->rowCount()>0){
              $res=$cmd->fetch(PDO::FETCH_ASSOC);
              
              session_start();
  
              //USUÁRIO ADMINISTRADOR             
  
              if ($res['id']==5) {
                  $_SESSION['id_admin']=5;
				          $_SESSION['nome']=$res['nome'];
				          $_SESSION['email']=$res['email'];
                  
              }
             else{  //USUÁRIO COMUM
  
                  $_SESSION['id_comum']=$res['id'];
				          $_SESSION['nome']=$res['nome'];
				          $_SESSION['email']=$res['email'];
             }
             return true;
            }
         
          else {
            return false;
          }
  
         }
 
      }

     