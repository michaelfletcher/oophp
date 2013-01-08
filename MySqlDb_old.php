<?php

function Connect() {
    $conn = new mysqli('localhost', 'root', '110110', 'test')
            or die('Error in connecting to the db.');
    return $conn;
}

function get($conn) {
    $stmt = $conn->prepare("select id, title, body from posts")
            or die('Problem with the query.');
    $stmt->execute();
    $stmt->bind_result($id, $title, $body);

    $rows = array();

    while ($row = $stmt->fetch()) {
        $item = array(
            'id' => $id,
            'title' => $title,
            'body' => $body
        );
        $rows[] = $item;
    }

    return $rows;
}

?>
