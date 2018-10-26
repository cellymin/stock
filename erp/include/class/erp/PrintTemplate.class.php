<?php
if (!defined('ACCESS')) {
    exit('Access denied.');
}

class PrintTemplate extends Base
{
    public static function insert($input)
    {
        if (!$input || !is_array($input)) {
            return false;
        }
        $db = self::__instance();

        return $db->insert('vich_goods_conf', $input);
    }


    public static function update($id, $input)
    {
        if (!$input || !is_array($input)) {
            return false;
        }

        $db = self::__instance();

        return $db->update('vich_goods_conf', array('sets' => $input['sets']), array('id' => $id));
    }

    public static function select($companyId)
    {
        $db = self::__instance();

        $set = $db->select('vich_goods_conf', '*', array('companyId' => $companyId));
        if ($set) {
            return $set[0];
        }
        return array();
    }

    public static function save($input)
    {
        if (!$input || !is_array($input)) {
            return false;
        }
        $companySet = PrintTemplate::select($_SESSION[UserSession::SESSION_NAME]['companyId']);
        if ($companySet) {
            return self::update($companySet['id'], $input);
        }
        return self::insert($input);
    }
}