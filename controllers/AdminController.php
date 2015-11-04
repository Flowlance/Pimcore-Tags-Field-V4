<?php
class Tagfield_AdminController extends \Pimcore\Controller\Action\Admin {
    
    public function init(){
        parent::init();
    }
    
    public function gettagsAction() {
       $key = strtolower($this->_getParam("key"));
       $query = trim($this->_getParam("query"));
       $start = intval($this->_getParam("start"));
       $limit = intval($this->_getParam("limit"));
       $limit = (!$limit || $limit == 0) ? false : $limit;

       $table = new Tagfield_Tagfield();
       $tags = $table->getTagsByKey($key, $query, $start, $limit);

       $data = array();
       foreach($tags as $tag){
           $data[]=array("value"=>$tag["tag"]);
       }
       $this->_helper->json(array("tags"=>$data));
    }
    
}
?>
