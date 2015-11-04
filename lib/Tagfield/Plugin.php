<?php

namespace Tagfield;

use Pimcore\API\Plugin as PluginLib;

class Plugin extends PluginLib\AbstractPlugin implements PluginLib\PluginInterface {

    public function init() {

        parent::init();
    }

    public function handleDocument ($event) {
        $document = $event->getTarget();
    }

    public static function install (){
        $db = \Pimcore\Resource\Mysql::get();
        $db->query("CREATE TABLE IF NOT EXISTS `plugin_tagfield` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `key` varchar(255) DEFAULT NULL ,
        `tag` varchar(255) DEFAULT NULL ,
              PRIMARY KEY  (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

        if (self::isInstalled()) {
            $statusMessage = "Tagfield Plugin successfully installed.";
        } else {
            $statusMessage = "Tagfield Plugin could not be installed";
        }

        return $statusMessage;
    }
    
    public static function uninstall (){
        $db = \Pimcore\Resource\Mysql::get();
        $db->query("DROP TABLE `plugin_tagfield`");

        if (!self::isInstalled()) {
            $statusMessage = "Tagfield Plugin successfully uninstalled.";
        } else {
            $statusMessage = "Tagfield Plugin could not be uninstalled";
        }
        return $statusMessage;
    }

    public static function isInstalled () {
        $result = self::tableExists("plugin_tagfield");

        return!empty($result);
    }

    public static function getJsClassName() {
        return ""; //pimcore.plugin.customerDb";
    }

    public static function needsReloadAfterInstall(){
        return true;
    }

    public static function getTranslationFile($language) {
        if(file_exists(PIMCORE_PLUGINS_PATH . "/Tagfield/texts/" . $language . ".csv")){
            return "/Tagfield/texts/" . $language . ".csv";
        }

        return "/Tagfield/texts/en.csv";
    }

    public static function tableExists($table) {
        $table_ok = false;
        try {
            $db = \Pimcore\Resource\Mysql::get();
            $select = $db->query("SHOW TABLES")->fetchAll();
            
            if($select && is_array($select)) {
                foreach($select as $k => $tb) {
                    $v = reset($tb);
                    if($v == $table) {
                        $table_ok = true;
                        break;
                    }
                }
            }
        } catch(Exception $e) {
            $table_ok = false;
        }
        
        return $table_ok;
    }
}