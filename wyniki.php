<?php
session_start();
include("config.php");
$kodek = htmlspecialchars($_POST['kod']);
if ($kodek==$_SESSION['captcha'])
{
    if(isset($_POST["wybor"])){
        $wybor=$_POST['wybor'];
        $link=mysqli_connect($host,$user,$pass) or die ("Nie mozna utworzyc polaczenia z baza");
        $base="CREATE DATABASE $baza";
        mysqli_query($link,$base);
        mysqli_select_db($link,$baza) or die("Nie mozna wybrac bazy");
        $query = "CREATE TABLE IF NOT EXISTS glosowanie (id integer PRIMARY KEY, ip CHAR(15) NOT NULL, czas DATETIME  NOT NULL)";
    $result = mysqli_query($link, $query);
    $cz=time();
    $query ="DELETE FROM glosowanie WHERE czas < DATE_SUB(NOW(), INTERVAL 1 MINUTE)";
    $result = mysqli_query($link, $query);
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "SELECT ip FROM glosowanie WHERE ip = '$ip'";
    $result = mysqli_query($link, $query);
    $row = mysqli_num_rows($result); 
    if($row>0){
      die("You can access this again in 2 minutes");
    } 
    else {
      $query = "INSERT INTO glosowanie (ip, czas) VALUES ('$ip', NOW())";
      $result = mysqli_query($link, $query);
    }
        $query="CREATE TABLE IF NOT EXISTS Glosy (ID VARCHAR(2) PRIMARY KEY,Ilosc INT(10))";
        $result=mysqli_query($link,$query);
        $query="SELECT ID,ILOSC FROM Glosy";
        $result=mysqli_query($link,$query);
        $row = mysqli_num_rows($result); 
        if($row==0)
        {
            echo "Jestem w ifie";
        $query="INSERT INTO Glosy (ID, Ilosc) VALUES ('1','0')";
        $result=mysqli_query($link,$query);
        $query="INSERT INTO Glosy (ID, Ilosc) VALUES ('2','0')";
        $result=mysqli_query($link,$query);
        $query="INSERT INTO Glosy (ID, Ilosc) VALUES ('3','0')";
        $result=mysqli_query($link,$query);
        $query="INSERT INTO Glosy (ID, Ilosc) VALUES ('4','0')";
        $result=mysqli_query($link,$query);
        $query="INSERT INTO Glosy (ID, Ilosc) VALUES ('5','0')";
        $result=mysqli_query($link,$query);
        $query="INSERT INTO Glosy (ID, Ilosc) VALUES ('6','0')";
        $result=mysqli_query($link,$query);
        $query="INSERT INTO Glosy (ID, Ilosc) VALUES ('7','0')";
        $result=mysqli_query($link,$query);
        $query="INSERT INTO Glosy (ID, Ilosc) VALUES ('8','0')";
        $result=mysqli_query($link,$query);
        $query="INSERT INTO Glosy (ID, Ilosc) VALUES ('9','0')";
        $result=mysqli_query($link,$query);
        }
        $query="UPDATE Glosy SET Ilosc=Ilosc+1 WHERE ID='".$wybor."'";
        $result=mysqli_query($link,$query);
        $query="SELECT ID,ILOSC FROM Glosy";
        $result=mysqli_query($link,$query);
        echo "<TABLE><TR><TH>ID</th><th>Ilosc glosow</th></tr>";
        while ($row=mysqli_fetch_row($result)){
        echo  '<tr> <td>' .$row[0]. '</td>
                    <td>' .$row[1]. '</td>   
             </tr>'; 
             $dane[]=$row[1];
            }
            $_SESSION['wykres'] = $dane;
            echo "</TABLE>";          
            ?>
            <p>
                <img src="wykres.php" alt="Wykres">
            </p>
            <?php
    }
    else{
        echo "Nie oddano glosu";
    }
}
else 
{ 
    echo "<meta http-equiv=\"refresh\"content=\"0;URL=error_captcha.html\">";
}
?>