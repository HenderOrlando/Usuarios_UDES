
<h1>Edit User <?php echo $form->getObject()->getName() ?></h1>
<?php include_partial('formUser', array(
    'form' => $form,
    'action' => 'editar',
    'grid' => 'grid_20',
    'submit' => 'Save',
    'datos' => 'id='.$form->getObject()->getId().'&nombre='.$form->getObject()->getName().'&pagina='.$sf_user->getAttribute('pagina'),
    'volver' => array(
        'url' => $ref,
        'texto' => 'Back'
    ),
)) ?>