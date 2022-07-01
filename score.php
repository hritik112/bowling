<html>

<head>
    <style>
    table,
    thead,
    th,
    tbody,
    td,
    tr {
        border: 1px solid black;
        border-collapse: collapse;
    }

    td,
    th {
        height: 20px;
        text-align: center;
    }

    .table {
        margin-top: 2%;
        margin-left: 4%;
    }

    h3 {
        margin-left: -10px;
    }

    h2 {
        margin: 50px;
    }
    </style>
</head>

<body>

    <?php 
    $count =0;
      for ($j = 1; $j <= 5; $j += 1) {
          if($_POST['name'.$j]!=NULL){
              $count+=1;
          }
      }
      if($count ==0){
          echo "<h2> Sorry! None Of Player's Bolwing Data is Present </h2>";
          die;
      }
    for($k = 1;$k<=$count;$k+=1){
        ?>

    <div class='table'>
        <h3>
            <?php echo "Player Name:- ".$_POST['name'.$k]." Bowling    Score Sheet";?>
        </h3>
        <table style='width: 90%;'>

            <thead>
                <tr>
                    <th style='width: 12%;'>FRAME </th>
                    <?php
                    for ($i = 1; $i <= 10; $i += 1) {
                        echo "<th> " . $i . "</th>";
                        }
                ?>
                </tr>

            </thead>
            <tbody>
                <tr>
                    <td>Pins </td>
                    <?php
                    $pins =array(array());
                    for ($i = 1; $i <= 9; $i += 1) {
                        $x=$_POST['B'.$k.$i];
                        $y=$_POST['H'.$k.$i];
                        if($x==10){
                            $x='X';
                            $y='-';
                        }
                        if($y==10)
                        $y='/';
                        if($x == NULL)
                        {
                            $x='-';
                            $y='-';
                        }
                        if($y==NULL)
                        $y='-';
                        $pins[$i][0]=$x;
                        $pins[$i][1]=$y;
                        echo "<td> " . $x . " ".$y."</td>";
                        }
                        $x=$_POST['B'.$k.$i];
                        $y=$_POST['H'.$k.$i];
                        $z=$_POST['K'.$k.$i];
                        if($x==10){
                            $x='X';
                            
                        }
                        if($y==10)
                        $y='X';
                        if($z==10){
                            $z='X'; 
                        }
                        if($z==NULL){
                            $z='-'; 
                        }
                        if($x == NULL)
                        {
                            $x='-';
                            $y='-';
                            $z='-';
                        }
                        if($y==NULL){
                        $y='-';
                        $z='-';
                        }
                        $pins[$i][0]=$x;
                        $pins[$i][1]=$y;
                        echo "<td> " . $x . " ".$y." ".$z."</td>";
                ?>
                </tr>
                <tr>
                    <td>Score </td>
                    <?php
                    $lastScore=0;
                    for ($i = 1; $i <= 10; $i += 1) {
                        $sum=$lastScore;
                        if($pins[$i][0]=='X'){
                            //strike
                            $sum+=10;
                            if($i==10){
                                $sum+=($_POST['H'.$k.$i]+$_POST['K'.$k.$i]);
                            }
                            if($pins[$i+1][0]!='X' && $pins[$i+1][1]!='/'){
                                $sum+=($_POST['B'.$k.($i+1)]+$_POST['H'.$k.($i+1)]);
                            }
                            else{
                                $sum+=10+$_POST['B'.$k.($i+2)];
                            }
                        }
                        else if($pins[$i][1]=='/'){
                            //spare
                            $sum+=10;
                            if($pins[$i+1][0]=='X')
                            $sum+=10;
                            else{
                                $sum+=$_POST['B'.$k.($i+1)];
                            }
                        }
                        else if($pins[$i][1]!='-' && $pins[$i][0]!='-'){
                            //open frame
                            if($_POST['B'.$k.$i]+$_POST['H'.$k.$i] >10){
                                //sum is more then 10
                                $sum=max($_POST['B'.$k.$i],$_POST['H'.$k.$i]);
                            }
                            else{
                                // sum is less then or equal to 10
                                $sum+=($_POST['B'.$k.$i]+$_POST['H'.$k.$i]);
                            }
                        }
                        else if($pins[$i][1]=='-' && $pins[$i][0]!='-'){
                            $sum+=$_POST['B'.$k.$i];
                        }
                        $lastScore=$sum;
                        echo "<td> " . $sum . "</td>";
                        }
                ?>
                </tr>
            </tbody>
        </table>
    </div>
    <?php }?>
</body>

</html>