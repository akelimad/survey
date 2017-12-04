
 	 
  <script src="<?php echo $jsurl; ?>/jquery/jquery-1.11.2.min.js"></script>

   <script type="text/javascript" src="<?php echo $jsurl ?>/traitement_profil_lettre.js"></script>
   <script type="text/javascript" src="<?php echo $jsurl ?>/traitement_profil.js"></script>
<script type="text/javascript" >
count=6;
function create_champ(i) {


if(i<count)
{
var i2 = i + 1;    	

document.getElementById('leschamps_'+i).innerHTML = '<input  type="file" name="upload[]" size="30" class="cvs"/></span>';
document.getElementById('leschamps_'+i).innerHTML += (i <= 10) ? '<br /><span  id="leschamps_'+i2+'"><a class="lettre" href="javascript:create_champ('+i2+')">Ajouter une lettre</a></span>' : '';
}

}
</script>
<script type="text/javascript" >
countcv=6;
function create_champcv(i) {


if(i<countcv)
{
var i2 = i + 1;    	

document.getElementById('leschampscv_'+i).innerHTML = '<input  type="file" name="upload1[]" size="30" class="cvs"/></span>';
document.getElementById('leschampscv_'+i).innerHTML += (i <= 10) ? '<br /><span  id="leschampscv_'+i2+'"><a class="cvchamp" href="javascript:create_champcv('+i2+')">Ajouter un cv</a></span>' : '';
}

}
</script>
