<?php
// auto-generated by sfViewConfigHandler
// date: 2013/02/26 08:38:48
$response = $this->context->getResponse();


  $templateName = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_template', $this->actionName);
  $this->setTemplate($templateName.$this->viewName.$this->getExtension());



  if (null !== $layout = sfConfig::get('symfony.view.'.$this->moduleName.'_'.$this->actionName.'_layout'))
  {
    $this->setDecoratorTemplate(false === $layout ? false : $layout.$this->getExtension());
  }
  else if (null === $this->getDecoratorTemplate() && !$this->context->getRequest()->isXmlHttpRequest())
  {
    $this->setDecoratorTemplate('' == 'layout' ? false : 'layout'.$this->getExtension());
  }
  $response->addHttpMeta('content-type', 'text/html', false);
  $response->addMeta('title', 'Test Práctico UDES - Cúcuta', false, false);
  $response->addMeta('description', 'Test práctico para ingresar como desarrollador web en la UDES - Cúcuta', false, false);
  $response->addMeta('language', 'es', false, false);

  $response->addStylesheet('jquery-ui.css', '', array ());
  $response->addStylesheet('fluid_grid.css', '', array ());
  $response->addStylesheet('main.css', '', array ());
  $response->addJavascript('jquery.js', '', array ());
  $response->addJavascript('jquery-ui.js', '', array ());
  $response->addJavascript('jquery.selectAutocomplete.js', '', array ());
  $response->addJavascript('main.js', '', array ());


