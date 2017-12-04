 
                <script type="text/javascript">
                    var CKEDITOR_BASEPATH = '<?php echo $jsurl; ?>/ckeditor/';
                    function display(){
                        document.getElementById('zone').style.display='inline';
                    }
                    function hide(){
                        document.getElementById('zone').style.display='none';
                    }
                </script>
				
            <script>    
                  function rafraichir( )
					{
			$('#annuler').show();
			if (window.XMLHttpRequest)
				 {// code for IE7+, Firefox, Chrome, Opera, Safari
				  xmlhttp=new XMLHttpRequest();
			  }
				else
				{// code for IE6, IE5
					   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				 }
				  xmlhttp.onreadystatechange=function()
				 {
				 if (xmlhttp.readyState==4 && xmlhttp.status==200)
				  {  progress = xmlhttp.responseText;
				 var pourcentege = ((total-progress)/total)*100;
				 var nombre = (total-progress);
				 document.getElementById("txtHint").innerHTML="L'email N°:  <strong style='color:green'> "+nombre+ "</strong>(  <strong style='color:blue'> "+pourcentege.toFixed(2)+"%  </strong>)";
					 document.getElementById("pro").innerHTML=xmlhttp.responseText =    '<div  width="200px" class="meter orange nostripes"><span style="width: '+pourcentege+'%"></span></div>';
				
				  }
			   }
				 xmlhttp.open("GET","email1.php?q="+1,true);
			  xmlhttp.send();
			 //    setTimeout(rafraichir,3000);
			  }
			  </script>
              <link rel="stylesheet" href="<?php echo $jsurl; ?>/jquery/jquery-ui.min.css"> 
  <script src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/jquery-ui.min.js"></script>
  <script src="<?php echo $jsurl; ?>/jquery/datepicker-fr.js"></script>
 
  <script>
  $("#datepicker").datepicker({ dateFormat: "dd-mm-yy" }).val()
  $(function(datepicker) {
  
     $( "#date_expiration" ).datepicker({  changeMonth: true,  changeYear: true ,  yearRange : 'c-40:c+60',  minDate : new Date(), dateFormat: "dd/mm/yy"      });
 
     
  });
  </script> 