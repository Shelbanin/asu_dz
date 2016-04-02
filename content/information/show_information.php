<div id="content">
  <div class="tab">
    <table>
      <?php
      $connect = connect_to_db();
      if (!$connect) {
          show_err_msg();
      } else {
          $selected_filter = isset($_GET['filter']) ? $_GET['filter'] : 'docs';
          $query = $selected_filter == 'docs' ? docs_query() : operations_query();

          $query = OCIParse($connect, $query);
          OCIExecute($query, OCI_DEFAULT);

          if ($selected_filter == 'docs') {
              $header = array(
                  '№',
                  'Название',
                  'Ссылка',
                  'Описание',
                  'Действия'
              );
              $fields = array(
                  'DOC_NAME',
                  'url' => 'DOC_URL',
                  'DOC_DESCRIPTION',
                  'actions' => 'DOC_ID'
              );
          } else {
              $header = array(
                  '№',
                  'Название',
                  'Тип операции',
                  'Описание',
                  'Действия'
              );
              $fields = array(
                  'OPER_NAME',
                  'OTYP_NAME',
                  'OPER_DESCRIPTION',
                  'actions' => 'OPER_ID'
              );
          }

          render_table($header, true, $fields, $query);
      }
      connection_close($connect);
      ?>
    </table>
  </div>
</div>
