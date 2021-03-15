<?php
$code_info = "SELECT * FROM codes 
WHERE id=$code_id";
$code_result = mysqli_query($db, $code_info);

while($code_row = mysqli_fetch_assoc($code_result)){