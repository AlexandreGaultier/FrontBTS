<?php

namespace App\Controller;

use App\Entity\Vol;
use App\Entity\Billet;
use App\Entity\Aeroport;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RechercherVolController extends AbstractController
{
    /**
     * @Route("/rechercher/vol", name="rechercher_vol")
     */
    public function index()
    {
        return $this->render('rechercher_vol/index.html.twig', [
            'controller_name' => 'RechercherVolController',
        ]);
    }

     /**
     * @Route("/rechercher/vol/filtre", name="filtre_vol")
     */
    public function filtre_vol(RegistryInterface $doctrine)
    {


        //FAIRE IF POUR INITIALISER LES DATES/heures SI ELLES SONT PAS MISES 
        // dateDepart = dateTime. Nom
        // dateArrivee = date Depart + 15

        $con = $doctrine->getEntityManager()->getConnection();
        $sql = "
            SELECT flight.id, flight.date_depart, flight.date_arrivee, flight.place_eco, flight.place_premium, flight.place_business, 
            airportDepart.nom as nom_aeroport_depart, airportDepart.pays as pays_aeroport_depart, 
            airportArrivee.nom as nom_aeroport_arrivee, airportArrivee.pays as pays_aeroport_arrivee, 
            plane.place_eco as total_place_eco, plane.place_premium as total_place_premium, plane.place_business as total_place_business
            FROM vol flight
            JOIN aeroport airportDepart on airportDepart.id = flight.aeroport_depart_id
            JOIN aeroport airportArrivee on airportArrivee.id = flight.aeroport_arrivee_id
            JOIN avion plane on plane.id = flight.id_avion_id
            WHERE airportDepart.nom LIKE :inputAeroportDepart 
            AND airportArrivee.nom LIKE :inputAeroportArrivee
            AND date_depart > :inputDateetJourDepart
            AND date_arrivee < :inputDateetJourArrivee
        ";

        $stmt = $con->prepare($sql);
        $stmt->execute([
            'inputAeroportDepart' => "%".$_POST{'inputAeroportDepart'}."%",
            'inputAeroportArrivee' => "%".$_POST{'inputAeroportArrivee'}."%",
            'inputDateetJourDepart' => $_POST{'inputJourDepart'}." ".$_POST{'inputHeureDepart'},
            'inputDateetJourArrivee' => $_POST{'inputJourArrivee'}." ".$_POST{'inputHeureArrivee'}
            
        ]);

        $vols = $stmt->fetchAll();

        return $this->render('rechercher_vol/affichage_vols.html.twig', [
            'vols'=>$vols,
        ]);
    }

    /**
     * @Route("/reserver/billet/{id}", name="billet")
     */
    public function billet($id)
    {
        $repo = $this->getDoctrine()->getRepository(Vol::class);
        $vol = $repo->find($id);

        return $this->render('rechercher_vol/billet.html.twig', [
            'vol' => $vol
        ]);
    }

     /**
     * @Route("/achat/billet/{type}", name="achatBillet")
     */
    public function achatBillet($type,Request $request, ObjectManager $manager)
    {
        
        if($request->request->count() > 0){
            $billet = new Billet();
            $billet->setIdVol($request->request->get('idVol'))
                ->setTypePlace($request->request->get('typePlace'))
                ->setIdClient($request->request->get('idClient'))
                ->setPrix($request->request->get('prix'));

            $manager->persist($billet);
            $manager->flush();
        }

        return $this->render('accueil/accueil.html.twig', [
        ]);
    }
}
