<?php
  if($paginador->getNbResults() <= 0):
    echo 'Usuario no Encontrado.';
  else:
?>
<table >
  <thead>
    <tr class="">
      <th class="ui-widget-header ui-widget ui-corner-all">Code</th>
      <th class="ui-widget-header ui-widget ui-corner-all">Name</th>
      <th class="ui-widget-header ui-widget ui-corner-all">Email</th>
      <th class="ui-widget-header ui-widget ui-corner-all">Date</th>
      <th class="ui-widget-header ui-widget ui-corner-all">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($paginador->getResults() as $user): ?>
    <tr class="">
      <td class="ui-widget-content ui-widget ui-corner-all"><a href="<?php echo url_for('user/edit?id='.$user->getId().'&pagina='.$paginador->getPage()) ?>"><?php echo $user->getCode() ?></a></td>
      <td class="ui-widget-content ui-widget ui-corner-all"><?php echo $user->getName() ?></td>
      <td class="ui-widget-content ui-widget ui-corner-all"><?php echo $user->getEmail() ?></td>
      <td class="ui-widget-content ui-widget ui-corner-all"><?php echo $user->getDate() ?></td>
      <td class="ui-widget-content ui-widget ui-corner-all">
          <div class="botonset">
            <a href="<?php echo url_for('@borrarUsuario?id='.$user->getId().'&nombre='.$user->getName().'&pagina='.$paginador->getPage()) ?>">
                <span class="ui-icon ui-icon-circle-close">Borrar</span>
            </a>
            <a href="<?php echo url_for('@editarUsuario?id='.$user->getId().'&nombre='.$user->getName().'&pagina='.$paginador->getPage()) ?>">
                <span class="ui-icon ui-icon-pencil">Editar</span>
            </a>
          </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
      <tr>
          <td class="" colspan="5">
            <div class="paginador botonset">
                <?php
                if ($paginador->haveToPaginate()):
                  $url = array(
                          'module'    => $this->getModuleName(),
                          'action'    => 'template',
                          'pagina'    => 1,
                        );
                ?>
                  <a class="<?php echo ($paginador->getFirstPage() == $paginador->getPage()?'botonDisabled':'') ?>" href="<?php
                        $url['pagina'] = $paginador->getFirstPage();
                        echo url_for($url)?>">
                        <span class="ui-icon ui-icon-seek-first">Primera Página</span>
                  </a>
                  <a class="<?php echo ($paginador->getFirstPage() == $paginador->getPage()?'botonDisabled':'') ?>" href="<?php
                        $url['pagina'] = $paginador->getPreviousPage();
                        echo url_for($url)?>">
                        <span class="ui-icon ui-icon-seek-prev">Anterior Página</span>
                  </a>
                  <?php $links = $paginador->getLinks();
                  foreach ($links as $pagina){
                      $url['pagina'] = $pagina;
                      echo ($pagina == $paginador->getPage()) ? '<a href="#" class="botonDisabled" disabled="disabled" >'.$pagina.'</a>' : link_to($pagina, $url, array('class' => 'pagnum')) ?>
                  <?php
                  ?>
                  <?php } ?>
                  <a class="<?php echo ($paginador->getLastPage() == $paginador->getPage()?'botonDisabled':'') ?>" href="<?php
                        $url['pagina'] = $paginador->getNextPage();
                        echo url_for($url)?>">
                        <span class="ui-icon ui-icon-seek-next">Siguiente Página</span>
                  </a>
                  <a class="<?php echo ($paginador->getLastPage() == $paginador->getPage()?'botonDisabled':'') ?>" href="<?php
                        $url['pagina'] = $paginador->getLastPage();
                        echo url_for($url)?>">
                        <span class="ui-icon ui-icon-seek-end">Última página</span>
                  </a>
                  <?php endif ?>
              </div>
          </td>
      </tr>
  </tfoot>
</table>
<?php endif; ?>