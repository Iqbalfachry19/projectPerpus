<?php

//fetch_user.php
include('conn.php');

session_start();


$query = "
SELECT * FROM user
WHERE id != '" . $_SESSION['user_id'] . "' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table id="customers">
 <tr>
 <th width="50%">Username</td>
 <th width="20%">Level</td>
  <th width="20%">Status</td>
  <th width="10%">Action</td>
 </tr>
';

foreach ($result as $row) {
    $status = '';
    $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
    $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
    $user_last_activity = fetch_user_last_activity($row['id'], $connect);
    if ($user_last_activity > $current_timestamp) {
        $status = '<span class="label label-success">Online</span>';
    } else {
        $status = '<span class="label label-danger">Offline</span>';
    }
    $output .= '
 <tr>
  <td>' . $row['username'] . ' ' . count_unseen_message($row['id'], $_SESSION['user_id'], $connect) . ' ' . fetch_is_type_status($row['id'], $connect) . '</td>
  <td>' . $row['level'] . '</td>
  <td>' . $status . '</td>
  <td><button type="button" class="btn btn-info btn-xs start_chat" data-touserid="' . $row['id'] . '" data-tousername="' . $row['username'] . '">Start Chat</button></td>
 </tr>
 ';
}

$output .= '</table>';

echo $output;
