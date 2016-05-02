<?php
namespace app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Events\LogUserAction;


class AdminController extends Controller
{
    /**
     *  Segment model
     *
     * @var $model
     */
    protected $model;

    public $pagesize = 10;
    protected $viewEditDelIcon = 'admin.partials.table.edit-del-icon';    
    protected $viewApprovedIcon = 'admin.partials.table.approved-icon';
    protected $viewNormalLink = 'admin.partials.table.normal-link';
    protected $viewForm = 'admin.form.container';
    protected $viewIndex = 'admin.table.container';
    protected $viewShow = 'admin.show.container';
    protected $indexRoute = '';
    protected $createRoute = '';
    protected $editRoute = '';
    protected $pluralTitle = '';
    protected $menu = [];
    protected $failConnectCusDBMSg = 'Can not connect to database of customer';
    protected $successUpdatedMsg = 'Updated Sucessfully!';
    protected $successStoredMsg = 'Created Sucessfully!';
    protected $successDeletedMsg = 'Deleted Sucessfully!';
    protected $redisKeyItem = '';

    public function __construct()
    {
        $this->setIndexRoute();
        $this->setCreateRoute();
        $this->setEditRoute();
        $this->setViewShow();
        $this->setMenu();

        view()->share('indexRoute', $this->getIndexRoute());
        view()->share('createRoute', $this->getCreateRoute());
        view()->share('editRoute', $this->getEditRoute());
        view()->share('pluralTitle', $this->pluralTitle);
        view()->share('menu', $this->getMenu());

        if (count($_REQUEST) > 0) {
            $data = $_REQUEST;
            $data['REQUEST_URI'] = $_SERVER['REQUEST_URI'];
        }
    }

    protected function getIndexRoute()
    {
        return $this->indexRoute;
    }

    protected function setIndexRoute()
    {
        $this->indexRoute = 'admin::'.$this->indexRoute;
    }

    protected function getCreateRoute()
    {
        return $this->createRoute;
    }

    protected function setCreateRoute()
    {
        $this->createRoute = 'admin::'.$this->createRoute;
    }

    protected function getEditRoute()
    {
        return $this->editRoute;
    }

    protected function setEditRoute()
    {
        $this->editRoute = 'admin::'.$this->editRoute;
    }

    protected function setViewShow()
    {
        $action = app('request')->route()->getAction();

        $controller = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controller);

        $this->viewShow = sprintf('admin.%s.'.$action, str_replace('Controller', '', $controller));
    }

    protected function getViewShow()
    {
        return $this->getViewShow();
    }

    protected function setMenu()
    {
        $action = app('request')->route()->getAction();
        $controller = class_basename($action['controller']);
        list($controller, $action) = explode('@', $controller);

        $this->menu = [
            [
                'link' => '/admin',
                'label' => 'Dashboard',
                'icon' => 'fa-dashboard',
                'isActive' => $controller == 'DashboardController',
            ],
            [
                'link' => route('admin::users'),
                'label' => 'Users',
                'icon' => 'fa-user',
                'isActive' => $controller == 'UserController' || $controller == 'MediumController' || $controller == 'SourceController',
            ],            
            [
                'link' => '/',
                'label' => 'Front End',
                'icon' => 'fa-backward',                
            ],  
            [
                'link' => '/admin/logout',
                'label' => 'Logout',
                'icon' => 'fa fa-lock',                            
            ],
        ];
    }

    protected function getMenu()
    {
        return $this->menu;
    }
}
