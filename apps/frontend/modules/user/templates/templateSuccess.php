<section id="search" class="grid_20">
    <span class="grid_12 alpha">Users</span>
    <?php include_partial('formUser', array(
        'form' => $form_search,
        'action' => 'buscar',
        'grid' => 'grid_8 omega',
        'campos' => array('search'),
        'submit' => false,
    )) ?>
</section>
<section id="register_user" class="grid_6 alpha">
    <?php include_partial('formUser', array(
        'form' => $form,
        'action' => 'buscar',
        'grid' => 'grid_20',
        'submit' => 'Save',
    )) ?>
</section>
<section id="list_user" class="grid_14 omega">
    <section id="list" class="grid_20">
        <?php include_partial('list', array('paginador' => $paginador)) ?>
    </section>
</section>
<section id="edit_user" class="modal">
    
</section>