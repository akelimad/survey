// JavaScript Document
$(document).ready(function(){	
						   					   
	$("#hide").hide();					   
						   
	$('.ajouter_cv').click(function(){
		
		$("#fils").show();
						  
	});
	
	$("#fermer").click(function(){
									
		$('#fils').hide();
	
	});
	
	$('.supprimer_cv').click(function(){							  
	
		var variable = $(this).attr('rel');
		
		$.ajax({
			   
			type: 'POST',
			url: 'traitement_cvs.php',
			data: "id_cv="+variable,
			success: function(msg){
				
				if(msg=='ok')
				{
					$('#cv_'+variable).remove();	
					$('#sup_cv_'+variable).remove();	
							$('#sup_cv1_'+variable).remove();	
						
									$('#sup_cv0_'+variable).remove();	
				}	
			}
			   
		    });
countcv=countcv+1;
	   });
	
	$('.radio_principal').click(function(){	
										 
							 
		
		$('.cvs').hide();

	
		var id_cv=$(this).attr('value');

		$.ajax({
          type: 'POST',
          url: 'principal_choix.php',
          data:  'id_cv='+id_cv,
		  success: function(msg)
		  	{	
				if(msg=='ko')
				{
					alert("probleme");	
				}
				else
				{
					
					table_id=msg.split(',');
					for(i=0;i<table_id.length;i++)
					{
						if(id_cv==table_id[i])
						{
							//alert(msg[i]+" "+id_cv);
							//$("#cv_"+table_id[i]).hide();
							
							}
						else
						{
							$("#cv_"+table_id[i]).show();
							}
					
					}
					//$('.cvs').empty();
					
					//$('.cvs').append(msg);
					//$('#hide').show();
					
					//$('#hide').attr('id','');
					
					//$(this).prev('.supprimer_cv').hide();
					
					//$(this).prev('.supprimer_cv').css('display','none');
					
					$('.wait').hide();
					
					$('.cvs').show();
					
					
					
					//window.location ="fiche_profil.php";
					//alert(msg);					
				}
			}
			
		});
	
	});
	
	
	return false;
	
	//$('#maj_cvs').submit(function(){

	//	$('#fils').hide();
	
	// });
	
//		var variable = $(this).serialize();
//		$.ajax({
//          type: 'POST',
//          url: 'upload_cvs.inc.php',
//          data:  variable,
//		  success: function(msg){
//			  
//			  if(msg=='ok')
//			  {
//				alert("cv uploader");  
//			  }
//			  
//			  else
//			  {
//				alert("probleme d'upold");  
//			  }
//			  
//			}
//			
//		});
//	
	

});