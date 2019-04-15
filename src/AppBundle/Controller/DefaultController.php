<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Filesystem\Filesystem;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/soap", name="soap-test")
     */
    public function soapAction(Request $request)
    {
        $filesystem = new Filesystem();
        $wsdl_url = "../web/soap/";
        $wsdl_file = "DDRService.wsdl";

        try {
            $result = $filesystem->exists($wsdl_url);
            var_dump($result);
            if ($result) {
                $generator = new \Wsdl2PhpGenerator\Generator();
                $generator->generate(
                    new \Wsdl2PhpGenerator\Config(array(
                        'inputFile' => $wsdl_url.$wsdl_file,
                        'outputDir' => '/tmp/output'
                    ))
                );
            }
        } catch (Exception $exception) {
            echo "An error occurred: ".$exception;
        }

        die();
    }
}
