<?php
// $_SESSION['mensagem'] = array("tipo" => "success", "titulo" => "Falha", "mensagens" => array("Não foi possível excluir a conta", "Conta não encontrada"));
if (isset($_SESSION['mensagem'])):
    $msg = $_SESSION['mensagem'];
?>
<div class="alert alert-<?= $msg["tipo"]; ?> alert-dismissible" role="alert">
    <h4 class="alert-heading"><?= $msg["titulo"]; ?></h4>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">
            <svg>
                <path fill-rule="evenodd" d="M16 8A8 8 0 110 8a8 8 0 0116 0zm-4.146-3.146a.5.5 0 00-.708-.708L8 7.293 4.854 4.146a.5.5 0 10-.708.708L7.293 8l-3.147 3.146a.5.5 0 00.708.708L8 8.707l3.146 3.147a.5.5 0 00.708-.708L8.707 8l3.147-3.146z" clip-rule="evenodd"/>
            </svg>
        </span>
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
