<?php
include '../include/init.inc.php';
$base64 = "";
extract($_POST, EXTR_IF_EXISTS);

if (Common::isPost()) {
    if ($base64) {
        $client = new PhalApiClient();

        $rs = $client->request('Finance_UploadBase64.Go', array('base64' => $base64));
        if($client->getRet()==PhalApiClient::RET_OK){
            echo json_encode($rs);
            exit();
        }else{
            echo json_encode($rs);
            exit();
        }
    }
}
exit();