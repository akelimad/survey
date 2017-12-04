<?php
        $sql = mysql_query(" SELECT * from root_roles 
            where id_role = '".$_SESSION['id_role']."' LIMIT 0 , 1 ");
        $role = mysql_fetch_assoc($sql);
        
       // $numrows = mysql_num_rows($sql);
        if ($role) {
        $id_offre_f='';
             /*=============================================================================================*/
             $_SESSION['ref_filiale_role'] = $role['ref_filiale'];  
                     /*//////////////////////////////////////////////////////////////////////////////////////*/     
                            $q_ref_fili='';$q_ref_fili_and='';
                            if (isset($_SESSION['ref_filiale_role']) and $_SESSION['ref_filiale_role']!=''){
                                if (isset($_SESSION['ref_filiale_role']) and $_SESSION['ref_filiale_role']!='0'){       
                                    $q_ref_fili = "where ref_filiale = '".$_SESSION['ref_filiale_role']."' ";       
                                    $q_ref_fili_and = " and  ref_filiale = '".$_SESSION['ref_filiale_role']."' ";   
                                    $_SESSION['query_ref_fili']      = $q_ref_fili;     
                                    $_SESSION['query_ref_fili_and']  = $q_ref_fili_and; 
                                }
                            }        
                     /*//////////////////////////////////////////////////////////////////////////////////////*/
                     $result_filiale = mysql_query("select * from offre ".$q_ref_fili." ");
                            while( $reponse_filiale  = mysql_fetch_array($result_filiale)) {   
                            $id_offre_f .= " '".$reponse_filiale['id_offre']."' ,";
                               } 
                            $id_offre_filiale=substr($id_offre_f, 0, -1);
                if(empty($id_offre_filiale)){   $id_offre_filiale=0; }      
                $_SESSION['query_offre_fili']=" where offre.id_offre in (".$id_offre_filiale.") ";
                $_SESSION['query_offre_fili_and']=" And  offre.id_offre in (".$id_offre_filiale.") ";
                
                /*=============================================================================================*/
             

        }
?>