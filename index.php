
<?php
require_once("header.php");
?>        
</div>
<div class="modal fade ecc-video" tabindex="-1" role="dialog" aria-labelledby="ecc welcome you video" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		     <div class="container col-lg-12" style="text-align: center">
			<iframe width="853" height="480" src="//www.youtube.com/embed/BBMyBdcl1QQ" frameborder="0" allowfullscreen></iframe>
		</div>
    </div>
  </div>
</div>


<div class="container-fluid" id="calendar" style="margin-top:-20px">
   
    
</div>

<script type="text/javascript">
       	(function($) {
		var month_enum ={
				0:  '1',
				1:  '2',
				2:  '3',
				3:  '4',
				4:  '5',
				5:  '6',
				6:  '7',
				7:  '8',
				8:  '9',
				9:  '10',
				10: '11',
				11: '12',
			}
			var options = {
				events_source: 'api/events.php',
				view: 'home_page',
				tmpl_path: 'tmpls/',
				tmpl_cache: false,
				onAfterEventsLoad: function(events) {
					for(var i =0; i<events.length; i++){
						events[i].start = new Date(events[i].start);
						events[i].end = new Date(events[i].end);
						events[i].month = month_enum[events[i].start.getMonth()];
						events[i].year = events[i].start.getFullYear();
						events[i].day = events[i].start.getDate();
						events[i].startTime = events[i].start.toLocaleTimeString();
						events[i].endTime = events[i].end.toLocaleTimeString();
					};
				},
				onAfterViewLoad: function(view) {
					$('.page-header h3').text(this.getTitle());
					$('.btn-group button').removeClass('active');
					$('button[data-calendar-view="' + view + '"]').addClass('active');
				},
				classes: {
					months: {
						general: 'label'
					}
				}
			};
			
			
			var calendar = $('#calendar').calendar(options);
			
			$('.btn-group button[data-calendar-nav]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendar.navigate($this.data('calendar-nav'));
				});
			});
			
			$('.btn-group button[data-calendar-view]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendar.view($this.data('calendar-view'));
				});
			});
			
			$('#first_day').change(function(){
				var value = $(this).val();
				value = value.length ? parseInt(value) : null;
				calendar.setOptions({first_day: value});
				calendar.view();
			});
			
			$('#language').change(function(){
				calendar.setLanguage($(this).val());
				calendar.view();
			});
			
			$('#events-in-modal').change(function(){
				var val = $(this).is(':checked') ? $(this).val() : null;
				calendar.setOptions({modal: val});
			});
			$('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
				//e.preventDefault();
				//e.stopPropagation();
			});
		}(jQuery));

</script>


<div>
<?php
require_once("footer.php");

?>