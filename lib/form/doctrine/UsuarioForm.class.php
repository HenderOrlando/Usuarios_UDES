<?php

/**
 * Usuario form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsuarioForm extends BaseUsuarioForm
{
  public function configure()
  {
      $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(array(), array('class' => 'ui-state-default ui-corner-all grid_20', 'placeholder' => 'Id')),
      'code'     => new sfWidgetFormInputText(array(), array('class' => 'ui-state-default ui-corner-all grid_20', 'placeholder' => 'Code')),
      'name'     => new sfWidgetFormInputText(array(), array('class' => 'ui-state-default ui-corner-all grid_20', 'placeholder' => 'Name')),
      'email'    => new sfWidgetFormInputText(array(), array('class' => 'ui-state-default ui-corner-all grid_20', 'placeholder' => 'Email')),
      'password' => new sfWidgetFormInputPassword(array(), array('class' => 'ui-state-default ui-corner-all grid_20', 'placeholder' => 'Password')),
      'date'     => new sfWidgetFormInputText(array(), array('class' => 'fecha ui-state-default ui-corner-all grid_20', 'placeholder' => 'Date')),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorInteger(array('required' => false)),
      'code'     => new sfValidatorInteger(),
      'name'     => new sfValidatorString(array('max_length' => 30)),
      'password' => new sfValidatorString(array('max_length' => 40)),
      'email'    => new sfValidatorEmail(),
      'date'     => new sfValidatorDateTime(),
    ));
    
    $this->widgetSchema->setFormFormatterName('grid');
    
    if($this->isNew()){
        $this->setDefault('date', date('m/d/Y'));
    }

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
  
  public function doBind(array $values) {
      if(!$this->isNew()){
          if($values['password'] == '')
              $values['password'] = $this->getObject()->getPassword ();
      }
      $values['password'] = sha1($values['password']);
      parent::doBind($values);
  }
}
