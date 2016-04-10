<?php
$info = $info_to_restore;
$tp = $tp_to_restore;
$amount = $info['amount'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $posted_data = $_POST['order'];
    $processed_data = process_data($posted_data);

    $connect = connect_to_db();
    if (!$connect) {
        show_err_msg();
    } else {
        if (empty($tp)) {
            $query = tp_insert_prep_query($processed_data[1]);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $query = tp_insert_asmbl_query($processed_data[2]);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $query = tp_insert_ctrl_query($processed_data[3]);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $query = tp_insert_order_info_query();
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $query = tp_update_order_info_query($info['id']);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);
        } else {
            $query = tp_update_prep_query($info['pred_id'], $processed_data[1]);

            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $query = tp_update_asmbl_query($info['asmbl_id'], $processed_data[2]);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $query = tp_update_ctrl_query($info['ctrl_id'], $processed_data[3]);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);
        }

        $status = $_POST['status'];

        if ($status != $info['status']) {
            $query = '';
            if ($info['status'] == 1 and $status == 2) {
                $query = insert_date_query($info_to_restore['dates_id'], 'start', date('d.m.Y'));
            } else if ($info['status'] == 2 and $status == 3) {
                $query = insert_date_query($info_to_restore['dates_id'], 'start', date('d.m.Y'));
            }
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);

            $query = update_status_query($info['id'], $status);
            $query = OCIParse($connect, $query);
            OCIExecute($query, OCI_DEFAULT);
        }

        $amount_array = array();
        foreach($processed_data as $opers_array) {
            foreach ($opers_array as $oper_amount) {
                array_push($amount_array, $oper_amount);
            }
        }
        array_push($amount_array, $amount);

        $query = progress_update_query($info['id'], $amount_array);
        $query = OCIParse($connect, $query);
        OCIExecute($query, OCI_DEFAULT);
    }
    connection_close($connect);

    header("Location: orders.php?page=show&id=" . $info['id'] . "");
    exit();
}

$cancel_path = $_SERVER['PATH_INFO'] . "?page=show&id=" . $info['id'];

$connect = connect_to_db();
if (!$connect) {
    show_err_msg();
} else {
    $query = operations_info_query();
    $query = OCIParse($connect, $query);
    OCIExecute($query, OCI_DEFAULT);

    $tp_combobox_data = array();
    while(OCIFetch($query)) {
        $type_id = OCIResult($query, 'OPER_TYPE');
        $oper_id = OCIResult($query, 'OPER_ID');
        $tp_combobox_data[$type_id][$oper_id] = OCIResult($query, 'OPER_NAME');
    }

    $query = statuses_query();
    $query = OCIParse($connect, $query);
    OCIExecute($query, OCI_DEFAULT);

    $st_combobox_data = array();
    while(OCIFetch($query)) {
        $st_id = OCIResult($query, 'ST_ID');
        $st_combobox_data[$st_id] = OCIResult($query, 'ST_NAME');
    }
}
connection_close($connect);

function process_data($data) {
    $processed_data = array();
    $counter = 1;

    foreach ($data as $oper_type => $operations) {
        $keys = array_keys($operations);
        $amount_keys = preg_grep('/[a-z]+_am/', $keys);
        foreach ($amount_keys as $value) {
            $key = str_replace('_am', '', $value);
            $processed_data[$counter][$data[$oper_type][$key]] = $data[$oper_type][$value];
        }
        $counter++;
    }

    return $processed_data;
}
?>

<div id="content">
    <h4 align="center">Изменение заказа №<? echo $info['id'] ?></h4>
    <form action="" method="POST">
    <div class = "left-block">
        <p>Статус:</p>
        <h4 align="right" style="margin-right: 0;">Изменение технол</h4>

        <h5 align="left">Подготовка комплектующих</h5>
        <select name="order[prep][unbx]" required>
            <?if (empty($tp[1])): ?>
                <option selected></option>
            <? endif; ?>
            <?
            $arrk = array_keys($tp[1]);
            foreach ($tp_combobox_data[1] as $key => $value):
            ?>
                <option value="<? echo $key ?>" <? if ($key==$arrk[0]): echo 'selected'; endif;?>>
                    <? echo $value ?>
                </option>
            <? endforeach; ?>
        </select>
        <select name="order[prep][ctrl]" required>
            <?if (empty($tp[1])): ?>
                <option selected></option>
            <? endif; ?>
            <?
            $arrk = array_keys($tp[1]);
            foreach ($tp_combobox_data[1] as $key => $value):
                ?>
                <option value="<? echo $key ?>" <? if ($key==$arrk[1]): echo 'selected'; endif;?>>
                    <? echo $value ?>
                </option>
            <? endforeach; ?>
        </select>

        <h5 align="left">Сборка модуля</h5>
        <select name="order[asmbl][placing]" required>
            <?if (empty($tp[2])): ?>
                <option selected></option>
            <? endif; ?>
            <?
            $arrk = array_keys($tp[2]);
            foreach ($tp_combobox_data[2] as $key => $value):
                ?>
                <option value="<? echo $key ?>" <? if ($key==$arrk[0]): echo 'selected'; endif;?>>
                    <? echo $value ?>
                </option>
            <? endforeach; ?>
        </select>
        <select name="order[asmbl][soldering]" required>
            <?if (empty($tp[2])): ?>
                <option selected></option>
            <? endif; ?>
            <?
            $arrk = array_keys($tp[2]);
            foreach ($tp_combobox_data[2] as $key => $value):
                ?>
                <option value="<? echo $key ?>" <? if ($key==$arrk[1]): echo 'selected'; endif;?>>
                    <? echo $value ?>
                </option>
            <? endforeach; ?>
        </select>
        <select name="order[asmbl][washing]" required>
            <?if (empty($tp[2])): ?>
                <option selected></option>
            <? endif; ?>
            <?
            $arrk = array_keys($tp[2]);
            foreach ($tp_combobox_data[2] as $key => $value):
                ?>
                <option value="<? echo $key ?>" <? if ($key==$arrk[2]): echo 'selected'; endif;?>>
                    <? echo $value ?>
                </option>
            <? endforeach; ?>
        </select>
        <select name="order[asmbl][packaging]" required>
            <?if (empty($tp[2])): ?>
                <option selected></option>
            <? endif; ?>
            <?
            $arrk = array_keys($tp[2]);
            foreach ($tp_combobox_data[2] as $key => $value):
                ?>
                <option value="<? echo $key ?>" <? if ($key==$arrk[3]): echo 'selected'; endif;?>>
                    <? echo $value ?>
                </option>
            <? endforeach; ?>
        </select>

        <h5 align="left">Функциональный контроль</h5>
        <select name="order[ctrl][type]" required>
            <?if (empty($tp[3])): ?>
                <option selected></option>
            <? endif; ?>
            <?
            $arrk = array_keys($tp[3]);
            foreach ($tp_combobox_data[3] as $key => $value):
                ?>
                <option value="<? echo $key ?>" <? if ($key==$arrk[0]): echo 'selected'; endif;?>>
                    <? echo $value ?>
                </option>
            <? endforeach; ?>
        </select>

        <a href="<? echo $cancel_path ?>">
            Отмена
        </a>
    </div>
    <div class="right-block">
            <select name="status" required>
                <? foreach ($st_combobox_data as $key => $value): ?>
                    <option value="<? echo $key ?>" <? if ($key==$info['status']): echo 'selected'; endif;?>>
                        <? echo $value ?>
                    </option>
                <? endforeach; ?>
            </select>
            <h4 align="left" style="margin-left: 0;">огического процесса</h4>
            <h5 style="color: white; -webkit-user-select: none;">костыли подъехали</h5>
            <?
            $prep = array_keys($tp[1]);
            $asmb = array_keys($tp[2]);
            $ctrl = array_keys($tp[3]);
            ?>
            <input type="number" min="0" max="<? echo $amount ?>" name="order[prep][unbx_am]"
                   value="<? echo $tp[1][$prep[0]] ? $tp[1][$prep[0]] : 0;?>">
            <input type="number" min="0" max="<? echo $amount ?>" name="order[prep][ctrl_am]"
                   value="<? echo $tp[1][$prep[1]] ? $tp[1][$prep[1]] : 0;?>">
            <h5 style="color: white; -webkit-user-select: none;">костыли подъехали</h5>
            <input type="number" min="0" max="<? echo $amount ?>" name="order[asmbl][placing_am]"
                   value="<? echo $tp[2][$asmb[0]] ? $tp[2][$asmb[0]] : 0;?>">
            <input type="number" min="0" max="<? echo $amount ?>" name="order[asmbl][soldering_am]"
                   value="<? echo $tp[2][$asmb[1]] ? $tp[2][$asmb[1]] : 0;?>">
            <input type="number" min="0" max="<? echo $amount ?>" name="order[asmbl][washing_am]"
                   value="<? echo $tp[2][$asmb[2]] ? $tp[2][$asmb[2]] : 0;?>">
            <input type="number" min="0" max="<? echo $amount ?>" name="order[asmbl][packaging_am]"
                   value="<? echo $tp[2][$asmb[3]] ? $tp[2][$asmb[3]] : 0;?>">
            <h5 style="color: white; -webkit-user-select: none;">костыли подъехали</h5>
            <input type="number" min="0" max="<? echo $amount ?>" name="order[ctrl][type_am]"
                   value="<? echo $tp[3][$ctrl[0]] ? $tp[3][$ctrl[0]] : 0;?>">

            <input type="submit" value="Принять" class="submit" style="margin-left: 10px;">
    </div>
    </form>
</div>
