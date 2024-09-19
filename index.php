  <?php
  include_once("tmpl/header.php"); // Cabeçalho
  ?>
    <div class="container">
      <?php if(isset($printMsg) && $printMsg != ''): ?>
        <p id="msg"><?= $printMsg ?></p>
        <?php endif; ?>
        <h1 id="main-title">Minha agenda</h1>
        <?php if(count($contacts) > 0): ?> <!-- Verifica se há contatos -->
          <table class="table" id="contacts-table">
            <thead>
              <tr>
                <th scope="col">#</th> <!-- Separando os itens da tabela por colunas  -->
                <th scope="col">Nome</th> <!-- Separando os itens da tabela por colunas  -->
                <th scope="col">Telefone</th> <!-- Separando os itens da tabela por colunas  -->
                <th scope="col"></th> <!-- Separando os itens da tabela por colunas  -->
              </tr>
            </thead>
            <tbody>
              <?php foreach($contacts as $contact): ?> <!-- Roda a array para pegar dados de todos os contatos  -->
                <tr>
                  <td scope="row" class="col-id"><?=$contact["id"]?></td> <!-- preecnhe as colunas da tabela com dados do banco de dados -->
                  <td scope="row"><?=$contact["name"]?></td> <!-- preecnhe as colunas da tabela com dados do banco de dados -->
                  <td scope="row"><?=$contact["phone"]?></td> <!-- preecnhe as colunas da tabela com dados do banco de dados -->
                  <td class="actions">
                    <a href="<?= $BASE_URL ?>/show.php?id=<?= $contact['id']?>"><i class="fas fa-eye check-icon"></i></a>
                    <a href="<?= $BASE_URL ?>/edit.php?id=<?= $contact['id']?>" ><i class="far fa-edit edit-icon"></i></a>
                   <form class="delete-form" action="<?= $BASE_URL ?>/config/process.php" method="POST">
                    <input type="hidden" name="type" value="delete">
                    <input type="hidden" name="id" value="<?=$contact['id']?>">
                   <button type="submit" class="delete-btn"><i class="fa-regular fa-trash-can" style="color: #858585;"></i></i></button>
                   </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?php else:  ?>
            <p id="empty-list-text">Ainda não há contatos na sua agenda, <a href="<?= $BASE_URL ?>/create.php">
          Clique aqui para adicionar</a>.</p>
          <?php endif; ?>
    </div>
<?php
include_once("tmpl/footer.php"); // rodapé
?>
