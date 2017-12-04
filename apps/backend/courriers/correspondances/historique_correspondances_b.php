  <script type="text/javascript">

  

    function OuvrirPopup(page,nom,largeur,hauteur) 

    { var winl = (screen.width - largeur) / 2;

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

    { alert('Vous avez oublié de choisir un status!');

      return false;

    }else

      return true;

    }

  </script>