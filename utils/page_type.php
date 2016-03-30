<?php

function page_to_show($parent, $get) {
    $type = isset($get['page']) ? $get['page'] : 'show';
    $included_page = "content/" . $parent . "/" . $type . "_" . $parent . ".php";

    return array(
        'type' => $type,
        'path' => $included_page
    );
}
?>