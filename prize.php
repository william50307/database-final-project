
<?php

if(isset($_POST['getimform'])){
session_start();
include('connMysql.php');

$sql_query = "SELECT * FROM member WHERE mid =".$_SESSION['mid'];
$result = mysqli_query($db_link, $sql_query);
$r = mysqli_fetch_assoc($result);
echo "<div class='text-center align-middle my-3 m-0 w-25 d-inline-block '>
        <div class='mx-auto border border-dark rounded-circle justify-content-center align-items-center' style='width:75%'>
          <img class='rounded-circle ' src='icon/william.jpg' width='100%'>
        </div>
          <p class='text-center h5 font-weight-bold'>".$r['name']."</p>
      </div>
      <div class='text-center align-middle my-3 mx-3  d-inline-block'>
          <p class='h3 font-weight-bold '>目前擁有X幣：".$r['point']." X</p>
      </div>";
}

//每四個一排
if(isset($_POST['getprize'])){
    session_start();
    include('connMysql.php');
    $sql_query = "SELECT * FROM prize ";
    $result = mysqli_query($db_link, $sql_query);
    $flag = 1;
    while($flag){
        echo "<div class='row align-items-end  mb-5 '>";
        for ($i=0;$i<4;$i++){
            $r = mysqli_fetch_assoc($result);
            if(!$r){
                $flag = 0;
                break;
            }
            echo "<div class='col-md-3 col-8 my-md-3 my-4'>
            <div class='border border-secondary text-center'>
                <div class='border-bottom border-dark'>
                    <img class='d-inline w-75 border rounded border mt-3 ' src='".$r['img']."' >
                    <p>".$r['prize_name']."</p>
                </div>
                <div class='my-3'>
                    <p class='mr-3 my-auto text-danger d-inline h4 font-weight-bold'>".$r['point']."X</p>
                    <span>剩餘數量:".$r['amount']."</span>
                    <button type='button' class='text-right btn btn-danger' onclick='confirm(".$r['pid'].")'>兌換</button>
                </div>
            </div>
          </div>";
        }
        echo "</div>";
        }
}

if (isset($_POST['exchange'])){
    session_start();
    include('connMysql.php');
    $sql_query = "SELECT * FROM member WHERE mid =".$_SESSION['mid'];
    $result1 = mysqli_query($db_link, $sql_query);
    $user = mysqli_fetch_assoc($result1);
    $sql_query2 = "SELECT * FROM prize WHERE pid =".$_POST['pid'];
    $result2 = mysqli_query($db_link, $sql_query2);
    $prize = mysqli_fetch_assoc($result2);
    //X幣不夠
    if($prize['point'] > $user['point']){
        echo('0');
    }
    else{
       //扣掉X幣
        $remain = $user['point'] - $prize['point'];
        $sql_query = "UPDATE member SET point = $remain";
        mysqli_query($db_link, $sql_query);
        //商品數量-1
        $sql_query = "SELECT * FROM prize WHERE pid =".$_POST['pid'];
        $result = mysqli_query($db_link, $sql_query);
        $prize = mysqli_fetch_assoc($result);
        if($prize['amount'] == 0){
            echo('2');
            exit(0);
        }
        $sql_query = "UPDATE prize SET amount = amount - 1 WHERE pid =".$_POST['pid'];
        mysqli_query($db_link, $sql_query);
        //寫入 exchange
        $sql_query = "SELECT * FROM exchange WHERE pid = ".$_POST['pid']." AND mid = '".$_SESSION['mid']."'";
        $result = mysqli_query($db_link, $sql_query);
        $exist = mysqli_num_rows($result);
        //若已兌換過，數量加1
        if($exist){
            $sql_query = "UPDATE exchange SET count=count+1 WHERE pid = ".$_POST['pid'];
            mysqli_query($db_link, $sql_query);
            echo('1');
        }
        else{
            $sql_query = "INSERT INTO exchange (mid, pid, count) VALUES (".$_SESSION['mid'].",".$_POST['pid'].",1)";
            mysqli_query($db_link, $sql_query);
            echo('insert!');
            echo('1');
        } 
    }
}
?>