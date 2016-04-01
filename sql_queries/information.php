<?php
function docs_query() {
    return "
        SELECT doc_id, doc_name, doc_url, doc_description
          FROM documents
    ";
}

function operations_query() {
    return "
        SELECT oper_id, oper_name, otyp_name, oper_description
          FROM operations_info
            JOIN operation_types ON oper_id = otyp_id
    ";
}

function operations_types_query() {
    return "
        SELECT otyp_id, otyp_name
          FROM operation_types
    ";
}

function insert_into_docs($name, $url, $desc) {
    $query_insert = "
        INSERT INTO documents (
            doc_name,
            doc_url,
            doc_description
          )
          VALUES (
            '" . $name . "',
            '" . $url . "',
            '" . $desc . "'
          )
    ";

    return $query_insert;
}

function insert_into_opers($name, $type, $desc) {
    $query_insert = "
        INSERT INTO operations_info (
            oper_name,
            oper_type,
            oper_description
          )
          VALUES (
            '" . $name . "',
            '" . $type . "',
            '" . $desc . "'
          )
    ";

    return $query_insert;
}
?>