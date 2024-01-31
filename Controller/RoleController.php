<?php
    class RoleController extends MyFct{
        function __construct(){
            $action='list';
            extract($_GET);
            switch($action){
                case 'list':
                      //-----------proctection-------------
                    if($this->notGranted('ROLE_ADMIN')) $this->throwMessage("Vous n'avez pas <br> le droit d'utiliser cette action!");// on a ici un if sans accolade car on a qu'une seule ligne d'instruction
                    $this->listerRole();
                    break;
                case 'insert':
                    $this->insererRole();
                    break;
                case 'update':
                    if($this->notGranted('ROLE_ADMIN')) $this->throwMessage("Vous n'avez pas <br> le droit d'utiliser cette action!");
                    $this->modifierRole($id);
                    break;
                case 'show':
                    if($this->notGranted('ROLE_ADMIN')) $this->throwMessage("Vous n'avez pas <br> le droit d'utiliser cette action!");
                    $this->afficherRole($id);
                    break;
                case 'delete':
                   if($this->notGranted('ROLE_ADMIN')) $this->throwMessage("Vous n'avez pas <br> le droit d'utiliser cette action!");
                    $this->supprimerRole($id);
                    break;
                case 'save' :
                    $this->sauvegarderRole($_POST,$_FILES);
                    break;
              
            }
        }
        /*------------------Les Methods------------------------*/

       
      
        function supprimerRole($id){
            $rm=new RoleManager();
            $rm->deleteById($id);
            header("location:role");
            exit();
        }
        function insererRole(){
            //-----Role---
            $role=new Role();  // Créer un role à vide
        
            //$role_roles=$role->getRoles(); // Recupartion de roles (json) dans role
            $disabled="";
            /*------Creation de la page FormRole-----*/
            $this->generateFormRole($role,$disabled);
        }        
        function afficherRole($id){
            $rm=new RoleManager();  //  Instancier la clasee RoleManager
            $role=$rm->findById($id);  // Recuperer role corespondant à l'id $id. D'après RoleManager on a ici un objet
            $disabled="disabled";
            //----Role----------------
            $this->generateFormRole($role,$disabled);
        }   
        function modifierRole($id){
            //-----Role---
            $rm=new RoleManager();  //  Instancier la clasee RoleManager
            $role=$rm->findById($id);  // Recuperer role corespondant à l'id $id. D'après RoleManager on a ici un objet
            $disabled="";
            $this->generateFormRole($role,$disabled);
        }  


        function generateFormRole($role,$disabled){
            $rm=new RoleManager();

            
            $variables=[
                'id'=>$role->getId(),
               'rang'=>$role->getRang(),
               'libelle'=>$role->getLibelle(),
               'disabled'=>$disabled,
               
            ];
            //----Ouverture de la page
            $file="View/role/formRole.html.php";
            $this->generatePage($file,$variables);

        }                
        function sauvegarderRole($data,$files=[]){
           // $this->printr($data);die;
            $rm=new RoleManager();
            extract($data);
            $id=(int) $id;  // transformation de $id en entier
            if($id!=0){  // cas d'une modification
                $rm->update($data,$id);
            }else{  //  cas d'une insertion 
                if($data['roles']=="null"){
                    $data['roles']=json_encode(['ROLE_ROLE']);
                }
                $rm->insert($data);
                header("location:accueil");
                exit;
            }
            //  Redurection vers la page list role
            header("location:role");
            exit;
        }

        
        function listerRole(){
            /*-------------Préparation des variables à envoyer à la page--- */
            $rm=new RoleManager();
            $roles=$rm->showAll("order by rang asc");
            $listUsers=[];
            foreach($roles as $value){
              
                //----
                $listUsers[]=[
                    'id'=>$value['id'],
                    'rang'=>$value['rang'],
                    'libelle'=>$value['libelle'],
                    
                ];
            }
            $variables=[
                'listUsers'=>$listUsers,
                'nbre'=>count($listUsers),
            ];
            //------------Evoi page-------------*/
            $file="View/role/listRole.html.php";
            $this->generatePage($file,$variables);

        }




    } 