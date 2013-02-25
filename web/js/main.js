/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function submitAjax(id){
    $(id).submit(function(){
       var el = $(this);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $(el).parent().html(data);
            }
        });
        return false;
    })
}
function searchAjax(id){
    $(id).submit(function(){
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $('#list').html(data);
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
$(function(){
    checkFechas('.fecha')
    submitAjax('#register_user form');
    searchAjax('#search form');
})