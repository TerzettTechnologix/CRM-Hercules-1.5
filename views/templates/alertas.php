<?php
    foreach($alertas as $key =>$mensajes):
        foreach($mensajes as $mensaje):
?>
    <div class="alert alert-danger text-white font-weight-bold text-center text-uppercase <?php echo $key;?>">
            <?php echo $mensaje; ?>
    </div>

<?php
     endforeach;
    endforeach;

?>