<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 *
 * @package    symfony
 * @subpackage widget
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfWidgetFormSchemaFormatterList.class.php 5995 2007-11-13 15:50:03Z fabien $
 */
//class sfWidgetFormSchemaFormatterList extends sfWidgetFormSchemaFormatter
//{
//  protected
//    $rowFormat       = "<li>\n  %error%%label%\n  %field%%help%\n%hidden_fields%</li>\n",
//    $errorRowFormat  = "<li>\n%errors%</li>\n",
//    $helpFormat      = '<br />%help%',
//    $decoratorFormat = "<ul>\n  %content%</ul>";
//}
/**
 *
 *
 * @package    symfony
 * @subpackage widget
 * @author     Hender Orlando Puello Rincón <hender.puello@gmail.com>
 * @version    sfWidgetFormSchemaFormatterGrid.class.php  1
 */
class sfWidgetFormSchemaFormatterFilters extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<div class=\"row-inline\">\n
                            <span class=\"\">
                                %label%\n
                            </span>
                            <div class=\"\">
                                <span class=\"\">\n%error%\n</span>
                                <span class=\"field\">\n%field%\n</span>
                            </div>
                            <span class=\"clear\"></span>
                            <span class=\"\">
                                %help%\n
                            </span>
                            <span class=\"clear\"></span>
                            <span class=\"\">
                                %hidden_fields%
                            </span>
                        </div>\n",
    $errorRowFormat  = "<span class=\"\">\n%errors%</span>\n<span class=\"clear\"></span>",
    $helpFormat      = '<span class=\"\">%help%</span>\n<span class=\"clear\"></span>',
    $errorListFormatInARow     = "  <div class=\"error_list\">\n%errors%  </div>\n",
    $errorRowFormatInARow      = "    <span class=\"ui-state-error-text\">%error%</span>\n",
    $decoratorFormat = "<div class=\"\">\n  %content%</div>\n";

  public function  formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null) {
        $format = parent::formatRow($label, $field, $errors, $help, $hiddenFields);
        if(!empty ($errors)){
            $this->rowFormat       = "<div class=\"ui-state-error\">\n
                            <span class=\"grid_3 alpha\">\n
                                %label%\n
                            </span>\n
                            <div class=\"grid_7 omega\">\n
                                <span class=\"grid_2 alpha\">\n%error%\n</span>\n
                                <span class=\"grid_5\">\n%field%\n</span>\n
                            </div>\n
                            <span class=\"clear\"></span>
                            <span class=\"grid_10\">\n
                                %help%\n
                            </span>\n
                            <span class=\"clear\"></span>
                            <span class=\"grid_10\">\n
                                %hidden_fields%
                            </span>
                        </div>\n";
        }
        return $format;
    }
}
