/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function submitAjax(id){
    $(id).live('submit',function(){
       var el = $(this);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $(el).parent().html(data);
                checkStyles()
            }
        });
        return false;
    })
}
function searchAjax(id){
    $(id).live('submit',function(){
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $('#list').html(data);
                checkStyles()
            }
        });
        return false;
    })
}
function linkAjax(id){
    $(id).live('click',function(){
        $.ajax({
            type: 'POST',
            url: $(this).attr('href'),
            success: function(data) {
                $('#list').html(data);
                checkStyles()
            }
        });
        return false;
    })
}
function checkFechas(id){
  $( id ).datepicker({
      hideIfNoPrevNext: true
      ,minDate: "-50Y"
      ,maxDate: "0"
      ,changeMonth: true
      ,changeYear: true
      ,showAnim: 'blind'
      ,navigationAsDateFormat: false
      ,gotoCurrent: true
      ,beforeShow: function(){
//          $('.ui-datepicker select').sac()
      }
  });
  $('.ui-datepicker-trigger').button().addClass('fixed_border ui-state-default')
}
function checkStyles(){
  $('.botonset').buttonset()
  $('.botonDisabled').button({disabled: true})
  $('.boton, button, :submit').button()
  $('input').live({
      mouseover: function(){
          $(this).addClass('ui-state-hover');
      },
      mouseout: function(){
          $(this).removeClass('ui-state-hover');
      },
      focus: function(){
          $('input').removeClass('ui-state-active');
          $(this).addClass('ui-state-active');
      }
  })
}
$(function(){
    checkFechas('.fecha')
    submitAjax('#register_user form, #list_user form');
    linkAjax('a')
    searchAjax('#search form');
    checkStyles()
})