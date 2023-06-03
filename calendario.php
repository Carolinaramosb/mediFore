<?php include "cabecera.php"?>  
<html>
    <head>
        <style>
            .dia{width:100px;height:100px;border:1xp solid black; float:left;}
        </style>
    </head>
    <body>
        <div id="calendario">
            
        </div>
        <script>
            
            //fecha.getFullYear(): devuelve el año
            //tener en cuenta que enero es m=0
            //El año lo coge en número 
            
            var getDaysInMonth = function(month, year){
                return new Date(year, month, 0).getDate();
            }
                        
            var date = new Date(), y =date.getFullYear();
            for(var anio=y;anio<=2025;anio++){
                document.write("<div style='clear:both'</div>");
                document.write("<h1>Este es el anio "+anio+"</h1><br>");
                for(var mes=1;mes<=12;mes++){
                    document.write("<div style='clear:both'</div>");
                    document.write("<h2>Este es el mes "+mes+" del año</h2><br>");
                    
                    var cuentadia = 1;
                    var date = new Date(), y =anio, m=mes-1;
                    var firstDay = new Date(y, m, 1);
                    for (var diasenblanco =1; diasenblanco < firstDay.getDay(); diasenblanco++){
                        document.write("<div class='dia'></div>");
                        cuentadia++;
                    }
                    for(var dia=1; dia<=getDaysInMonth(mes, anio) ; dia++){
                        document.write("<div class='dia'>"+dia+"</div>");
                        if(cuentadia%7 == 0){
                            document.write("<div style='clear:both;'></div>");
                        }
                        cuentadia++;
                    }
                }
            }
        </script>
    </body>
</html>
<?php include "piedepagina.php"?>  