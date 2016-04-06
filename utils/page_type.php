<?php

function page_to_show($parent, $get) {
    $type = 'show';

    $available_type = array('add', 'delete', 'edit', 'show');
    foreach ($available_type as $key => $value) {
        if (strpos($get['page'], $value) !== false) {
            $type = $value;
        }
    }

    $included_page = "content/" . $parent . "/" . $type . "_" . $parent . ".php";

    return array(
        'type' => $type,
        'path' => $included_page
    );
}
?>