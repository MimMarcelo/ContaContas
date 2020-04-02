<?php
//$_SESSION['mensagem'] = array("tipo" => "success", "titulo" => "Falha", "mensagens" => array("Não foi possível excluir a conta", "Conta não encontrada"));
if (isset($_SESSION['mensagem'])):
    $msg = $_SESSION['mensagem'];
?>
<div class="alert alert-<?= $msg["tipo"]; ?> alert-dismissible" role="alert">
    <h4 class="alert-heading"><?= $msg["titulo"]; ?></h4>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true" class="material-icons">cancel</span>
    </button>
    <ul>
        <?php
        foreach ($msg["mensagens"] as $m) {
            echo "<li>$m</li>";
        }
         ?>
    </ul>
</div>
<?php
unset($_SESSION['mensagem']);
endif;
?>
