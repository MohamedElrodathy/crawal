<?php
include ("function.php");

$data  = crawler::http_request('https://www.homegate.ch/mieten/immobilien/kanton-zuerich/trefferliste?ep=1');
$links = crawler::extract_elements('a', $data);


?>
<!DOCTYPE html>
<html>
<head>
	<title>Crawwl  urls</title>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div id="content">
    <table width="100%" id="crawal_table" border="0">
        <tr class="tr_header">
            <th>text</th>
            <th>Href</th>	
        </tr>
    </table>

    <div id="div_pagination">
    <input type="hidden" id="txt_rowid" value="0">
    <input type="hidden" id="txt_allcount" value="0">
    <input type="button" class="button" value="Previous" id="but_prev" />

    <input type="button" class="button" value="Next" id="but_next" />
    </div>
    <p> all result  <?php echo count($links)  ?> </p> <p>pages numbers  <?php echo  round(count($links)/20);?> </p>
</div>
</body>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<script type="text/javascript">
    // Total number of rows visible at a time
    var rowperpage = 20;

    $(document).ready(function(){
        createTablerow();

        $("#but_prev").click(function(){
            var rowid = Number($("#txt_rowid").val());
            var allcount = 1000;
            console.log(rowid);
            rowid -= rowperpage;
            if(rowid < 0){
                rowid = 0;
            }
            $("#txt_rowid").val(rowid);
            createTablerow(rowid);
        });

        $("#but_next").click(function(){
            var rowid = Number($("#txt_rowid").val());
            var allcount = 1000;
            rowid += rowperpage;
                	console.log(rowid);

            if(rowid <= allcount){
                $("#txt_rowid").val(rowid);

                createTablerow(rowid);
            }

        });
    });
  
    /* Create Table */
    function createTablerow(rowid){

    	console.log(rowid);
    	var data=<?php echo json_encode($links)?>;
        var dataLen = data.length;

        $("#crawal_table tr:not(:first)").remove();

        for(var i=rowid; i<1000; i++){
           
                var text = data[i]['text'];
                var link = data[i]['attributes']['href'];

                $("#crawal_table").append("<tr id='tr_"+i+"'></tr>");
                $("#tr_"+i).append("<td align='center'>"+text+"</td>");
                $("#tr_"+i).append("<td align='left'>"+link+"</td>");
            
        }
    }
</script>
</html>













