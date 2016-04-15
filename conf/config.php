<?php
include "../utils/errors.php";

function connect_to_db() {
    $db = "(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=alex-pc)(PORT=1521)))(CONNECT_DATA=(SID=ASUSH)))";
    $db_user = 'asu_user';
    $db_pass = 'handover';

    return OCILogon($db_user, $db_pass, $db);
}

function show_err_msg() {
    $err = OCIError();
    $msg = $err['message'];
    console_log($err, $msg);
    die();
}

function connection_close($connect) {
    OCICommit($connect);
    OCILogoff($connect);
}

function get_permissions($user_type, $page) {
    $permission_dict = array(
        'adm' => array(
            'orders' => array(
                'create' => false,
                'view' => true,
                'edit' => false,
                'delete' => true
            ),
            'users' => array(
                'create' => true,
                'view' => true,
                'edit' => true,
                'delete' => true
            ),
            'info' => array(
                'create' => true,
                'view' => true,
                'edit' => true,
                'delete' => true
            )
        ),
        'teh' => array(
            'orders' => array(
                'create' => true,
                'view' => true,
                'edit' => true,
                'delete' => false
            ),
            'users' => array(
                'create' => false,
                'view' => true,
                'edit' => false,
                'delete' => false
            ),
            'info' => array(
                'create' => true,
                'view' => true,
                'edit' => true,
                'delete' => true
            )
        )
    );

    return $permission_dict[$user_type][$page];
}

function get_tp_fields() {
    return array(
        'PREP' => array(
            'PREP_UNBOXING' => 'PREP_UNBOX_AMOUNT',
            'PREP_CONTROL' => 'PREP_CTRL_AMOUNT'
        ),
        'ASSEMBLY' => array(
            'ASMBL_PLACING' => 'ASMBL_PLACED_AMOUNT',
            'ASMBL_SOLDERING' => 'ASMBL_SLDR_AMOUNT',
            'ASMBL_WASHING' => 'ASMBL_WSHD_AMOUNT',
            'ASMBL_PACKING' => 'ASMBL_PKG_AMOUNT'
        ),
        'CONTROL' => array(
            'CTRL_TYPE' => 'CTRL_AMOUNT'
        )
    );
}
?>
