// JavaScript Document
$(document).ready(function(){	
						   					   
	$("#hide").hide();					   
						   
	$('.ajouter_lettre').click(function(){
		
		$("#fils").show();
						  
	});
	
	$("#fermer").click(function(){
									
		$('#fils').hide();
	
	});
	
	$('.supprimer_lettre').click(function(){							  
	
		var variable = $(this).attr('rel1');
		$.ajax({
			   
			type: 'POST',
			url: 'traitement_lettre.php',
			data: "id_lettre="+variable,
			success: function(msg){
				
				if(msg=='ok')
				{
					$('#lettre_'+variable).remove();		
                      		$('#sup_lettre_'+variable).remove();	
							$('#sup_lettre1_'+variable).remove();	
						
									$('#sup_lettre0_'+variable).remove();						
				}	
			}
			   
		    });
count=count+1;
	   });
	   
	
	   
	   
	   
	   
	
	$('.radio_principal1').click(function(){	
										 
							 
		
		$('.lettres').hide();

	
		var id_cv=$(this).attr('value');

		$.ajax({
          type: 'POST',
          url: 'principal_choix_lettre.php',
          data:  'id_lettre='+id_cv,
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
						//	$("#lettre_"+table_id[i]).hide();
							
							}
						else
						{
							$("#lettre_"+table_id[i]).show();
							}
					
					}
					//$('.cvs').empty();
					
					//$('.cvs').append(msg);
					//$('#hide').show();
					
					//$('#hide').attr('id','');
					
					//$(this).prev('.supprimer_cv').hide();
					
					//$(this).prev('.supprimer_cv').css('display','none');
					
					$('.wait').hide();
					
					$('.lettres').show();
					
					
					
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
//          url: 'upload_lettres.inc.php',
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