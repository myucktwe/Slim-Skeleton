<?php
declare(strict_types=1);

namespace App\Application\Actions\Home;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;

class HomeAction extends Action
{
    private $view;

    /**
     * @param LoggerInterface $logger
     * @param Twig  $twig
     */
    public function __construct(LoggerInterface $logger, Twig $twig)
    {
        parent::__construct($logger);
        $this->view = $twig;
    }

    protected function action(): Response
    {
        $viewData = [
            'now' => date('Y-m-d H:i:s'),
        ];
        return $this->view->render(
            $this->response,
            'home/home.twig',
            $viewData
        );
    }
}
