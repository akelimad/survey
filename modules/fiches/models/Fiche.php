<?php
/**
 * Fiche
 * 
 * @author M'hamed Chanchaf <m.chanchaf@gmail.com>
 *
 * @package app.fiches.models
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Fiches\Models;

use App\Models\Model;

class Fiche extends Model
{

    private static $types = [
        "Fiches de présélection", 
        "Fiches d'evaluation"
    ];


    private static $notes = [
        '1.0' => 'Très insatisfaisant',
        '1.5' => 'Entre très insatisfaisant et insatisfaisant',
        '2.0' => 'Insatisfaisant',
        '2.5' => 'Entre insatisfaisant et satisfaisant',
        '3.0' => 'Satisfaisant',
        '3.5' => 'Entre satisfaisant et très satisfaisant',
        '4.0' => 'Très satisfaisant'
    ];


    public static function findById($id_fiche)
    {
        return getDB()->findOne('fiches', 'id_fiche', $id_fiche);
    }


    public static function getTypes()
    {
        return self::$types;
    }


    public static function getNotes()
    {
        return self::$notes;
    }


    public static function getOffreFicheByType($id_offre, $fiche_type)
    {
        $fiche = getDB()->prepare("SELECT f.id_fiche FROM fiches f JOIN fiche_offre fo ON fo.id_fiche=f.id_fiche WHERE f.fiche_type=? AND fo.id_offre=?", [$fiche_type, $id_offre], true);

        return (isset($fiche->id_fiche)) ? $fiche->id_fiche : null;
    }
    

    public static function getBlocksByFicheType($fiche_type)
    {
        return getDB()->findByColumn('fiche_blocks', 'fiche_type', $fiche_type) ?: [];
    }
    

    public static function getBlockItemsByCandidatureId($id_block, $id_candidature)
    {
        return getDB()->prepare("SELECT fi.* FROM fiche_items AS fi WHERE fi.id_block=?", [
            $id_block
        ]) ?: [];

        /* return getDB()->prepare("SELECT fi.* FROM fiche_items AS fi JOIN candidature AS c ON c.id_ca WHERE fi.id_block=? AND c.id_candidature=?", [
            $id_block,
            $id_candidature
        ]) ?: []; */
    }


    public static function getFichesByType($fiche_type)
    {
        return getDB()->findByColumn('fiches', 'fiche_type', $fiche_type) ?: [];
    }

    
    /**
     * Generate random reference
     *
     * @param int    $length number of caracters.
     *
     * @return string $reference.
     */
    public function genReference($length=8)
    {
        $fiche = getDb()->prepare("SELECT MAX(id_fiche) as max FROM fiches", true);
        $max = (isset($fiche->max)) ? $fiche->max : 0;
        $char_length = $length - strlen( intval($max) + 1 );
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $char_length; $i++) {
            $reference .= $characters[rand(0, $charactersLength - 1)];
        }
        return str_shuffle($reference);
    }
        
    

  
} // END Class