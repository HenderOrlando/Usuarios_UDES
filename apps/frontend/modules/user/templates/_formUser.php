<?php 
/*
 * Variables
 *      $action String(buscar, guardar)
 *      $form   Form
 *      $campos Array([campo1, campo2, ...])
 *      $grid   String
 *      $datos  String
 *      $volver  array(url[, texto])
 */
?>
<?php if(isset($mensaje)): ?>
    <span class="error ui-state-error ui-corner-all grid_20"><?php echo $mensaje ?></span>
<?php endif; ?>
    <form class="<?php echo isset($grid)?$grid:'grid_20' ?>" action="<?php echo url_for('@'.strtolower($action).'Usuario'.(isset($datos[0])?'?'.html_entity_decode($datos):'')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <?php if(is_a($form, 'UsuarioForm') && !$form->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <section class="grid_20">
        <?php 
        if(isset($campos[0])){
            echo $form->renderHiddenFields();
            foreach($campos as $campo)
                if(isset($form[$campo]))
                    echo $form[$campo] ;
        }else{
            echo $form ;
        }
        ?>
    </section>
    <?php if(isset($submit) && is_string($submit)): ?>
    <footer class="botonset">
        <input type="submit" value="<?php echo $submit != ''?$submit:'Send' ?>" />
        <?php if(isset($volver['url'])): ?>
            <a href="<?php echo $volver['url'] ?>" ><?php echo $volver['texto']!= ''?$volver['texto']:'Back' ?> </a>
        <?php endif; ?>
    </footer>
    <?php endif; ?>
</form>