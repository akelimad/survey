<div class="subscription" style="width:88%; margin: 10px 0px;">

    <h1> agenda </h1>

  </div>

         

         <div  style=" width:330px; height:300px; float:left; " > 

         

     <center>

         <div > 

         <?php

         if(isset($_POST['date']) && $_POST['date']!=''){ 

             

                $D = date("D",strtotime($_POST['date']));

                $M = date("M",strtotime($_POST['date']));

                $J = date("j",strtotime($_POST['date']));

                $Y = date("Y",strtotime($_POST['date']));

        }else{

            $D = date("D");

            $M = date("M");

            $J = date("j");

            $Y = date("Y");

        }

      

            

      

         ?>

                <div>

                <center>

                <div class="datepicker_top">

                <strong><?php switch( $D){case 'Sat':echo 'Dimanche';break;case 'Mon':echo 'Lundi';break;case 'Tue':echo 'Mardi';break;case 'Wed':echo 'Mercredi';break;case 'Thu':echo 'Jeudi';break;case 'Fri':echo 'Vendredi';break;case 'Sun':echo 'Samedi';break;}?>

                 <?php echo $J;?>

                 <?php switch( $M){case 'Jan':echo 'Janvier';break;case 'Feb':echo 'Février';break;case 'Mar':echo 'Mars';break;case 'Apr':echo 'Avril';break;case 'May':echo 'Mai';break;case 'Jun':echo 'Juin';break;case 'Jul':echo 'Juillet';break;case 'Aug':echo 'Août';break;case 'Sep':echo 'Septembre';break;case 'Oct':echo 'Octobre';break;case 'Nov':echo 'Novembre';break;case 'Dec':echo 'Décembre';break;}?>

                 <?php echo $Y;?></strong>

                </div>

                 

                 </center>

                </div> 

                <div style=" margin: -5px 0 0 0;">

                <?php

                if(isset($_POST['date']) && $_POST['date']!=''){ 

                echo'<a href="./" style="display: block;width: 150px;height: 15px;background: darkred;padding: 5px;text-align: center;border-radius: 5px;color: white;font-weight: bold;margin: 10px 0 0 0;" > Annuler le filtre de la date </a> ';

                }

                ?>

                </div><br/>

                <div id="datepicker"></div>



                <form id="myFormID" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">

                <input type="hidden" name="date" id="hiddenFieldID" value="">

                </form>

                

                

                

            </div>

         

                             

     </center>

         </div>