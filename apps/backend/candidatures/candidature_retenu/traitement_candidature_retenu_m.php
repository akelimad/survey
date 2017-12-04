<div class='texte'>
      <br/>
      <h1>TRAITEMENT DES CANDIDATURES RETENUES</h1>

        

 


            
           <?php
  
             echo '<table> <tr class="odd">
				  <td><b>Nombre des candidatures retenues : </b></td>';
				  if ($tpc)
          {echo '<td><span class="badge badge-success">'.$tpc.'</span></td>';}
          else{echo '<td><span class="badge badge-error">0</span></td>';}
          echo '</tr></table>';
              
           
           ?>
            
            
            <div class="subscription" style="margin: 10px 0pt;">

          <h1>Options de filtrage des candidatures retenues  </h1>
    
     </div>
            
            
            
            
            
            
            
            
   <?php          
            
   //**************************************** filtrage candiddature ***********************/         
       ?> 
         
            
            
            
            
               
          
 
   <?php
   include("./traitement_candidature_retenu_m_filtre.php");
   ?>
   

        
            
            
            
            
            
            
            
            


   <?php

    if(isset($_SESSION["query"])) 
    {
             
        $query  =  $_SESSION["query"];  
                
                 
          $query = $query."  ORDER BY pertinence  DESC  "; 

        $req  =  mysql_query($query);
                 
    ?> 
 <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" name="global" >  
      <b> * Le point en couleur montre la pertinence de la candidature (<span style="color:#79796A"><a style="color:#00B300">Vert</a>: pertinence bonne, <a style="color:#CC5500;">Orange</a>: pertinence moyenne,  <a style="color:#CC0000">Rouge</a>: pertinence faible. </b><b>).</b>
<?php 
include("./traitement_candidature_retenu_m_table.php");

    }
 
 

     ?>

    </div>

</div>