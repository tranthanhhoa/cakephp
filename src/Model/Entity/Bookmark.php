<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Collection\Collection;

/**
 * Bookmark Entity.
 */
class Bookmark extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     * Note that '*' is set to true, which allows all unspecified fields to be
     * mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => false,
        'title' => true,
        'description' => true,
        'url' => true,
        'user' => true,
        'tags' => true,
        'tag_string' => true
    ];   

    protected function _getTagString()
    {
        if(isset($this->_properties['tag_string'])){
            return $this->_properties['tag_string'];
        }
        if(empty($this->tags)){
            return '';
        }
        $tags = new Collection($this->tags);
        $str = $tags->reduce(function($string,$tag){
            return $string . $tag->title . ',';
        }, '');

        return trim($str, ', ');
    }
}
