<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property string $unit
 * @property float|null $price
 * @property \Cake\I18n\FrozenTime|null $expiry
 * @property float|null $inventory
 * @property float $cost
 * @property string|null $image
 */
class Product extends Entity
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
        'name' => true,
        'unit' => true,
        'price' => true,
        'expiry' => true,
        'inventory' => true,
        'cost' => true,
        'image' => true,
    ];
}
