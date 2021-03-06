<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Session Entity
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property int $client_id
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Run[] $runs
 * @property \App\Model\Entity\Participant[] $participants
 */
class Session extends Entity
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
        'id' => false
    ];
}
