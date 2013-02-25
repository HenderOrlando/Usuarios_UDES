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
      'id'       => new sfWidgetFormInputHidden(),
      'code'     => new sfWidgetFormInputText(),
      'name'     => new sfWidgetFormInputText(),
      'email'    => new sfWidgetFormInputText(),
      'password' => new sfWidgetFormInputPassword(),
      'date'     => new sfWidgetFormInputText(array(), array('class' => 'fecha')),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorInteger(array('required' => false)),
      'code'     => new sfValidatorInteger(),
      'name'     => new sfValidatorString(array('max_length' => 30)),
      'password' => new sfValidatorString(array('max_length' => 25)),
      'email'    => new sfValidatorString(array('max_length' => 40)),
      'date'     => new sfValidatorDateTime(),
    ));
    
    $this->widgetSchema->setFormFormatterName('grid');
    
    if($this->isNew()){
        $this->setDefault('date', date('m/d/Y'));
    }

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
