<?php

/**
 * Usuario filter form.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class UsuarioFormFilter extends BaseUsuarioFormFilter
{
  public function configure()
  {
      $this->setWidgets(array(
        'search'     => new sfWidgetFormFilterInput(array('with_empty' => false),array('class' => 'ui-state-default ui-corner-all', 'placeholder' => 'Search')),
      ));

      $this->setValidators(array(
        'search'     => new sfValidatorPass(array('required' => false)),
      ));
      
      $this->widgetSchema->setNameFormat('usuario_filters[%s]');

      $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
