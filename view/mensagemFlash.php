<?php
if (isset($_SESSION['mensagem'])):
    $msg = $_SESSION['mensagem'];
?>
    <div class="alerta">
        <div class="<?= $msg["tipo"]; ?>">
            <header>
                <h4><?= $msg["titulo"]; ?></h4><button class="fechar">X</button>
            </header>
            <ul>
                <?php
                foreach ($msg["mensagens"] as $m) {
                    echo "<li>$m</li>";
                }
                 ?>
            </ul>
        </div>
    </div>
<?php
unset($_SESSION['mensagem']);
endif; ?>
