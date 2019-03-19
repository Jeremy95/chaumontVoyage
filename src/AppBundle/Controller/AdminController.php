<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use AppBundle\Form\AccueilType;
use AppBundle\Form\AutocarsTtiType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $accueilPage = $em->getRepository('AppBundle:Page')->findOneByName('accueil');
        $autocarsTtiPage = $em->getRepository('AppBundle:Page')->findOneByName('autocars-tti');

        if (null === $accueilPage) {
            $accueilPage = new Page();
        }

        if (null === $autocarsTtiPage) {
            $autocarsTtiPage = new Page();
        }

        $content = $accueilPage->getContent();
        $contentImages = $accueilPage->getImageContent();

        $autocarsTtiContent = $autocarsTtiPage->getContent();
        $autocarsTtiContentImages = $autocarsTtiPage->getImageContent();

        if ($contentImages !== null) {
            foreach ($contentImages as $key => &$image) {
                $splFile = new \SplFileInfo(realpath($image));
                if ($splFile->isFile()) {
                    $file = new File(realpath($image));
                    $image = $file;
                    unset($file);
                } else {
                    continue;
                }
            }
        }

        if ($autocarsTtiContentImages !== null) {
            foreach ($autocarsTtiContentImages as $key => &$image) {
                $splFile = new \SplFileInfo(realpath($image));
                if ($splFile->isFile()) {
                    $file = new File(realpath($image));
                    $image = $file;
                    unset($file);
                } else {
                    continue;
                }
            }
        }

        if ($contentImages !== null && $content !== null) {
            $arrayAccueil = array_merge($content, $contentImages);
        } else {
            $arrayAccueil = [];
        }

        if ($autocarsTtiContentImages !== null && $autocarsTtiContent !== null) {
            $arrayAutocarsTti = array_merge($autocarsTtiContent, $autocarsTtiContentImages);
        } else {
            $arrayAutocarsTti = [];
        }

        $formAccueil = $this->createForm(AccueilType::class, $arrayAccueil);
        $formAutocarsTti = $this->createForm(AutocarsTtiType::class, $arrayAutocarsTti);
        $formAccueil->handleRequest($request);
        $formAutocarsTti->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($formAccueil->isSubmitted() && $formAccueil->isValid()) {
                $data = $formAccueil->getData();
                $dataImages = $accueilPage->getImageContent();
                foreach ($data as $key => $datum) {
                    if ($datum instanceof UploadedFile) {
                        $dataImages[$key] = sha1(uniqid(mt_rand(), true)) . '.' . $datum->guessExtension();
                        $datum->move(__DIR__ . '/../../../web/images/upload/accueil/', $dataImages[$key]);
                        $dataImages[$key] = __DIR__ . '/../../../web/images/upload/accueil/' . $dataImages[$key];

                        unset($data[$key]);
                    }
                }

                $accueilPage->setContent($data);
                $accueilPage->setImageContent($dataImages);
                $accueilPage->setName('accueil');

                $em->persist($accueilPage);
                $em->flush();
            }

            if ($formAutocarsTti->isSubmitted() && $formAutocarsTti->isValid()) {
                $data = $formAutocarsTti->getData();
                $dataImages = $autocarsTtiPage->getImageContent();
                foreach ($data as $key => $datum) {
                    if ($datum instanceof UploadedFile) {
                        $dataImages[$key] = sha1(uniqid(mt_rand(), true)) . '.' . $datum->guessExtension();
                        $datum->move(__DIR__ . '/../../../web/images/upload/autocars-tti/', $dataImages[$key]);
                        $dataImages[$key] = __DIR__ . '/../../../web/images/upload/autocars-tti/' . $dataImages[$key];

                        unset($data[$key]);
                    }
                }

                $autocarsTtiPage->setContent($data);
                $autocarsTtiPage->setImageContent($dataImages);
                $autocarsTtiPage->setName('autocars-tti');

                $em->persist($autocarsTtiPage);
                $em->flush();
            }
        }

        $render = [
            'formAccueil' => $formAccueil->createView(),
            'formAutocarsTti' => $formAutocarsTti->createView(),
            'accueilPage' => $accueilPage,
            'autocarsTtiPage' => $autocarsTtiPage
        ];

        return $render;
    }

}
