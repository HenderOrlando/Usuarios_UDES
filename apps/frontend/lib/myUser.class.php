<?php

class myUser extends sfBasicSecurityUser
{
    /*Paginar*/
  public function getPaginador($tableName, $query, $pagina = 1, $maxPerPage = 14){
      $paginador = new sfDoctrinePager($tableName, $maxPerPage);
      $paginador->setQuery($query);
      $paginador->setPage($pagina);
      $paginador->init();
      
      return $paginador;
  }
}
