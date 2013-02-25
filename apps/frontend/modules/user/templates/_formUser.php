<?php 
/*
 * Variables
 *      $action lista (buscar, guardar)
 *      $form   form
 *      $campos array
 */
?>
<?php if(isset($mensaje)): ?>
    <span class="error"><?php echo $mensaje ?></span>
<?php endif; ?>
<form class="grid_8 omega" action="<?php echo url_for('@'.strtolower($action).'Usuario') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
    <section class="grid_20">
        <?php 
        if(isset($campos) && is_array($campos)){
            echo $form->renderHiddenFields().'ok-';
            foreach($campos as $campo)
                if(isset($form[$campo]))
                    echo $form[$campo] ;
        }else{
            echo $form ;
        }
        ?>
    </section>
    <?php if(isset($submit) && is_string($submit)): ?>
    <footer>
        <input type="submit" value="<?php echo $submit != ''?$submit:'Send' ?>" />
    </footer>
    <?php endif; ?>
</form>