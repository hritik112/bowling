<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bowling Scoring</title>
    <style>
    table,
    tr,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .table {
        margin-top: 2%;
        margin-left: 4%;
    }

    td {
        height: 40px;
    }

    .input {
        border: none;
        height: 40px;
        font-size: 18px;
    }

    .inline input {
        border: none;
        border-bottom: 1px solid ;
        border-left: 1px solid ;
        float:right;
        -moz-appearance: textfield;
    }
    .total{
        border: none;
        height: 40px;
        text-align:center;
        -moz-appearance: textfield;
    }
    </style>
    <script>
function remove(x) {
    var y=document.getElementById("B"+x).value;
    
    if(y<10){
    document.getElementById("H"+x).removeAttribute('readonly');
    }
    if(x>'100' && y==10){
        document.getElementById("H"+x).removeAttribute('readonly');
        document.getElementById("K"+x).removeAttribute('readonly');
    }
}
function Total(y,x,val){
    if (y==0)
    y='B';
    if(y==1)
    y='H';
    var p=document.getElementById('total'+val);
    var q= document.getElementById(y+x);
    var sum=parseInt(p.value)+parseInt(q.value);
    if(q.value>10){
        p.value=Math.min(parseInt(p.value),parseInt(q.value));
        return;
    }
    if(sum <=10)
    p.value=sum;
    else{
        p.value=Math.max(parseInt(p.value),parseInt(q.value));
    }
}
function initiate(h){
    console.log(document.getElementById('total'+h).value);
    document.getElementById('total'+h).value=0;
}
</script>
</head>

<body>
    <form action="score.php" method="post" autocomplete="off">
        <div style="font-size:12px;color:blue;margin-top:8%;margin-left:3% ">
            <h1>
                Bowling Scoring
            </h1>
        </div>
        <div class='table'>
            <table style='width: 96%;'>

                <thead>
                    <tr>
                        <th style='width: 10%;'>Name</th>
                        <?php
                    for ($i = 1; $i <= 10; $i += 1) {
                        echo "<th> Frame " . $i . "</th>";
                        }
                ?>
                        <th>Total </th>
                    </tr>

                </thead>
                <tbody >
                    <?php
                    for ($j = 1; $j <= 5; $j += 1) {
                       
                ?>
                    <tr>
                        <td><input type="text" class='input' size="10" name='name<?php echo $j;?>' ></td>
                        <?php
                    for ($i = 1; $i <= 10; $i += 1) {
                        echo "<td class='inline'><input type='number' id=B".$j.$i." oninput='Total(0,$j$i,$j)' onfocus='initiate($j)' onchange='remove($j$i)' name=B".$j.$i." size='1' min='0' max='10' >
                        <input type='number' id=H".$j.$i." name=H".$j.$i." size='1' oninput='Total(1,$j$i,$j)' onchange='remove($j$i)' min='0' max='10' readonly>";
                        if($i==10){
                            echo "<input type='number' id=K".$j.$i." name=K".$j.$i." size='1' min='0' max='10' readonly>";
                        }
                        echo "</td>";
                        }?>
                        <td ><input class='total' type="number" size='2' name="" value='0' id="total<?php echo $j;?>" readonly> </td>
                    </tr>
                    <?php  }?>

                </tbody>
            </table>
        </div>
        <div style='margin-right:5%;margin-top:3%;'>
            <input type="submit" value="Calculate Score" style="float:right; padding: 5px;px;font-size:16px">
        </div>
    </form>
</body>

</html>