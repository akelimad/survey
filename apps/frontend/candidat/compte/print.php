<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div id="testdiv">
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</div>
<p id="button">Click me</p>

<img src="" id="img">

<script type='text/javascript'>
$(document).ready(function() {
  $("#button").click(function(){
    html2canvas($("#testdiv"), {
        onrendered: function(canvas) {
            // canvas is the final rendered <canvas> element
            var myImage = canvas.toDataURL("image/png");
            $('img').attr('src', myImage)
            console.log(myImage)
            // window.open(myImage);
        }
    });
  });
});
</script>