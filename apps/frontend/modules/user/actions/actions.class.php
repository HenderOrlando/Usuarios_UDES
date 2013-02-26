<?php

/**
 * user actions.
 *
 * @package    sf_sandbox
 * @subpackage user
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends sfActions
{
  public function executeTemplate(sfWebRequest $request)
  {
    $this->form = new UsuarioForm();
    $this->form_search = new UsuarioFormFilter();
    $q = Doctrine_Core::getTable('Usuario')
      ->createQuery('a');
    $this->paginador = $this->getUser()->getPaginador('Usuario', $q, $request->getParameter('pagina', $request->getAttribute('pagina',1)), 5);
    $this->getUser()->setAttribute('pagina', $request->getParameter('pagina', $request->getAttribute('pagina',1)));
    if($request->isXmlHttpRequest())
        return $this->renderPartial ('list', array('paginador' => $this->paginador));
  }
  public function executeIndex(sfWebRequest $request)
  {
    $this->users = Doctrine_Core::getTable('Usuario')
      ->createQuery('a')
      ->execute();
  }
  
  public function executeSave(sfWebRequest $request)
  {
    $this->forward404Unless($request->isXmlHttpRequest());

    $this->form = new UsuarioForm();
    $datos = array(
        'form' => new UsuarioForm(),
        'action' => 'guardar',
        'grid' => 'grid_20',
        'submit' => 'Save',
        'mensaje' => 'problemas Guardando el usuario'
    );
    if($this->processForm($request, $this->form)){
        $datos['mensaje'] = 'Usuario Guardado';
    }
    return $this->renderPartial('formUser', $datos);
  }
  
  public function executeSearch(sfWebRequest $request){
    $this->forward404Unless($request->isXmlHttpRequest());

    $form = new UsuarioFormFilter();
    $busca = $request->getParameter($form->getName());
    $q = UsuarioTable::getInstance()->createQuery();
    if($busca['search']['text'] != '')
        $q->orWhere('name LIKE ?', '%'.$busca['search']['text'].'%')
            ->orWhere('code LIKE?', '%'.$busca['search']['text'].'%');
    $paginador = $this->getUser()->getPaginador('Usuario', $q, $request->getParameter('pagina', 1), 5);
    $this->getUser()->setAttribute('pagina', $request->getParameter('pagina', 1));
    return $this->renderPartial('list', array('paginador' => $paginador));
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new UsuarioForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new UsuarioForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($user = Doctrine_Core::getTable('Usuario')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $this->form = new UsuarioForm($user);
    $this->ref = $request->getReferer().'?pagina='.$this->getUser()->getAttribute('pagina', 1);
    if($request->isMethod('put') && $this->processForm($request, $this->form)){
        return $this->redirect($this->ref);
    }
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($user = Doctrine_Core::getTable('Usuario')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $this->form = new UsuarioForm($user);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($user = Doctrine_Core::getTable('Usuario')->find(array($request->getParameter('id'))), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $user->delete();

    $this->redirect('user/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $user = $form->save();
      
      if(!$request->isXmlHttpRequest())
        $this->redirect('user/edit?id='.$user->getId());
      else
          return true;
    }
    return false;
  }
}
