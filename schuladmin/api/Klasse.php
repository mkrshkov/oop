<?php

class Klasse extends Entity
{
    protected $entity;
    const TABLE_NAME = 'klasse';

    public function __construct()
    {
        $this->entity = new Entity(self::TABLE_NAME);
    }

    public function db_insert_klasse($klasse)
    {
        $data = array(
            'klassenbezeichnung' => $klasse->klassenbezeichnung,
            'schuljahr' => $klasse->schuljahr
        );
        return $this->entity->insert($data);
    }

    public function db_get_klasse()
    {
        return $this->entity->getAll();
    }

    public static function db_delete_klasse($id)
    {
        $entity = new Entity(self::TABLE_NAME);
        return $entity->delete(array(
            'kid' => $id
        ));
    }

    public static function db_select_klasse_from_id($id)
    {
        $entity = new Entity(self::TABLE_NAME);
        return $entity->getById($id);
    }

    public static function db_update_klasse($klasse)
    {
        $entity = new Entity(self::TABLE_NAME);
        $id_type = "kid";
        $data = array(
            'klassenbezeichnung' => $klasse->klassenbezeichnung,
            'schuljahr' => $klasse->schuljahr
        );
        return $entity->update($klasse->kid, $id_type, $data);
    }
}
