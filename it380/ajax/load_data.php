<?php
include_once '../database.php';

$bDone = false;
$arData = [];
$arData['status'] = 'ok';
if($_GET['data'] == 'songs'){
    $db = new database();
    if(!$db->check_table_exist()){
       $db->load_data('../script/create_song_table.sql');
       $arData['msg'] = 'Song table successfully created';
       $res = $db->load_data('../script/migrate_song_data.sql');
       if($res){
            $arData['msg'] .= '<br/>Song data migrated successfully';
            $arData['status'] = 'done';
            $bDone = true;
       }
    }
}
if($_GET['data'] == 'jam'){
    $db = new database();
    if(!$db->check_table_exist()){
        $db->load_data('../script/create_jam_rule_table.sql');
        $arData['msg'] = '<br/>jam_rule2 table successfully created';
        $res = $db->load_data('../script/migrate_jam_rule_data.sql');
        if($res){
            $arData['msg'] .= '<br/>jam_rule data migrated successfully';
            if($bDone) $arData['redirect'] = true;
        }
    }
}

echo json_encode($arData);
?>