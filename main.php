<!DOCTYPE html>
<html>
<head>
  <title>Shelf Organizer</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/style.css">

  <?php
  // Access MySQL Database
    $conn=mysqli_connect('localhost', 'root', '4243109', 'songdolib');

    $from = $_GET['from'];
    $to = $_GET['to'];

    if (isset($_GET['checkbox'])){
      $checkbox_value = $_GET['checkbox'];
      $checkbox_count = count($checkbox_value);
        foreach ($checkbox_value as $checkbox_count){
          $sql_missing_fix = "UPDATE booklist SET missing = NOT missing WHERE id = $checkbox_count";
          $sql_missing_fix_result = mysqli_query($conn, $sql_missing_fix);
        };
    }

    $sql="SELECT * FROM booklist WHERE id>=$from and id <=$to";
    $sql_result = mysqli_query($conn, $sql);
  ?>

</head>

<body>
      <h1><a href="/home.html" class="no_deco">Shelf Organizer</a></h1>
      <h2>ID: <?php echo $from.'~'.$to; ?></h2>

      <table>
      <?php
    //Print Booklist Table Head
      echo "<tr>
                <th class='smallTitle title'>제목</th>
                <th class='smallTitle call'>청구기호</th>
              <tr>";


    //Print Booklist Table Body
      while($row=mysqli_fetch_assoc($sql_result)){
        $id=$row['id'];
        $title=$row['title'];
        $call_num=$row['call_num'];

        echo "<tr>";
          if ($row['checkout'] == 0 and $row['missing'] == 0){
            echo "<td class='title'>$title</td>
                  <form action='/main.php', method='get'>
                  <td class='call'>
                    $call_num
                    <input type='checkbox' class='largerCheckbox' id='$id' name='checkbox[]' value='$id'>
                  </td>
                </tr>";
          }
          elseif ($row['checkout'] == 1 or $row['missing'] == 1){
            echo "<td class='checkout title'>$title</td>
                  <form action='/main.php', method='get'>
                  <td class='checkout call'>
                    $call_num
                    <input type='checkbox' class='largerCheckbox' id='$id' name='checkbox[]' value='$id'>
                  </td>
                </tr>";
          }
      };
      
      ?>
      </table>

      <input style="display:none;" name="from" value="<?php echo $from; ?>">
      <input style="display:none;" name="to" value="<?php echo $to; ?>">

      <div class="center">
        <h2>
          <input type="submit" class="home" value="Update">
        </h2>
        <h2>
          <a href="/home.html"><input type="button" class="home" value="Return">
        </h2>
      </div>
  </form>

</body>
</html>
