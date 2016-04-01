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
?>