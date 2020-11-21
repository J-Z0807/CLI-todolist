<?php
      //連線變數設定
      $DBHOST = "localhost";
      $DBUSER = "root";
      $DBPASSWD = "";
      $DBNAME = "todolist";

      $conn = mysqli_connect( $DBHOST, $DBUSER, $DBPASSWD, $DBNAME); //連線語法
      if (empty($conn)){
        print mysqli_error($conn);
        die ("新增失敗");
        exit;
      }
      else {
        echo "已新增";
      }

      //將字符集設成 'utf8'
      mysqli_set_charset($conn,'utf8');

    //   $sql = "insert into student values ('$studentID','$NAME');";

    //   mysqli_query($conn, $sql);

      mysqli_close($conn);
    ?>