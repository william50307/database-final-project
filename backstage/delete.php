<!DOCTYPE html>
<?php 
  session_start();
  include('call/iflogin.php');
  include("call/checked.php");
  include("connMysql.php");

  if(isset($_POST["delete"])){
    $sql_query = "DELETE FROM `form` where fid =".$_GET["fid"];
    mysqli_query($db_link, $sql_query);
  	//重新導向回到主畫面
  	header("Location: admin.php");
  }
  $sql_db = "SELECT form.fid, member.mid, member.name,product.pname,store.sname,product.price,form.img,member.mail
  FROM product,member,form,writed,store,supplyed
  WHERE form.fid = writed.fid AND form.pno = product.pno AND writed.mid = member.mid 
  AND supplyed.sid = store.sid AND product.pno = supplyed.pno AND form.fid =".$_GET['fid'];  
  $result = mysqli_query($db_link, $sql_db);
  $row=mysqli_fetch_assoc($result);
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8"; name="viewport" content="width=device-width,initial-scale=1.0">
  <!--<link href="main.css" rel="stylesheet" type="text/css">-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <title>delete</title>
</head>
<script>
  function del(){
    var yes = confirm('確認要刪除該筆資料嗎?')
    if(yes){
      document.selform.submit();
    }
  }
</script>
<body>
<h2 align="center">刪除資料</h2>
<p align="center"><a href="admin.php">回主畫面</a></p>
<form action="" method="post" name="formDel" id="formDel">
  <table border='1' align='center' class='table table-striped'><thead><tr><th scope='col' width="10%">欄位</th><th scope='col'>資料</th></tr></thead><tbody>
  <tr>
      <td>回報編號</td><td><?php echo $row["fid"];?></td>
    </tr>
    <tr>
      <td>回報人編號</td><td><?php echo $row["mid"];?></td>
    </tr>
    <tr>
      <td>回報人</td><td><?php echo $row["name"];?></td>
    </tr>
    <tr>
      <td>商品名稱</td><td><?php echo $row["pname"];?></td>
    </tr>
    <tr>
      <td>商品供應商</td><td><?php echo $row["sname"];?></td>
    </tr>
    <tr>
      <td>回報圖片</td><td><?php echo "<img style='display: inline' src='data:png;base64 ," .base64_encode($row['img'])."' width='20%'";?></td>
    </tr>
    <tr>
      <td>原價格</td><td><?php echo $row["price"];?></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <input name="delete" type="hidden" value="delete">
      <input type="submit" name="button" id="button" value="確定刪除" onclick="{if(confirm('確定刪除嗎?')){
      this.document.formname.submit();return true;}return false;}">
      </td>
    </tr>
  </tbody>
  </table>

</form>
</body>
</html>