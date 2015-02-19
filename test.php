<?php
$curr_img=$_GET['img'];
$next_img=$_GET['img']+1;
$topleft=$_GET['tl_1'];
$topright=$_GET['tr_1'];
$bottomleft=$_GET['bl_1'];
$bottomright=$_GET['br_1'];
$choice=$_GET['c_1'];
$topleft_1=$_GET['tl_2'];
$topright_1=$_GET['tr_2'];
$bottomleft_1=$_GET['bl_2'];
$bottomright_1=$_GET['br_2'];
$choice_1=$_GET['c_2'];

echo "*******";

$file = '/home/siddhantmanocha/apache/annotate/people.txt';

$file1='/home/siddhantmanocha/apache/annotate/f1.txt';
// The new person to add to the file


$i1=$curr_img.",".$topleft.",".$bottomleft.",".($topright-$topleft).",".($bottomright-$bottomleft).PHP_EOL;
// Write the contents to the file, 
// using the FILE_APPEND flag to append the content to the end of the file
// and the LOCK_EX flag to prevent anyone else writing to the file at the same time
file_put_contents($file, $person, FILE_APPEND | LOCK_EX);


file_put_contents($file1,$i1, FILE_APPEND);

file_put_contents('/home/siddhantmanocha/apache/annotate/f2.txt',$curr_img.",".$topleft_1.",".$bottomleft_1.",".($topright_1-$topleft_1).",".($bottomright_1-$bottomleft_1).PHP_EOL, FILE_APPEND);


file_put_contents('/home/siddhantmanocha/apache/annotate/f1_label.txt',$curr_img.",".$choice.PHP_EOL, FILE_APPEND);


file_put_contents('/home/siddhantmanocha/apache/annotate/f2_label.txt',$curr_img.",".$choice_1.PHP_EOL, FILE_APPEND);

echo "*******";

echo $topleft;
echo ",";
echo $topright;
echo ",";
echo $bottomleft;
echo ",";
echo $bottomright;
echo ",";
echo $choice;
echo "<br>";
echo $topleft_1;
echo ",";
echo $topright_1;
echo ",";
echo $bottomleft_1;
echo ",";
echo $bottomright_1;
echo ",";
echo $choice_1;
echo "<br>";
echo "Next Image";
echo $next_img;

header('Location:tool.php?img='.$next_img);

?>
