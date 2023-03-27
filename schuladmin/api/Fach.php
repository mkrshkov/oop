<?php

class Fach extends Entity
{
    protected $entity;
    const TABLE_NAME = 'fach';

    public function __construct()
    {
        $this->entity = new Entity(self::TABLE_NAME);
    }

    public function db_insert_fach($fach)
    {
        $data = array('fachbezeichnung' => $fach->fachbezeichnung);
        return $this->entity->insert($data);
    }

    public function db_get_fach()
    {
        $entity = new Entity(self::TABLE_NAME);
        return $entity->getAll();
    }

    public static function db_delete_fach($id)
    {
        $entity = new Entity(self::TABLE_NAME);
        return $entity->delete(array(
            'fid' => $id
        ));
    }

    public static function db_select_fach_from_id($id)
    {
        $entity = new Entity(self::TABLE_NAME);
        return $entity->getById($id);
    }

    public static function db_update_fach($fach)
    {
        $entity = new Entity(self::TABLE_NAME);
        $id_type = "fid";
        $data = array('fachbezeichnung' => $fach->fachbezeichnung);
        return $entity->update($fach->fid, $id_type, $data);
    }
}
