<?php
// application/controllers/Produits.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produits extends CI_Controller 
{

    public function liste()
    {   
        
      // Chargement du modèle 'produitsModel'
    $this->load->model('produitsModel');
    
    /* On appelle la méthode ajouter() du modèle,
    * qui retourne le tableau de résultat ici affecté dans la variable $categories (un tableau) 
    *      
    */
    $aListe = $this->produitsModel->liste();
    // Ajoute des résultats de la requête au tableau des variables à transmettre à la vue   
    $aView["liste_produits"] = $aListe;

    // Appel de la vue avec transmission du tableau  
    
    $this->load->view('liste', $aView);
    } 



    public function ajouter()
{
    // Chargement du modèle 'produitsModel'
    $this->load->model('produitsModel');
    
    /* On appelle la méthode ajouter() du modèle,
    * qui retourne le tableau de résultat ici affecté dans la variable $categories (un tableau) 
    *      
    */
    $categories = $this->produitsModel->ajouter();
 // Chargement de la librairie 'database'
 $aView['categories']=$categories;
    if ($this->input->post()) 
 { // 2ème appel de la page: traitement du formulaire

    $data = $this->input->post();

// Définition des filtres

$config = array(
    array(
            'field' => 'pro_ref',
            'label' => 'Référence',
            'rules' => 'trim|required|min_length[4]|max_length[10]|alpha_numeric',
            'errors' => array(
                            'required' => 'Le %s est obligatoire.',
                            'min_length' => 'Le %s doit avoir longueur minimum de 4 caractères.',
                            'max_length' =>'Le %s doit avoir longueur maximum de 10 caractères.',
                            'alpha_numeric'=>'Le %s doit doit contenir que des lettres et des chiffres'
                            ),
            ),
    
    array(
        'field' => 'pro_cat_id',
        'label' => 'Catégorie',
        'rules' =>  'required',
        'errors' => array(
                        'required' => 'Le %s est obligatoire.'
                        ),
            ),
    array(
        'field' => 'pro_libelle',
        'label' => 'Libellé',
        'rules' => 'trim|required|min_length[4]|max_length[30]|alpha_numeric',
        'errors' => array(
                        'required' => 'Le %s est obligatoire.',
                        'min_length' => 'Le %s doit avoir longueur minimum de 4 caractères.',
                        'max_length' =>'Le %s doit avoir longueur maximum de 10 caractères.',
                        'alpha_numeric'=>'Le %s doit doit contenir que des lettres et des chiffres'
                        ),
            ),
    array(
        'field' => 'pro_description',
        'label' => 'Description',
        'rules' => 'trim|min_length[4]|max_length[1000]|alpha_numeric',
        'errors' => array(
                        'min_length' => 'Le %s doit avoir longueur minimum de 4 caractères.',
                        'max_length' =>'Le %s doit avoir longueur maximum de 10 caractères.',
                        'alpha_numeric'=>'Le %s doit doit contenir que des lettres et des chiffres'
                        ),
            ),
    array(
        'field' => 'pro_prix',
        'label' => 'Prix',
        'rules' => 'trim|required|decimal',
        'errors' => array(
                        'required' => 'Le %s est obligatoire.',
                        'decimal'=>'Le %s doit avoir que des décimaux'
                        ),
            ),
    array(
        'field' => 'pro_stock',
        'label' => 'Stock',
        'rules' => 'trim|required|integer',
        'errors' => array(
            'required' => 'Le %s est obligatoire.',
            'decimal'=>'Le %s doit avoir que des entiers'
                        ),
            ),
    
    array(
            'field' => 'pro_couleur',
            'label' => 'Couleur',
            'rules' => 'trim|required|min_length[2]|max_length[30]|alpha_numeric',
            'errors' => array(
                    'required' => 'Le %s est obligatoire.',
                    'min_length' => 'Le %s doit avoir longueur minimum de 4 caractères.',
                    'max_length' =>'Le %s doit avoir longueur maximum de 30 caractères.',
                    'alpha_numeric'=>'Le %s doit doit contenir que des lettres et des chiffres'
            ),
        ),
    
    array(
        'field' => 'pro_bloque',
        'label' => 'Bloquer',
        'rules' => 'trim|required|min_length[3]|max_length[3]|alpha_numeric',
        'errors' => array(
            'required' => 'Le %s est obligatoire.',
            'min_length' => 'Le %s doit avoir longueur minimum de 4 caractères.',
            'max_length' =>'Le %s doit avoir longueur maximum de 10 caractères.',
            'alpha_numeric'=>'Le %s doit doit contenir que des lettres et des chiffres'
    ),
)

);

$this->form_validation->set_rules($config);

// Affichage des erreurs

$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 

if ($this->form_validation->run() == FALSE)
{ // Echec de la validation, on réaffiche la vue formulaire 

    $this->load->view('ajouter',$aView);
}
else
{ 
    
    
    /* 
         * Avant d'enregistrer en base de données, il nous faut 
         * récupérer l'extension du fichier 
         */  

         // On extrait l'extension du nom du fichier,
         // on utilise la variable PHP superglobale $_FILES    
        if ($_FILES) 
        {
            // On extrait l'extension du nom du fichier 
            // Dans $_FILES["pro_photo"], pro_photo est la valeur donnée à l'attribut name du champ de type 'file'  
            $extension = substr(strrchr($_FILES["fichier"]["name"], "."), 1);
        }

        /*
         * On a l'extension du fichier donc on peut enregistrer
         * en base de données 
         */
    

          // Ajout d'une date d'ajout que le formulaire ne contient pas
            $data["pro_d_ajout"] = date("Y-m-d h:i:s");

            $data["pro_photo"] =$extension;

         // Transformation d'une information venant du formalaire
         // par exemple forcer la référence d'un produit en majuscules
            $pro_ref = $this->input->post("pro_ref");
            $data["pro_ref"] = strtoupper($pro_ref);
            
            $this->db->insert('produits', $data);

        /*
         * Pour créer le nom du fichier : il faut récupérer la clé primaire (pro_id) : 
         * - dans le cas du formulaire d'ajout : il faut récupérer avec la méthode $this-db->InsertId();
         * - dans le cas du formulaire de modification : on récupère le pro_id passé dans un champ de type hidden     
         */

         // On créé un tableau de configuration pour l'upload
         $config['upload_path'] = './assets/images/'; // chemin où sera stocké le fichier

         // nom du fichier final
        $pro_id=$this->db->insert_id();
        $config['file_name'] = $pro_id.'.'.$extension; 

         // On indique les types autorisés (ici pour des images)
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; 

         // On charge la librairie 'upload'
        $this->load->library('upload');

         // On initialise la config 
        $this->upload->initialize($config);

         // La méthode do_upload() effectue les validations sur l'attribut HTML 'name' ('fichier' dans notre formulaire) et si OK renomme et déplace le fichier tel que configuré
        if ( ! $this->upload->do_upload('fichier')) 
        {
            // Echec : on récupère les erreurs dans une variable (une chaîne)
            $errors = $this->upload->display_errors();    

          // on réaffiche la vue du formulaire en passant les erreurs 
            $aView["errors"] = $errors;

            // Echec,  on réaffiche le formulaire
            $this->load->view('ajouter',$aView);
        }
        else
         { // Succès, on redirige sur la liste 
            redirect('produits/liste');
        }
    }
    }
    else 
 { // 1er appel de la page: affichage du formulaire
    $this->load->view('ajouter',$aView);
    }
} // -- ajouter()



public function detail ($id){

    // Chargement de la librairie 'database'
    $this->load->database();  

    // Requête de sélection de l'enregistrement souhaité, ici le produit 7 
    $produit = $this->db->query("SELECT * FROM produits WHERE pro_id= ?", $id);
    $aView["produit"] = $produit->row() ; // première ligne du résultat
            
   $this->load->view('detail', $aView);
    
 } 


public function modifier($pro_id)
{
    

    // Chargement de la librairie 'database'
    $this->load->database();  

    // Requête de sélection de l'enregistrement souhaité, ici le produit 7 
    $produit = $this->db->query("SELECT * FROM produits WHERE pro_id= ?", $pro_id);
    $aView["produit"] = $produit->row(); // première ligne du résultat
    $results = $this->db->query("SELECT * FROM categories");
    $categories = $results->result();   
    $aView['categories']=$categories;

    if ($this->input->post()) 
        { // 2ème appel de la page: traitement du formulaire
        
        $data = $this->input->post();

       // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
        $config = array(
                        array(
                                'field' => 'pro_ref',
                                'label' => 'Référence',
                                'rules' => 'trim|required|min_length[4]|max_length[10]|alpha_numeric',
                                'errors' => array(
                                                'min_length' => 'Le %s doit avoir longueur minimum de 4 caractères.',
                                                'max_length' =>'Le %s doit avoir longueur maximum de 10 caractères.',
                                                'alpha_numeric'=>'Le %s doit doit contenir que des lettres et des chiffres'
                                                ),
                            ),
        
        
                        array(
                                'field' => 'pro_libelle',
                                'label' => 'Libellé',
                                'rules' => 'trim|required|min_length[4]|max_length[30]|alpha_numeric',
                                'errors' => array(
                                                    'required' => 'Le %s est obligatoire.',
                                                    'min_length' => 'Le %s doit avoir longueur minimum de 4 caractères.',
                                                    'max_length' =>'Le %s doit avoir longueur maximum de 10 caractères.',
                                                    'alpha_numeric'=>'Le %s doit doit contenir que des lettres et des chiffres'
                                                    ),
                            ),
                        array(
                                'field' => 'pro_description',
                                'label' => 'Description',
                                'rules' => 'trim|min_length[4]|max_length[1000]',
                                'errors' => array(
                                                    'min_length' => 'Le %s doit avoir longueur minimum de 4 caractères.',
                                                    'max_length' =>'Le %s doit avoir longueur maximum de 10 caractères.',
                                                    'alpha_numeric'=>'Le %s doit doit contenir que des lettres et des chiffres'
                                                ),
                            ),
                        array(
                                'field' => 'pro_prix',
                                'label' => 'Prix',
                                'rules' => 'trim|required|decimal',
                                'errors' => array(
                                                    'required' => 'Le %s est obligatoire.',
                                                    'decimal'=>'Le %s doit avoir que des décimaux'
                                                ),
                            ),
                        array(
                                'field' => 'pro_stock',
                                'label' => 'Stock',
                                'rules' => 'trim|required|integer',
                                'errors' => array(
                                                    'required' => 'Le %s est obligatoire.',
                                                    'decimal'=>'Le %s doit avoir que des entiers'
                                                ),
                            ),
        
                        array(
                                'field' => 'pro_couleur',
                                'label' => 'Couleur',
                                'rules' => 'trim|required|min_length[2]|max_length[30]|alpha_numeric',
                                'errors' => array(
                                                    'required' => 'Le %s est obligatoire.',
                                                    'min_length' => 'Le %s doit avoir longueur minimum de 4 caractères.',
                                                    'max_length' =>'Le %s doit avoir longueur maximum de 30 caractères.',
                                                    'alpha_numeric'=>'Le %s doit doit contenir que des lettres et des chiffres'
                                            ),
                            ),
        
                        array(
                                'field' => 'pro_bloque',
                                'label' => 'Bloquer',
                                'rules' => 'trim|required|min_length[3]|max_length[3]|alpha_numeric',
                                'errors' => array(
                                                    'required' => 'Le %s est obligatoire.',
                                                    'min_length' => 'Le %s doit avoir longueur minimum de 4 caractères.',
                                                    'max_length' =>'Le %s doit avoir longueur maximum de 10 caractères.',
                                                    'alpha_numeric'=>'Le %s doit doit contenir que des lettres et des chiffres'
                                                ),
                            )
                        );
    
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 

        if ($this->form_validation->run() == FALSE)
                 { // Echec de la validation, on réaffiche la vue formulaire 
                        $this->load->view('modifier', $aView);
                }
        else
            { // La validation a réussi, nos valeurs sont bonnes, on peut modifier en base  
 
            /* 
             * Avant d'enregistrer en base de données, il nous faut 
             * récupérer l'extension du fichier 
            */  

             // On extrait l'extension du nom du fichier,
            // on utilise la variable PHP superglobale $_FILES    
            if ($_FILES) 
                {
                 // On extrait l'extension du nom du fichier 
                 // Dans $_FILES["pro_photo"], pro_photo est la valeur donnée à l'attribut name du champ de type 'file'  
                $extension = substr(strrchr($_FILES["fichier"]["name"], "."), 1);
                
                /*
                * On a l'extension du fichier donc on peut enregistrer
                * en base de données 
                */
             
            
                /*
                * Pour créer le nom du fichier : il faut récupérer la clé primaire (pro_id) : 
                * - dans le cas du formulaire d'ajout : il faut récupérer avec la méthode $this-db->InsertId();
                * - dans le cas du formulaire de modification : on récupère le pro_id passé dans un champ de type hidden     
                 */
 
                // On créé un tableau de configuration pour l'upload
                $config['upload_path'] = './assets/images/'; // chemin où sera stocké le fichier
 
              // nom du fichier final
               $pro_id=$this->input->post('pro_id');
               $config['file_name'] = $pro_id.'.'.$extension; 
 
              // On indique les types autorisés (ici pour des images)
               $config['allowed_types'] = 'gif|jpg|jpeg|png'; 
 
                // On charge la librairie 'upload'
               $this->load->library('upload');
 
               // On initialise la config 
                $this->upload->initialize($config);
 
              // La méthode do_upload() effectue les validations sur l'attribut HTML 'name' ('fichier' dans notre formulaire) et si OK renomme et déplace le fichier tel que configuré
             if ( ! $this->upload->do_upload('fichier')) 
              {
                  // Echec : on récupère les erreurs dans une variable (une chaîne)
                   $errors = $this->upload->display_errors();    
 
                   // on réaffiche la vue du formulaire en passant les erreurs 
                   $aView["errors"] = $errors;
 
                  // Echec,  on réaffiche le formulaire
                  $this->load->view('modifier',$aView);
            
                }else{
                     
                // Ajout d'une date d'ajout que le formulaire ne contient pas
                $data["pro_d_modif"] = date("Y-m-d h:i:s");
 
                $data["pro_photo"] =$extension;
 
               // Transformation d'une information venant du formalaire
               // par exemple forcer la référence d'un produit en majuscules
                $pro_ref = $this->input->post("pro_ref");
                $data["pro_ref"] = strtoupper($pro_ref);
                $this->db->where('pro_id', $pro_id);
                $this->db->update('produits', $data);
               

                redirect("produits/liste");
                }
            }
 
    }
 }
    else 
    { // 1er appel de la page: affichage du formulaire             
        $this->load->view('modifier', $aView);
    }
} // -- modifier()
}