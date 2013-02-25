<?php
  if($paginador->getNbResults() <= 0):
    echo 'Usuario no Encontrado.';
  else:
?>
<table class="grid_20">
  <thead>
    <tr class="grid_20">
      <th class="grid_4 alpha">Code</th>
      <th class="grid_5">Name</th>
      <th class="grid_5">Email</th>
      <th class="grid_4">Date</th>
      <th class="grid_1 omega">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($paginador->getResults() as $user): ?>
    <tr class="grid_20">
      <td class="grid_4 alpha"><a href="<?php echo url_for('user/edit?id='.$user->getId()) ?>"><?php echo $user->getCode() ?></a></td>
      <td class="grid_5"><?php echo $user->getName() ?></td>
      <td class="grid_5"><?php echo $user->getEmail() ?></td>
      <td class="grid_4"><?php echo $user->getDate() ?></td>
      <td class="grid_1 omega">D</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
      <tr>
          <td class="grid_20">
            <div class="paginador">
                <?php
                if ($paginador->haveToPaginate()):
                  $url = array(
                          'module'    => $this->getModuleName(),
                          'action'    => $this->getActionName(),
                          'pagina'    => 1,
                        );
                ?>
                  <a href="<?php
                        $url['pagina'] = $paginador->getFirstPage();
                        echo url_for($url)?>">
                        Primera Página
                  </a>
                  <a href="<?php
                        $url['pagina'] = $paginador->getPreviousPage();
                        echo url_for($url)?>">
                        Anterior Página
                  </a>
                  <?php $links = $paginador->getLinks();
                  foreach ($links as $pagina){
                      $url['pagina'] = $pagina;
                      echo ($pagina == $paginador->getPage()) ? $pagina : link_to($pagina, $url, array('class' => 'pagnum')) ?>
                  <?php
                  if ($pagina != $paginador->getCurrentMaxLink())
                        echo " | ";
                  ?>
                  <?php } ?>
                  <a href="<?php
                        $url['pagina'] = $paginador->getNextPage();
                        echo url_for($url)?>">
                        Siguiente Página
                  </a>
                  <a href="<?php
                        $url['pagina'] = $paginador->getLastPage();
                        echo url_for($url)?>">
                        Última página
                  </a>
                  <?php endif ?>
              </div>
          </td>
      </tr>
  </tfoot>
</table>
<?php endif; ?>