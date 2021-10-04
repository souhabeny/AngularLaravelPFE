
<html lang = "{{str_replace ('_', '-', app () -> getLocale ())}}"> 
    <head> 
        <meta charset = "utf-8"> 
        <meta name = "viewport" content = "width = device-width, initial-scale = 1"> 
        <title> Laravel </title> 
    </head> 
    <body> 

    </form>
    <script type="text/javascript" src="http://localhost:6001/socket.io/socket.io.js"></script>
         <script src="js/app.js">
      

        </script>
    <script> 
        Echo.channel ('Event') 
            .listen ('Event', e => { 
                console.log ("dldll"+e) 
            }); 
    </script> 

    </body>
</html>