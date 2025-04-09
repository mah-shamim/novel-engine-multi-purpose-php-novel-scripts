<?php


namespace App\Router\Handlers;
use App\Admin\AdminConfig;
class AdminRoute
{
    protected $Controller;
    protected $Template;
    private $rooth;
    private $Public;
    private $header;
    private $footer;

    public function __construct()
    {
        global $rootpath, $controllerPath, $templatePath;
        $this->rooth = $rootpath;
        $this->Public = PUBLICPATH. "/admin/index.php";
        require_once $this->Public;
        AdminConfig::setPaths($controllerPath, $templatePath);
        require_once $this->rooth.'/config/init.php';
        $this->header = $templatePath.'/admin/header.php';
        $this->footer = $templatePath.'/admin/footer.php';
        $this->Controller = $controllerPath.'/admin/';
        $this->Template = $templatePath.'/admin/';
    }

    public function login()
    {
        return AdminConfig::login();
    }

    public function Subscribe() {
        return AdminConfig::subscribe();
    }

    public function Posts()
     {
        return AdminConfig::posts();
     }

    public function blogCats() 
    {
        view([$this->Controller.'blog-cats/index.php', $this->header, $this->Template.'blog-cats/index.php', $this->footer]);
    }

    public function blogComments() 
    {
        view([$this->Controller.'comments/index.php', $this->header, $this->Template.'comments/index.php', $this->footer]);
    }

    public function Payments() 
    {
        view([$this->Controller.'payments/index.php', $this->header, $this->Template.'payments/index.php', $this->footer]);
    }

    public function Notifications() 
    {
        view([$this->Controller.'notifications/index.php', $this->header, $this->Template.'notifications/index.php', $this->footer]);
    }

    public function instantIndexing() 
    {
        view([$this->Controller.'setting/indexapi.php', $this->header, $this->Template.'setting/indexapi.php', $this->footer]);
    }

    public function mailingSetting() 
    {
        view([$this->Controller.'setting/mail.php', $this->header, $this->Template.'setting/mail.php', $this->footer]);
    }

    public function Subscriptions() {
        AdminConfig::subscriptions();
    }

    public function Reviews() {
        AdminConfig::reviews();
    }

    public function LoginAjax()
    {
        return AdminConfig::loginAjax();
    }

    public function HandleLogin() {
        AdminConfig::HandleLogin();
    }

    public function Home() {
        Redirect(AdminURL."/dashboard");
    }

    public function Author() {
        AdminConfig::author();
    }

    public function Users() {
        AdminConfig::user();
    }

    public function Compiler() {
        AdminConfig::compiler();
    }

    public function Group() {
        AdminConfig::group();
    }

    public function Dashboard() {
        AdminConfig::dashboard();
    }

    public function Category() {
        AdminConfig::category();
    }

    public function Book() {
        AdminConfig::book();
    }

    public function Ebook() {
        AdminConfig::ebook();
    }

    public function Page() {
        AdminConfig::page();
    }

    public function Setting() {
        AdminConfig::setting();
    }

    public function Profile() {
        AdminConfig::profile();
    }
    
        public function Meta() {
        AdminConfig::meta();
    }
    
          public function Adscode() {
        AdminConfig::adscode();
    }

    public function Adstxt()
    {
        view([$this->Controller.'setting/adstxt.php',$this->header, $this->Template.'setting/adstxt.php', $this->footer]);
    }

    public function Package() {
        AdminConfig::package();
    }
    
        public function Error() {
        
        global $templatePath;
        $path = $templatePath.'/admin/error.php';
        $title = "Error Page";
        view([$this->header, $path, $this->footer], ['title' => $title]);
    }

    public function process($slug) {
        global $controllerPath;
        $path = $controllerPath.'/admin/'.$slug.'/process.php';
        if(file_exists($path)) {
            view($path);
        } else {
            echo "none";
        }
    }

    public function HandleAjax() {
        global $controllerPath;
        $path = $controllerPath.'/admin/Handle/ajax.php';
            view($path);
    }
}
 