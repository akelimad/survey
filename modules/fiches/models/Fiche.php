<?php
/**
 * Fiche
 * 
 * @author mchanchaf
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


    public static function getTypeName($key)
    {
        return (isset(self::$types[$key])) ? self::$types[$key] : null;
    }


    public static function getTypeById($id_fiche)
    {
        $fiche = getDB()->findOne('fiches', 'id_fiche', $id_fiche);
        return (isset($fiche->fiche_type)) ? $fiche->fiche_type : 0;
    }


    public static function getNotes()
    {
        return self::$notes;
    }


    public static function getOffreFicheByType($id_offre, $fiche_type)
    {
        $fiche = getDB()->prepare("
            SELECT f.id_fiche FROM fiches f 
            JOIN fiche_offre fo ON fo.id_fiche=f.id_fiche 
            WHERE fo.id_offre=? AND f.fiche_type=?
        ", [$id_offre, $fiche_type], true);

        return (isset($fiche->id_fiche)) ? $fiche->id_fiche : null;
    }
    

    public static function getBlocksByFicheType($fiche_type)
    {
        return getDB()->findByColumn('fiche_blocks', 'fiche_type', $fiche_type) ?: [];
    }
    

    public static function getBlockItem($id_fiche_candidature, $id_block, $id_item)
    {
        return getDB()->prepare("SELECT fcr.value, fcr.observations FROM fiche_candidature_results fcr JOIN fiche_candidature fc ON fc.id_fiche_candidature=fcr.id_fiche_candidature WHERE fcr.id_fiche_candidature=? AND fcr.id_block=? AND fcr.id_item=? AND fc.id_evaluator=?", [
            $id_fiche_candidature,
            $id_block,
            $id_item,
            read_session('id_role')
        ], true);  
    }
    

    public static function getBlockItems($id_block, $id_fiche)
    {
        return getDB()->prepare("SELECT * FROM fiche_items WHERE id_block=? AND id_fiche=?", [$id_block, $id_fiche]) ?: [];
    }
    

    public static function getFichesByType($fiche_type)
    {
        return getDB()->findByColumn('fiches', 'fiche_type', $fiche_type) ?: [];
    }
    

    public static function canChangeOffreFiche($id_offre, $fiche_type)
    {
        $count = getDB()->prepare("
            SELECT COUNT(*) AS nbr FROM candidature c
            JOIN fiche_candidature fc ON fc.id_candidature=c.id_candidature
            JOIN fiche_offre fo ON fo.id_offre=c.id_offre
            JOIN fiches f ON f.id_fiche=fo.id_fiche
            WHERE fo.id_offre=? AND f.fiche_type=?
        ", [$id_offre, $fiche_type], true);
        return ($count->nbr==0);
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
        $fiche = getDB()->prepare("SELECT MAX(id_fiche) as max FROM fiches", true);
        $max = (isset($fiche->max)) ? $fiche->max : 0;
        $char_length = $length - strlen( intval($max) + 1 );
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        for ($i = 0; $i < $char_length; $i++) {
            $reference .= $characters[rand(0, $charactersLength - 1)];
        }
        return str_shuffle($reference);
    }
        
    
    public static function historyFicheExists($id_candidature, $id_historique)
    {
        $count = getDB()->prepare("SELECT COUNT(*) AS nbr FROM fiche_candidature WHERE id_candidature=? AND id_historique=?", [$id_candidature, $id_historique], true);
        return ($count->nbr>0);
    }

  
} // END Class