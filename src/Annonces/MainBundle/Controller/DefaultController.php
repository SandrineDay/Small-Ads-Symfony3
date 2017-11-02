<?php

namespace Annonces\MainBundle\Controller;

use Annonces\MainBundle\Entity\ad;
use Annonces\MainBundle\Entity\answer;
use Annonces\MainBundle\Entity\category;
use Annonces\MainBundle\Entity\picture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Annonces\MainBundle\Form\FormHandler;

class DefaultController extends Controller
{
    public function indexAction(){
        $annonces = $this->get('doctrine')
            ->getRepository(ad::class)
            ->findAllAnnonces();
        $categories = [];
        $categories = $this->get('doctrine')
            ->getRepository(category::class)
            ->findAllCategories();
        $annonces = ['annonces' => $annonces, 'categories' => $categories];
        return $this->render('AnnoncesMainBundle:Default:index.html.twig', $annonces);
    }

    public function listeAnnoncesParCategorieAction(category $category){
        $datas=[];
        $categories = $this->get('doctrine')
            ->getRepository(category::class)
            ->findAllCategories();
        $annonces = $this->get('doctrine')->getRepository("AnnoncesMainBundle:ad")->findAllAnnoncesByCateg($category);
        $datas = ['annonces'=>$annonces,'categories'=>$categories];
        return $this->render('AnnoncesMainBundle:Default:index.html.twig', $datas);
//        return $this->render('AnnoncesMainBundle:Default:indexcateg.html.twig', $datas);
    }

    public function detailsAction(ad $ad, Request $request){
        $datas = [];
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder($datas, array(
            'csrf_protection' => false,
        ))
            ->add('email',EmailType::class, array('label'=>'Votre email'))
            ->add('name', TextType::class, array('label'=>'Votre nom'))
            ->add('firstname', TextType::class, array('label'=>'Votre prénom'))
            ->add('phone', TextType::class, array('label'=>'Votre téléphone'))
            ->add('message',TextareaType::class,array('label'=>'Votre message'))
            ->add('valider',SubmitType::class, array('attr'=>array('class'=>'btn btn-primary pull-right')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $datas = $form->getData();

            $answer = new answer();
            $answer->setEmail($datas['email']);
            $answer->setName($datas['name']);
            $answer->setFirstname($datas['firstname']);
            $answer->setPhone($datas['phone']);
            $answer->setMessage($datas['message']);
            $answer->setAd($ad);

            $em->persist($answer);
            $em->flush();
            $this->addFlash('success', "Votre message a bien été enregistré");
            return $this->redirect($this->generateUrl('annonces_main_homepage'));
        }
        $datas = array('annonce'=>$ad,'form' => $form->createView());

        return $this->render('AnnoncesMainBundle:Default:details.html.twig', $datas);
    }

    public function creationAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $datas = array();
        $form = $this->createFormBuilder($datas, array(
            'csrf_protection' => false,
        ))
            ->add('title',TextType::class, array('label'=>'Titre'))
            ->add('description', TextareaType::class, array('label'=>'Description'))
            ->add('price', NumberType::class, array('label'=>'Prix'))
            ->add('category',EntityType::class,array('class'=>'Annonces\MainBundle\Entity\category','choice_label'=>'name','multiple'=>true,'expanded'=>true,'label'=>'Catégorie'))
            ->add('pictures',FileType::class, array('label'=>"Téléchargez une ou plusieurs photo(s)",'multiple'=>true))
//            ->add('main', ChoiceType::class, array('label'=>'image principale ?','choices' => array(
//                    'Yes' => true,
//                    'No' => false),'expanded'=>true, 'multiple'=>false))
            ->add('valider',SubmitType::class, array('attr'=>array('class'=>'btn btn-primary pull-right')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $datas = $form->getData();

            $ad = new ad();
            $ad->setTitle($datas['title']);
            $ad->setDescription($datas['description']);
            $ad->setPrice($datas['price']);
            $nb_categ = count($datas['category']);
            for ($i = 0; $i < $nb_categ; $i++) {
                $ad->addCategory($datas['category'][$i]);
                $em->persist($ad);
            }

            $nb_pic = count($datas['pictures']);
            for ($i = 0; $i < $nb_pic; $i++) {
                $picture = $datas['pictures'][$i];
                $filename = $picture->getClientOriginalName();
                $picture->move('uploads',$filename);
                                $picture = new picture();
                $picture->setPath('uploads/'.$filename);
                $picture->setAd($ad);
                if ($i == 0){
                    $picture->setMain(true);
                }else{
                    $picture->setMain(false);
                }
                $em->persist($picture);
            }

            $em->flush();
            $this->addFlash('success',"L'annonce a bien été ajoutée");
            return $this->redirect($this->generateUrl('annonces_main_homepage'));
        }
//        else {
//            $this->addFlash('warning', "Un problème est survenu lors de l'ajout de l'annonce !");
//            return $this->redirect($this->generateUrl('annonces_main_homepage'));
//        }
//        $datas = $form->createView();
        $datas = array('form' => $form->createView());

        return $this->render('AnnoncesMainBundle:Default:creation.html.twig',$datas);
//        return $this->render('AnnoncesMainBundle:Default:creation.html.twig', array('form' => $form->createView()));
//        return $this->render('FabMainBundle:Default:index.html.twig', array('title'=>$title,  'form' => $form->createView()));
    }

    public function reponseAction(Request $request){
        $em = $this->getDoctrine()->getManager();
        $datas = [];
        $form = $this->createFormBuilder($datas, array(
            'csrf_protection' => false,
        ))
            ->add('email',EmailType::class, array('label'=>'Votre email'))
            ->add('name', TextType::class, array('label'=>'Votre nom'))
            ->add('firstname', TextType::class, array('label'=>'Votre prénom'))
            ->add('phone', TextType::class, array('label'=>'Votre téléphone'))
            ->add('message',TextareaType::class,array('label'=>'Votre message'))
            ->add('valider',SubmitType::class, array('attr'=>array('class'=>'btn btn-primary pull-right')))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $datas = $form->getData();

            $answer = new answer();
            $answer->setEmail($datas['email']);
            $answer->setName($datas['name']);
            $answer->setFirstname($datas['firstname']);
            $answer->setPhone($datas['phone']);
            $answer->setMessage($datas['message']);

            $em->persist($answer);
            $em->flush();
            $this->addFlash('success', "Votre message a bien été enregistré");
            return $this->redirect($this->generateUrl('annonces_main_homepage'));
        }
        $datas = array('form' => $form->createView());
        return $this->render('@AnnoncesMain/Default/details.html.twig',$datas);
    }

    private function checkAuthorization($instance){
        // Return true si le user est admin
        if ($this->get('security.authorization_checker')
            ->isGranted('ROLE_ADMIN')){
            return true;
        }
        // Return true si le user est proprio
        elseif ($this->getUser() == $instance){
            return true;
        }
        // Return false vers uri si le user n'est pas autorisé
        else {
            return false;
        }

    }
}
