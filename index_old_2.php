<?php
//require_once("function-general.php");
require_once("header.php");

//showHeader();
?>

<h1>Recent Events</h1>
<div class="container col-lg-6 col-md-12" style="margin-bottom: 40px;">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	      <ol class="carousel-indicators">
	        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	        <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
	        <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
	      </ol>
	      <div class="carousel-inner">
	        <div class="item active">
	          <img width="100%" height="70%" alt="Graduate Seminar" src="/images/home/ecc_grad_seminar.jpg">
	        </div>
	        <div class="item">
	          <img width="100%" height="70%" alt="ECC Club Day" src="/images/home/ecc_clubday.jpg">
	        </div>
	        <div class="item">
	          <img width="100%" height="70%" alt="ECC Orientation" src="/images/home/ecc_orientation.jpg">
	        </div>
	      </div>
	      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	        <span class="glyphicon glyphicon-chevron-left"></span>
	      </a>
	      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	        <span class="glyphicon glyphicon-chevron-right"></span>
	      </a>
	    </div>
</div>


<div class="container col-lg-6 col-md-12">
	<div class="panel-group" id="accordion">
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
	          ECC Graduate Seminar
	        </a>
	      </h4>
	    </div>
	    <div id="collapseOne" class="panel-collapse collapse in">
	      <div class="panel-body">
	        ECC hosted a graduation seminar on July 20th.
	      </div>
	    </div>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
	          ECC Club Day
	        </a>
	      </h4>
	    </div>
	    <div id="collapseTwo" class="panel-collapse collapse in">
	      <div class="panel-body">
	        Club Day on Sept. 2nd
	      </div>
	    </div>
	  </div>
	  <div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
	          ECC Orientation
	        </a>
	      </h4>
	    </div>
	    <div id="collapseThree" class="panel-collapse collapse in">
	      <div class="panel-body">
	        ECC Orientation on Sept. 15th.
	      </div>
	    </div>
	  </div>
	</div>
</div>



<div class="container col-lg-12" style="text-align: center">
	<iframe width="853" height="480" src="//www.youtube.com/embed/BBMyBdcl1QQ" frameborder="0" allowfullscreen></iframe>
</div>



<div class="container col-lg-6 col-md-6 col-sm-12">
	<h1>Lunch Sale</h1>
	<p>
	ECC sales launches. <br/>
	<b>Date: </b>Every Tuesday and Thursday<br/>
	<b>Location: </b>In front of GB (Galbrieth Building) lobby<br/>
	<b>Price: </b> $6<br/>
	<b>To Purchase: </b><a href="lunch_sale.php">PURCHASE NOW</a><br/>
	</p>
</div>
<div class="container col-lg-6 col-md-6 col-sm-12">
	<h1>Textbook Sale</h1>
</div>

<?php
require_once("footer.php");
//showFooter();
?>