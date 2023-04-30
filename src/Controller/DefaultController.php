<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\HttpFoundation\File\Exception\FileException;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $em): Response
    {
        $products = $em->getRepository(Product::class)->findAll();

        
        return $this->render('default/index.html.twig', [
            'products' => $products, //Envoie de la variable $products à la vue

        ]);
    }

    #[Route('/product/{id}', name: 'show')]
    public function product(int $id, ProductRepository $repo): Response{
    
        $product = $repo->find($id);
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }
    /*
    #[Route('/cart/{id}', name: 'productAdded')]
    public function addProductInCart(Product $product, EntityManagerInterface $em):Response{
        if($product){
                 //Je vérifie qu'un utilisateur existe
                 $user = $this->getUser();
        if(!$user){
            return $this->redirectToRoute('app_login');
        }else{
            $user_id = $user->getId();
            

            $cart = $em ->getRepository(Cart::class)->findActiveCart($user_id);
            
            if($cart){
                    //Si le prod existe déjà dans le panier (fonction dans repo)
                    //alors on ajoute à la quantité
                    //Sinon on créé un content cart avec le produit
            }else{
                //on créé un panier (fonction dans repo)
                //On créé un content_cart
                //On met à jour le content cart product 
            }
            //On calcul le prix du panier
            //Calcul du nombre d'articles du panier
            //return value
         }

        }else{
            //flash
        }
        return $new Response{
            $create
        };
    }*/
    //Je vérifie qu'aucun panier existe déjà pour cet utilisateur
}
