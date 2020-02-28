<?php

namespace Classes\Extensions;

use \Classes\Core\ThemeClass as Theme;

class ThemeExtension extends Theme
{
    public function __construct()
    {
        parent::__construct();
        $this->initStyles();
    }
    public function initStyles()
    {
        $this->enqueueStyles(['bundle.css']);
        $this->enqueueScripts(['app.js']);
    }
}
