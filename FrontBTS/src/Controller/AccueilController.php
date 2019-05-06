<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Repository\VolRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(Request $request, ObjectManager $manager)
    {
        if($request->request->count() > 0){
            $vol = new Vol();
            $vol->setAeroportDepart($request->request->get('aeroportDepart'))
                ->setAeroportArrivée($request->request->get('aeroportArrivée'))
                ->setdateDepart($request->request->get('dateDepart') + $request->request->get('heureDepart'))
                ->setdateArrivée($request->request->get('dateArrivée'))
                ->setplaceEco($request->request->get('placeEco'))
                ->setplacePremium($request->request->get('placePremium'))
                ->setplaceBusiness($request->request->get('placeBusiness'));

            $manager->persist($vol);
            $manager->flush();
        }

        return $this->render('accueil/accueil.html.twig', [
        ]);
    }

    /**
     * @Route("/recherche", name="rechercheVol")
     */
    public function rechercheVol()
    {
        return $this->render('accueil/rechercheVol.html.twig', [
        ]);
    }

     /**
     * @Route("/billets", name="voirBillets")
     */
    public function VoirBillets()
    {
        return $this->render('accueil/voirBillets.html.twig', [
        ]);
    }

     /**
     * @Route("/achat", name="acheterBillets")
     */
    public function réserverBillets()
    {
        return $this->render('accueil/acheterBillets.html.twig', [
        ]);
    }
}
