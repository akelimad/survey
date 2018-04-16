<?php
/**
 * Offer
 * 
 * @author mchanchaf
 *
 * @package app.offer.models
 * @version 1.0
 * @since 1.5.0
 */
namespace Modules\Offer\Models;

use App\Models\Model;

class Offer extends Model
{

  const PUBLISHED_STATUS = 'En cours';
  const ARCHIVED_STATUS  = 'Archivée';
  

  public static function getSharedOffersUrls()
  {
    return [
      'backend/module/offer/partner/offers',
      'backend/module/offer/partner/offer-entries/[0-9]+',
      'backend/module/offer/partner/entry',
      'backend/module/offer/partner/entry/[0-9]+',
      'backend/module/offer/partner/store-entry',
      'backend/module/offer/partner/store-entry/[0-9]+',
      'backend/module/offer/partner/delete-entry-attachement'
    ];
  }

} // END Class