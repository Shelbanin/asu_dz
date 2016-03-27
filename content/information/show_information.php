<div id="content">
  <div class="tab">
    <table>
      <?php
      require "../../conf/config.php";
      require "../../sql_queries/information.php";
      require "../../utils/render_tables.php";

      $connect = connect_to_db();
      if (!$connect) {
          show_err_msg();
      } else {
          $selected_filter = $_SERVER['REQUEST_METHOD'] == 'POST' ? $_POST['filter'] : 'docs';
          $query = $selected_filter == 'docs' ? docs_query() : operations_query();

          OCIExecute($query, OCI_DEFAULT);

          if ($selected_filter == 'docs') {
              $header = array(
                  '№',
                  'Название',
                  'url' => 'Ссылка',
                  'Описание'
              );
              $fields = array(
                  'DOC_ID',
                  'DOC_NAME',
                  'DOC_URL',
                  'DOC_DESCRIPTION'
              );
          } else {
              $header = array(
                  '№',
                  'Название',
                  'Типо операции',
                  'Описание'
              );
              $fields = array(
                  'OPER_ID',
                  'OPER_NAME',
                  'OTYP_NAME',
                  'OPER_DESCRIPTION'
              );
          }

          render_table($header, true, $fields, $query);
          connection_close($connect);
      }
      ?>
    </table>
  </div>
</div>
