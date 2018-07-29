<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Page;
use AppBundle\Form\AccueilType;
use AppBundle\Form\AutocarsTtiType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Finder\SplFileInfo;
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
        if (null === $accueilPage) {
            $accueilPage = new Page();
        }

        $content = $accueilPage->getContent();
        $contentImages = $accueilPage->getImageContent();
        foreach ($contentImages as $key => &$image) {
                $splFile = new \SplFileInfo(realpath($image));
                if ($splFile->isFile()) {
                    $file = new File(realpath($image));
                    $image = $file;
                    $pathsName = [$key => $file->getPathname()];
                    unset($file);
                } else {
                    continue;
                }
        }
        $arrayAccueil = array_merge($content, $contentImages);

        $formAccueil = $this->createForm(AccueilType::class, $arrayAccueil);
        $formAutocarsTti = $this->createForm(AutocarsTtiType::class);
        $formAccueil->handleRequest($request);

        if ($request->isMethod('POST')) {
            if ($formAccueil->isSubmitted() && $formAccueil->isValid()) {
                $data = $formAccueil->getData();
                $dataImages = $accueilPage->getImageContent();
                if ($data['imageOne'] instanceof UploadedFile) {
                    $dataImages['imageOne'] = sha1(uniqid(mt_rand(), true)) . '.' . $data['imageOne']->guessExtension();
                    $data['imageOne']->move(__DIR__ . '/../../../web/images/upload/accueil/', $dataImages['imageOne']);
                    $dataImages['imageOne'] = __DIR__ . '/../../../web/images/upload/accueil/' . $dataImages['imageOne'];

                    unset($data['imageOne']);
                }

                if ($data['imageTwo'] instanceof UploadedFile) {
                    $dataImages['imageTwo'] = sha1(uniqid(mt_rand(), true)) . '.' . $data['imageTwo']->guessExtension();
                    $data['imageTwo']->move(__DIR__ . '/../../../web/images/upload/accueil/', $dataImages['imageTwo']);
                    $dataImages['imageTwo'] = __DIR__ . '/../../../web/images/upload/accueil/' . $dataImages['imageTwo'];

                    unset($data['imageTwo']);
                }

                $accueilPage->setContent($data);
                $accueilPage->setImageContent($dataImages);
                $accueilPage->setName('accueil');

                $em->persist($accueilPage);
                $em->flush();
            }
        }

        $render = [
            'formAccueil' => $formAccueil->createView(),
            'accueilPage' => $accueilPage
        ];

        return $render;
    }

}
