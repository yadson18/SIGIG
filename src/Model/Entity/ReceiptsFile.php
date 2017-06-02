<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReceiptsFile Entity
 *
 * @property int $id_receipt
 * @property int $id_file
 */
class ReceiptsFile extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id_receipt' => false,
        'id_file' => false
    ];
}
