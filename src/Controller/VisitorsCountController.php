<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class VisitorsCountController extends AbstractController
{
    //https://stackoverflow.com/questions/15943780/how-to-get-list-of-all-routes-of-a-controller-in-symfony2
    /**
     * @Route("/visitor", name="routeChecker")
     * @param Request $request
     * @return Response
     */
    public function routesChecker(Request $request):Response
    {
        if (in_array(self::currentRoute($request), self::getAllRouters())) {
            $msg = ("this route : ". self::currentRoute($request) ." exist");
        } else {
            $msg = ("this route not exist");
        }

        return $this->render('routeChecker/index.html.twig',[
            'msg' => $msg
        ]);
//        return new JsonResponse(['msg' => $msg]);
    }

    /**
     * @return array
     */
    public function getAllRouters(): array
    {
        $AppRoute=[];
        // retrieve project routes
        $routeCollection = $this->container->get('router')->getRouteCollection();
        foreach ($routeCollection as $RouteName => $RouteDetails) {
            $AppRoute[] = $RouteName;
        }
        return $AppRoute;
    }

    /**
     * @param $request
     * @return string
     * Function return the current page route
     */
    public function currentRoute($request):string
    {
        // 1st method to get Current route
        return  $request->attributes->get('_route');

        // 2nd method to get Current route
        //return $currentRouteName = $this->get("router")->match($request->getPathInfo())['_route'];
    }

}
