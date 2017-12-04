    

 <style type="text/css">
 select{
 width:190px ;
 }</style>
<script type="text/javascript"> 
function OuvrirPopup(page,nom,largeur,hauteur) 
{   var winl = (screen.width - largeur) / 2;
    var wint = (screen.height - hauteur) / 2;
    winprops = 'height='+hauteur+',width='+largeur+',top='+wint+',left='+winl+',menubar=no,scrollbars=yes'
    win = window.open(page, nom, winprops)
}function colorer(i){
document.getElementById('select'+i).className = "marked";
}function pasdecouleur(i,j){
    if(j==1)
        document.getElementById('select'+i).className = "odd1";
    else
        document.getElementById('select'+i).className = "even1";
}function valider(){
if(document.getElementById('status').value == '')
{   alert('Vous avez oublié de choisir un status!');
    return false;
}else
    return true;
    loc
}</script>
<style type="text/css">
form {
    display:inline
}div.table {
    display:table;
    /* Joindre les bords des cellules */
        border-collapse:collapse;
    z-index: 999;
}div.tr {
    display:table-row;
}div.td {
    display:table-cell;
 display:inline;
zoom:1;
    border:1px solid black;
    padding:5px;
}a.info #tableau {
    display: none; /* on masque l'infobulle */
}a.info:hover {
    background: none; /* correction d'un bug IE */
    z-index: 999; /* on définit une valeur pour l'ordre d'affichage */
    cursor: pointer; /* on change le curseur par défaut en curseur d'aide */
}a.info:hover #tableau {
    display: inline; /* on affiche l'infobulle */
    position: absolute;
    white-space: nowrap; /* on change la valeur de la propriété white-space pour qu'il n'y ait pas de retour à la ligne non-désiré */
    background: white;
    color: black;
    padding: 3px;
    border: 2px solid black;
}</style>

