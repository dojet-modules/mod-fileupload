<?php
$__c = &Config::configRefForKeyPath('fileupload');

$__c['upload'] = array(
    C_RUNTIME_SD => '/data/upload/safe',
    C_RUNTIME_TJ => '/data/cdn/upload/safe',
    C_RUNTIME_SDTEST => '/data/upload/safe',
    C_RUNTIME_228 => '/home/leplus/upload/safe',
    );

$__c['link'] = array(
    C_RUNTIME_228 => '/home/leplus/filelink',
    );

$__c['cdn'] = array(
    C_RUNTIME_SDTEST => 'http://test.xui.lenovomm.com/upload/safe/',
    C_RUNTIME_TJ => 'http://cdn.zui.lenovomm.com/upload/safe/',
    C_RUNTIME_228 => 'http://10.100.149.158:8100/static/upload/safe/',
    );

unset($__c);
