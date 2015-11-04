<?php 
/**
 * Pimcore
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pimcore.org/license
 *
 * @category   Pimcore
 * @package    Object_Class
 * @copyright  Copyright (c) 2009-2010 elements.at New Media Solutions GmbH (http://www.elements.at)
 * @license    http://www.pimcore.org/license     New BSD License
 */

class Object_Class_Data_Tagfield extends \Pimcore\Model\Object\ClassDefinition\Data\Multiselect {

    /**
     * Static type of this element
     *
     * @var string
     */
    public $fieldtype = "Tagfield";
    
    public function getDataForEditmode($data, $object = null) {
        if(is_array($data)) {
            $ret = array();
            foreach($data as $d){
                array_push($ret, array("value"=>$d));
            }
           return $ret; 
        }
    }
    
        /**
     * @see Object_Class_Data::getDataForQueryResource
     * @param string $data
     * @param null|Object_Abstract $object
     * @return string
     */
    public function getDataForQueryResource($data, $object = null) {
        $dbTable = new Tagfield_Tagfield;
        $dbTable->setTags(strtolower($this->getName()), $data);
        if(!empty($data) && is_array($data)) {
            return ",".implode(",",$data).",";
        }
        return;
    }


    
   
}
