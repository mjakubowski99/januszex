<?php

namespace app\models;

use app\database\Database;

abstract class Model{

    protected static $tableName;
    protected static $database;

    public abstract static function table();

    protected static function tryToSetDatabase(){
        if( !isset( static::$database ) )
            static::$database = new Database();
        if( !isset( static::$tableName ) )
            static::$tableName = static::table();
    }

    protected static function composeQueryPart($array){
        $queryPart = "";

        foreach( $array as $key => $value){
            $queryPart = $queryPart.$key.'=:'.$key.', ';
        }

        $queryPart = substr($queryPart, 0, -2);
        return $queryPart;
    }

    protected static function composeWhere($array){
        $queryPart = "";

        foreach( $array as $key => $value){
            $queryPart = $queryPart.$key.'=:'.$key.' AND ';
        }

        $queryPart = substr($queryPart, 0, -5);
        return $queryPart;
    }

    public static function composeUpdateQuery($values, $where): string{
        $query = "UPDATE ".static::$tableName." SET ".static::composeQueryPart($values);

        if( count($where) === 0 )
            return $query;

        return $query." WHERE ".static::composeWhere($where);
    }

    /* params
       $values - array with mapping column to new value
       $where - optional where statement, where columns are mapped to values
    */
    public static function update($values, $where = []){
        static::tryToSetDatabase();

        $bindings = array_merge($values, $where);

        $query = static::composeUpdateQuery($values, $where);
        static::$database->update($query, $bindings);
    }
}