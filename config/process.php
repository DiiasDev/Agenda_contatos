<?php

    session_start();//para iniciar a seção 

    include_once("connection.php");
    include_once("url.php");

    $data = $_POST;

    //MODIFICAÇÃO NO BANCO
    if(!empty($data)){ // verifica se há algo

        //criar contato 
        if ($data['type'] === "create") {  // Verifica se o tipo de operação é 'create' (criação de um novo contato)
    
    $name = $data["name"];  // Atribui o valor do campo 'name' do formulário à variável $name
    $phone = $data["phone"];  // Atribui o valor do campo 'phone' do formulário à variável $phone
    $observations = $data["observations"];  // Atribui o valor do campo 'observations' do formulário à variável $observations

    // Define uma query SQL para inserir um novo contato na tabela 'contacts'
    $query = "INSERT INTO contacts (name, phone, observations) VALUES (:name, :phone, :observations)";

    // Prepara a query para execução
    $stmt = $conn->prepare($query);

    // Vincula o valor da variável $name ao parâmetro :name na query
    $stmt->bindParam(":name", $name);
    // Vincula o valor da variável $phone ao parâmetro :phone na query
    $stmt->bindParam(":phone", $phone);
    // Vincula o valor da variável $observations ao parâmetro :observations na query
    $stmt->bindParam(":observations", $observations);



           

            try{

                $stmt->execute();
                $_SESSION['msg'] = "Sucesso ao cadastrar contato.";
            
            }catch(PDOException $e){
                //erro de conexão 
                $error = $e->getMessage();
                echo "Erro: $error";
            }
            

        } else if($data['type'] === "edit"){

            $name = $data["name"];
            $phone = $data["phone"];
            $observations = $data["observations"];
            $id = $data['id'];

            $query = "UPDATE contacts SET name = :name, phone = :phone, observations = :observations WHERE id = :id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":name",$name);
            $stmt->bindParam(":phone",$phone);
            $stmt->bindParam(":observations",$observations);
            $stmt->bindParam(":id",$id);
            
            try{

                $stmt->execute();
                $_SESSION['msg'] = "Sucesso ao editar contato.";
            
            }catch(PDOException $e){
                //erro de conexão 
                $error = $e->getMessage();
                echo "Erro: $error";
            }
        }else if($data["type"] === "delete"){

            $id = $data["id"]; 

            $query = "DELETE FROM contacts WHERE id = :id";

            $stmt = $conn->prepare($query);

            $stmt->bindParam(":id",$id);

            try{

                $stmt->execute();
                $_SESSION['msg'] = "Sucesso ao remover contato.";
            
            }catch(PDOException $e){
                //erro de conexão 
                $error = $e->getMessage();
                echo "Erro: $error";
            }

        }

        //REDIRECT HOME 
        header("location:". $BASE_URL . "/../index.php");
        

        // Verifica se há mensagem de sessão e armazena em uma variável local


        //SELEÇÃO DE DADOS 
    } else{

        $id;
    
        $data = $_POST; 
        $contacts  =[];
        
    
        if(!empty($_GET)){
            $id = $_GET["id"];
        }
        
        //Retorna dados de um contato 
        if(!empty($id)){
            $query = "SELECT * FROM contacts WHERE id = :id";
    
            $stmt = $conn->prepare($query);
    
            $stmt->bindParam(":id",$id);
    
            $stmt->execute();
    
            $contact = $stmt->fetch();
        }else{
    
        //Retorna todos os contatos
       
            
        $query = "SELECT * FROM contacts "; //Criando a query 
    
        $stmt = $conn->prepare($query); // prepare a query 
    
        $stmt->execute(); //executando a query
    
        $contacts = $stmt->fetchAll(); //pegando todos os dados;
        }
    }

     
    // FEECHAR CONEXÃO

    $conn = null;
    
  