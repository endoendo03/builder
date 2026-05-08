<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Site extends BaseConfig
{
    // サイトの基本情報
    public $siteName   = '人妻生レンタル';
    public $branchName = '仙台店';
    public $mainArea   = '仙台';
    
    // SEO用のデフォルト設定
    public $defaultDescription = "'仙台周辺の出張人妻レンタル「人妻生レンタル仙台店」。厳選された人妻キャストが極上の癒やしをお届けします。市外への出張もご相談ください。";
    
    // お問い合わせ先など（今後増えてもここで一括管理）
    public $infoEmail  = 'info@namaren-sendai.com';

    public $pureloversShopId = '';
}