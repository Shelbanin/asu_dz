<?php
function docs_query() {
    return "
        SELECT doc_id, doc_name, doc_url, doc_description
          FROM documents
    ";
}

function single_doc_query($id) {
    $docs_query = docs_query();

    return $docs_query . "
          WHERE doc_id='" . $id . "'
    ";
}

function operations_query() {
    return "
        SELECT oper_id, oper_name, oper_type, otyp_name, oper_description
          FROM operations_info
            JOIN operation_types ON oper_type = otyp_id
    ";
}

function single_operation_query($id) {
    $oper_query = operations_query();

    return $oper_query . "
          WHERE oper_id='" . $id . "'
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

function update_doc($data, $_id) {
    $update = "
        UPDATE documents SET
    ";

    $_to_update = "";
    foreach ($data as $key => $value) {
        $_to_update .= ($key . "='" . $value . "',");
    }
    $_to_update = substr($_to_update, 0, -1);

    $condition = "
          WHERE doc_id='" . $_id . "'
    ";

    return $update . $_to_update . $condition;
}

function update_operation($data, $_id) {
    $update = "
        UPDATE operations_info SET
    ";

    $_to_update = "";
    foreach ($data as $key => $value) {
        $_to_update .= ($key . "='" . $value . "',");
    }
    $_to_update = substr($_to_update, 0, -1);

    $condition = "
          WHERE oper_id='" . $_id . "'
    ";

    return $update . $_to_update . $condition;
}
?>
