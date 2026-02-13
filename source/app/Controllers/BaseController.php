<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Banners;
use App\Models\Surveys;
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

        // $bannerModel = new \App\Models\BannerModel();
        // $surveyModel = new \App\Models\ServeyModel();
        // // 全ビューで $commonBanners として使えるように注入
        // $this->commonData = [
        //     'headerBannersPc' => $bannerModel->where('place', 'top_pc')->findAll(),
        //     'headerBannersSp' => $bannerModel->where('place', 'top_sp')->findAll(),
        //     'headerBannersRight' => $bannerModel->where('place', 'right_column')->findAll(),
        //     'headerBannersRenderShop' => $bannerModel->where('place', 'render_shop')->findAll(),
        //     'published_servey' => $surveyModel->where('is_published', 1)->first(),
        //     'siteTitle'     => '人妻レンタル公式',
        // ];
    }
}
