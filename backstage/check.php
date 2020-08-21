<!DOCTYPE html>
<?php 
  include("call/checked.php"); //將該筆資料標記為已審核
  include("connMysql.php");

  if(isset($_POST["confirm"])){

    include("call/confirmed.php");  //將該筆資料標記為已審核
    include("../mailapply/sendmail.php");  //寄通知信給管理員
    //增加會員點數
    $mid = $_POST['mid'];
    $sql = "UPDATE member SET point = point+50 WHERE member.mid = $mid";
    mysqli_query($db_link, $sql);
    echo "<script>alert('該筆回報已通過審核!'); location.href = 'admin.php';</script>";

  }
  $sql_db = "SELECT form.fid, member.mid, member.name,product.pname,store.sname,product.price,form.img,member.mail,product.pno
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
  <!--引用jQuery-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <title>問題回覆</title>
</head>
<body>
 
<h3 align="center">回報審核</h2>
<p align="center"><a href="admin.php">回主畫面</a></p>
<form action="" method="post" name="form1" id="form1">
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
      <td>商品編號</td><td><?php echo $row["pno"];?></td>
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
        <input type='hidden' name='mail' value='<?php echo $row['mail'] ?>'>
        <input type='hidden' name='mid' value='<?php echo $row['mid']?>'>
        <input type='submit' name='confirm' value='確認該筆回報' >
      </td>
    </tr>
    </tbody>
    </table>
</form>
</body>
</html>