<?php
//require_once("function-general.php");
require_once("header.php");

//showHeader();
if (htmlspecialchars($_GET["id"])!=""&&is_numeric(htmlspecialchars($_GET["id"]))){
	$showDetails = true;
	$eventId =intval(htmlspecialchars($_GET["id"]));
}
?>

</div>


<?php if (!$showDetails){  ?>
	
	<div class="container-fluid">
	<div class="content-panel">
			
			<div id="calendar"></div>
	</div>
	</div>

	<script type="text/javascript">
	
		(function($) {
			var month_enum ={
				0:  'Jan',
				1:  'Feb',
				2:  'Mar',
				3:  'Apr',
				4:  'May',
				5:  'Jun',
				6:  'Jul',
				7:  'Aug',
				8:  'Sep',
				9:  'Oct',
				10: 'Nov',
				11: 'Dec',
			}
			var options = {
				events_source: 'api/events.php',
				view: 'agenda',
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
	
<?php }else{ ?>
	

	
		<div class="container-fluid" style="margin-top:-20px;">
	
			
			<div id="calendar"></div>
	
	</div>
	
	<script type="text/javascript">
		(function($) {
			var eventId = <?php echo $eventId?>;
			var month_enum ={
				0:  'Jan',
				1:  'Feb',
				2:  'Mar',
				3:  'Apr',
				4:  'May',
				5:  'Jun',
				6:  'Jul',
				7:  'Aug',
				8:  'Sep',
				9:  'Oct',
				10: 'Nov',
				11: 'Dec',
			}
			
			var options = {
				events_source: 'api/events.php?id='+eventId ,
				view: 'details',
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
			
		}(jQuery));
	</script>
	


<?php }?>


<div>
<?php
require_once("footer.php");
//showFooter();
?>