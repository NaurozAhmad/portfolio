    	<link rel="stylesheet" type="text/css" href="js/style.css">

<div class="row">
    <div class="container"><p class="cust-contact-detail cust-work-p">We'll be happy to listen to your ideas and provide you with more details about ourselves.</p>
    <h4 class="cust-contact-detail"><span class="glyphicon glyphicon-earphone"></span> 0345-9273785 / 0336-5119794 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="glyphicon glyphicon-envelope"></span> thenewdawn1994@hotmail.com</h4></div>
   
  
   	  <div id="form-messages"></div>

   
   
       <form id="ajax-contact" method="post" action="mailer.php">

    <div id="contact_form">
        <div id="contact_results"></div>
        <div id="contact_body">
            <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                <input type="text" class="form-control" placeholder="Type your Name Here" required="true" name="name" id="name">
            </div>
            <br />
            <div class="input-group">
                <span class="input-group-addon"><span class="icon-globe"></span></span>
                <input type="text" class="form-control" placeholder="Type your Email Address Here" required="true" name="email" id="email">

            </div>
            <br />
            <div class="input-group input-last">
                <span class="input-group-addon"><span class="icon-quill"></span></span>
                <textarea type="text" class="form-control" placeholder="Type your Message Here" rows="3" required="true" name="message" id="message"></textarea>
            </div>
            <p class="cust-our-p"><button type="submit" class="btn btn-cust" value="Submit" id="submit_btn">Send</button></p>
        </div>
    </div>
    </form>

</div>

<script src="js/jquery-2.1.0.min.js"></script>
	<script src="js/app.js"></script>