<?php 
	session_start();
	include('call/iflogin.php');
?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Xprice</title>
  <link rel="icon" href="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	

<!--引用dataTables.js-->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
</head>
<?php
 function status($checking,$confirmed){
 	if(!$checking){
 		return "新回報(未讀取)";
 	}
 	else if(!$confirmed){
 		return "未審核";
 	}
 	else{
 		return "已審核";
 	}
 }
 function checked($id){
 	include("connMysql.php");
    $sql_query = "UPDATE `form` SET checking=1 WHERE `id` =".$id;     
      mysqli_query($db_link, $sql);
 }

?>
<script type="text/javascript">
	$(document).ready( function() {
		$('#myDataTalbe').DataTable( {
			
			"sPaginationType":"full_numbers",
			"bPaginate":true,
			"oLanguage": {
				"sProcessing": "處理中...",       
				"sLengthMenu": "顯示 _MENU_ 筆記錄",       
				"sZeroRecords": "無符合資料",
				"sInfo": "目前記錄：_START_ 至 _END_, 總筆數：_TOTAL_",       
				"sInfoEmpty": "無任何資料",       
				"sInfoFiltered": "(過濾總筆數 _MAX_)",       
				"sInfoPostFix": "",       
				"sSearch": "搜尋:",       
				"sUrl": "",       
				"oPaginate": {           
				"sFirst":"首頁",          
				"sPrevious": "上頁",           
				"sNext":"下頁",           
				"sLast":"末頁"       
				}  
			},

			"aLengthMenu": [
				[5, 10, 20, -1], 
				[5, 10, 20, "All"]
			],
	
			//數據排序
			"aaSorting": [
				[ 1, 'desc' ]
			],

			dom: 'Blfrtip',
			buttons: [ {
				extend: 'excelHtml5',
				text: '匯出EXCEL',
				autoFilter: true,
				sheetName: 'Exported data'
			} ]
	
		} );
	} );

</script>
<body>  
<div style="width:90%;text-align:center;margin: 0 auto; " > 
  <a href="call/logout.php" style="float: right">logout</a>
 	<?php echo "<h3>目前管理者:".$_SESSION['username']."</h3>"; ?>
    <!-- <div><button style="float: left" onclick="location.href='form.php'">新增資料</div> -->

    <?php
      include("connMysql.php");
      $sql = "SELECT * FROM `form`, `product` WHERE form.pno = product.pno";
      $result = mysqli_query($db_link, $sql);
      
      //create the table and write
      if($result){
        echo "<table border='1' align='center' class='table table-striped' id='myDataTalbe' >
		<thead>
		<tr>
		<th scope='col'>回報編號</th>
		<th scope='col'>商品編號</th>
		<th scope='col'>回報日期</th>
		<th scope='col'>功能</th>
		<th scope='col'>狀態</th>
		</tr></thead>
		<tbody>";
        while ($row=mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["fid"]."</td>";
        echo "<td>".$row["pno"]."</td>";
        echo "<td>".$row["date"]."</td>";
		$id = $row["fid"];
		if($row['checking']&&$row['confirmed']){
			echo "<td width='15%;'>已審核</a>&nbsp;&nbsp;<a href='delete.php?fid=".$row["fid"]."'>刪除</a></td>";
		}
		else{
			echo "<td width='15%;'><a href='check.php?fid=".$row["fid"]."'>審核</a>&nbsp;&nbsp;<a href='delete.php?fid=".$row["fid"]."'>刪除</a></td>";
		}
        echo "<td style='color:red'>".status($row["checking"],$row["confirmed"])."</td></tr>";
        }
        echo "</tbody></table>";
      }
    ?>
</div>
</body>
</html>