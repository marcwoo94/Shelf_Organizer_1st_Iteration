<!DOCTYPE html>
<html>
<head>
  <title>Shelf Organizer</title>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="/style.css">

  <?php
  // Access MySQL Database
    $conn=mysqli_connect('localhost', 'root', 'password', 'songdolib');

    $from = $_GET['from'];
    $to = $_GET['to'];

    if (isset($_GET['checkbox'])){
      $checkbox_value = $_GET['checkbox'];
      $checkbox_count = count($checkbox_value);
        foreach ($checkbox_value as $checkbox_count){
          $sql_nip_fix = "UPDATE booklist SET nip = NOT nip WHERE id = $checkbox_count";
          $sql_nip_fix_result = mysqli_query($conn, $sql_nip_fix);
        };
    }

    $sql="SELECT * FROM booklist WHERE id>=$from and id <=$to";
    $sql_result = mysqli_query($conn, $sql);
  ?>

</head>

<body>
  <center>
  <div class='main'>
      <div style="font-family:noto sans; font-size:50px; font-weight:700; margin:50px 0px 20px 0px;">
        <a href="home.html" style="text-decoration:none; color:#000;">Shelf Organizer</a>
      </div>
      <div style="font-family:noto sans; font-size:30px; font-weight:700; margin:10px 10px;">
        ID: <?php echo $from.'~'.$to; ?>
      </div>
      <br>

      <div style="font-family:noto sans;">
      <?php
    //Print Booklist Table Head
      echo "<table>
              <tr>
                <th class='id'>ID</th>
                <th class='title'>Title</th>
                <th class='id'>CO</th>
                <th class='id'>NP</th>
                <th class='id'>CB</th>
              <tr>
            </table>";


    //Print Booklist Table Body
      while($row=mysqli_fetch_assoc($sql_result)){
        $id=$row['id'];
        $title=$row['title'];

          if ($row['checkout'] == false){
            $checkout = 'F';
          }
          else {
            $checkout = 'T';
          }

          if ($row['nip'] == false){
            $nip = 'F';
          }
          else {
            $nip = 'T';
          }

        echo "<table class='id'>
                <tr>";
          if ($row['sample'] == false){
            echo "<td class='id'>$id</td>
                  <td class='title'>$title</td>
                  <td class='id'>$checkout</td>
                  <td class='id'>$nip</td>
                <form action='/main.php', method='get'>
                  <td class='id'>
                    <input type='checkbox' id='$id' name='checkbox[]' value='$id'>
                  </td>
                </tr>
              </table>";
          }
          else{
            echo "<td class='id2'>$id</td>
                  <td class='title2'>$title</td>
                  <td class='id2'>$checkout</td>
                  <td class='id2'>$nip</td>
              <form action='/main.php', method='get'>
                  <td class='id2'>
                    <input type='checkbox' id='$id' name='checkbox[]' value='$id'>
                  </td>
                </tr>
              </table>";
          }
      };

        ?>
      </div>

      <input style="display:none;" name="from" value="<?php echo $from; ?>">
      <input style="display:none;" name="to" value="<?php echo $to; ?>">
      <br><br>
      <h3><input type="submit" value="Update" style="font-family:noto sans; font-size:x-large;">
      <a href="/home.html"><input type="button" value="Return" style="font-family: noto sans; font-size:x-large;"></a></h3>
  </form>
  </div>

</body>
</html>
