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
    $this->paginador = $this->getUser()->getPaginador('Usuario', $q, $request->getParameter('pagina', 1), 5);
    
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
            'action' => 'guardar',
            'form' => new UsuarioForm(),
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
        $q->orWhere('name =?', $busca['search']['text'])
            ->orWhere('code =?', $busca['search']['text']);
    $paginador = $this->getUser()->getPaginador('Usuario', $q, $request->getParameter('pagina', 1), 5);
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
    }
  }
}
