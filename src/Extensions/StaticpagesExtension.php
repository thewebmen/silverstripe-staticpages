<?php

namespace TheWebmen\Staticpages\Extensions;

use SilverStripe\ORM\DataExtension;
use TheWebmen\Staticpages\Controllers\StaticpagesController;

class StaticpagesExtension extends DataExtension {

    public function onAfterWrite()
    {
        parent::onAfterWrite();
        $url = $this->owner->AbsoluteLink();
        $controller = new StaticpagesController();
        $controller->removeCacheForURL($url);
        if (method_exists($this->owner, 'urlsAffectedByThisPage') && $urls = $this->owner->urlsAffectedByThisPage()) {
            foreach($urls as $url){
                $controller->removeCacheForURL($url);
            }
        }
    }

}
