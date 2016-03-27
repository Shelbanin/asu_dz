<?php
    function docs_query() {
        return "
            SELECT doc_id, doc_name, doc_url, doc_description
                FROM DOCUMENTS
        ";
    }
?>