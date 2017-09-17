
<!-- <a href="#top" class="well well-sm"  onclick="$('html,body').animate({scrollTop:0},'slow');return false;"> <i class="glyphicon glyphicon-chevron-up"></i> </a>-->
<span id="top-link-block" class="hidden"> <a href="#" onclick="$('html,body').animate({scrollTop:0},'slow');return false;" id="backtotop" style="right: 10px; margin-right: 0px; display: block;"><span id="toTopHover" style="opacity: 0;"></span></a> </span>
<div class="modal fade" id="modelConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel noprint">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss"modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Newsletter Subscribe</h4>
      </div>
      <div class="modal-body "> Your email address is successfully registered in our system. </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modelExist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel noprint">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Newsletter Subscribe</h4>
      </div>
      <div class="modal-body "> Your email address is alreasy exist in our system. </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>
<script>


if($(window).width() >950){
jQuery(function($) {
 $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('#top-link-block').fadeIn();
				$('#top-link-block').removeClass('hidden');
            } else {
                $('#top-link-block').fadeOut();
            }
});
// scroll body to 0px on click
$('#top-link-block').click(function () {
  $('#top-link-block').tooltip('hide');
  $('body,html').animate({
	  scrollTop: 0
  }, 800);
  return false;
});
      
$('#top-link-block').tooltip('hide');
	  });
}

$(function(){
    $('.demo1').easyTicker({
        direction: 'up'
    });
});
	</script>
</body></html>