<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Banners;
use App\Models\Surveys;
use App\Models\SettingModel;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;
    protected $settings;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);
        
        $settingModel = new \App\Models\SettingModel();
        $dbSettings = $settingModel->getKeyValuePairs();

        $defaultSettings = [
            'shop_name' => '人妻レンタル NTR 仙台店',
            'shop_tel'  => '022-722-6166',
            'display_attendance' => '0',
            'display_raw_video'  => '0',
        ];

        // DBの設定をデフォルト値に上書き合体させる
        $this->settings = array_merge($defaultSettings, $dbSettings);

        \Config\Services::renderer()->setVar('site_settings', $this->settings);
    }
}
