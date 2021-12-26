<?php

use DebugBar\DebugBar;
use DebugBar\StandardDebugBar;
use DebugBar\DataCollector\PDO\PDOCollector;
use Junker\DebugBar\Bridge\SmartyCollector;

class DebugBarHelper extends Instanceable {

    private DebugBar $debugBar;

    /**
     * Enable the PHPDebugBar + add the PDO Collector
     */
    public function enable(Smarty $smarty) {
        $debugbar = new StandardDebugBar();

        $pdoCollector = new PDOCollector(DB::getInstance()->getPDO());
        $pdoCollector->setRenderSqlWithParams(true, '``');
        $debugbar->addCollector($pdoCollector);

        $smartyCollector = new SmartyCollector($smarty);
        $debugbar->addCollector($smartyCollector);

        $this->debugBar = $debugbar;
    }

    public function getDebugBar(): DebugBar {
        return $this->debugBar;
    }

}