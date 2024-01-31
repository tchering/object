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
                   // $this->printr($_POST);
                   // $this->printr($_FILES);die;
                   
                    $this->sauvegarderRole($_POST,$_FILES);
                    break;
                case 'search':
                    $this->chercherRole($mot);
                    break;
                case 'login':
                    if($_POST){  // if($_POST!=[])  ou if(!empty($_POST))
                        $this->valider($_POST);
                    }
                    $this->seConnecter();
                    break;
                case 'logout':
                    $this->seDeconnecter();
                    break;
            }
        }
        /*------------------Les Methods------------------------*/

        function seDeconnecter(){
            session_destroy();
            header('location:accueil');
            exit;
        }
        function valider($data){
            $rm=new RoleManager();
            extract($data);
            //$connexion=$rm->connexion();
            //$sql="select * from role where (rolename=? or email=?)  and password=?";
            //$requete=$connexion->prepare($sql);
            //$requete->execute([$rolename,$rolename,$this->crypter($password)]);  // le premier $rolename est pour rolename=? et le 2ème pour email=?
            //$role =$requete->fetch(PDO::FETCH_ASSOC);
            $dataCondition=[
                'rolename'=>$rolename,
                'password'=>$this->crypter($password),
            ];

            //$role=$rm->findOneByCondition($dataCondition,'array');
           $role=$rm->findOneByCondition($dataCondition);
           if(!$role->getRolename()){//La recherche sur rolename s'est averée fausse alors on tente la recherche sur email
            $dataCondition=['email'=>$rolename,'password'=>$this->crypter($password)];
            $role=$rm->findOneByCondition($dataCondition);
           }

            if($role->getRolename()){
                $_SESSION['rolename']=$role->getRolename(); //$role['rolename'];
                $_SESSION['roles']=$role->getRoles();//$role['roles'];
                $_SESSION['bg_navbar']="bg_green";
                //---Redirection vers l'accueil

                header('location:accueil');
                exit;
            }else{
                $message="<div class='center'>";
                $message.= "<p>Identifant et ou mot de passe incorrect <p>";
                $message.="<img src='Public/img/giphy.gif' class='img-fluid radius_50' width='25%' >";
                $message.="</div>";

                $variables=[
                    'message'=>$message,
                ];
                $file="View/erreur/erreur.html.php";
                $this->generatePage($file,$variables);
            }
        }
        function seConnecter(){
            $file="View/role/formLogin.html.php";
            $this->generatePage($file);

        }
        function chercherRole($mot){
            $rm=new RoleManager();
            $columnLikes=['rolename'];
            $roles=$rm->search($columnLikes,$mot);
            $variables=[
                'listUsers'=>$roles,
                'nbre'=>count($roles),
            ];
            $file="View/role/listRole.html.php";
            $this->generatePage($file,$variables);        
        }        
        function supprimerRole($id){
            $rm=new RoleManager();
            $rm->deleteById($id);
            header("location:role");
            exit();
        }
        function insererRole(){
            //-----Role---
            $role=new Role();  // Créer un role à vide
            $role->setRoles(['ROLE_USER']);  //  Au moins un role à créer doit avoir 'ROLE_ROLE' 
            //$role_roles=$role->getRoles(); // Recupartion de roles (json) dans role
            $disabled="";
            /*------Creation de la page FormRole-----*/
            $this->generateFormRole($role,$disabled);
        }        
        function afficherRole($id){
            $rm=new RoleManager();  //  Instancier la clasee RoleManager
            $role=$rm->findById($id);  // Recuperer role corespondant à l'id $id. D'après RoleManager on a ici un objet
            $role_roles=$role->getRoles(); // Recupartion de roles (json) dans role
            $role_roles=json_decode($role_roles); //  transformation de $role_roles qui est encore JSON en tableau php
            $role->setRoles($role_roles);   // mettre à jour le roles dans l'objet role en tableau php
            $disabled="disabled";
            //----Role----------------
            $this->generateFormRole($role,$disabled);
        }   
        function modifierRole($id){
            //-----Role---
            $rm=new RoleManager();  //  Instancier la clasee RoleManager
            $role=$rm->findById($id);  // Recuperer role corespondant à l'id $id. D'après RoleManager on a ici un objet
            $role_roles=$role->getRoles(); // Recupartion de roles (json) dans role
            $role_roles=json_decode($role_roles); //  transformation de $role_roles qui est encore JSON en tableau php
            $role->setRoles($role_roles);   // mettre à jour le roles dans l'objet role en tableau php
            $disabled="";
            $this->generateFormRole($role,$disabled);
        }  
        function generateFormRole($role,$disabled){
            $photo=$role->getPhoto();

            if(!$photo){
                $photo="photo.jpg";// l'image photo.jpg doit être créer
            }

            $role_roles=$role->getRoles();
            //MyFct:😛rintr($role_roles);die;
            $rm=new RoleManager();
            $myRoles=$rm->showAll();  // recuperer la totalité de la table role.
            $roles=[]; // variale $roles à envoyer vers la page form.html.php
            foreach($myRoles as $role){
                //$this->printr($role);die;
                $libelle=$role['libelle'];
                if(in_array($libelle,$role_roles)){  // si $libelle fait parti de la tables $role_roles
                    $selected="selected";
                    $checked="checked";
                }else{
                    $selected="";
                    $checked="";
                }
                $roles[]=['libelle'=>$libelle,'selected'=>$selected,'checked'=>$checked];
            }
            //---------prearation variables---
            $variables=[
                'id'=>$role->getId(),
                'rolename'=>$role->getRolename(),
                'password'=>'',
                'email'=>$role->getEmail(),
                'roles'=>$roles,
                'disabled'=>$disabled,
                'photo'=>$photo,
            ];
            //----Ouverture de la page
            $file="View/role/formRole.html.php";
            $this->generatePage($file,$variables);

        }                
        function sauvegarderRole($data,$files=[]){
           // $this->printr($data);die;
           if($files['photo']['name']){// verifier si $files['photo']['name'] n'est pas vide
                $file_photo=$files['photo']; // $_FILES['photo']
                $name=$file_photo['name']; // recuperer le nom du fichier upload avec son extension
                $source = $file_photo['tmp_name']; // recuperer le chemin temporaire de l'emplacement du fichier uploadé
                $destination="Public/upload/$name"; // le chemin ou on va stocker le fichier
                move_uploaded_file($source,$destination);// deplacer le fichier temporaire vers la destination

                $data['photo']=$name;
           }
           else{
            $file_photo=[
                'name'=>'',
                'tmp_name'=>'',
            ];
            unset($data['name']); //supprimer l'element à l'indice 'name' dans $data
           }


           $file_photo = $file['photo'];
            $rm=new RoleManager();
            $connexion=$rm->connexion();
            $data['roles']=json_encode($data['roles']); // tranformer le condetune de $data['roles'] en json
            $data['password']=$this->crypter($data['password']); //  crypter le mode passe
            
           // $this->printr($data);die;
            extract($data);
            $id=(int) $id;  // transformation de $id en entier
            if($id!=0){  // cas d'une modification
                // $sql="update role set numRole=?,nomRole=?,adresseRole=? where id=?";
                // $requete=$connexion->prepare($sql);
                // $requete->execute([$numRole,$nomRole,$adresseRole,$id]);
                $rm->update($data,$id);
            }else{  //  cas d'une insertion 
                // $sql="insert into role (numRole,nomRole,adresseRole) values (?,?,?) ";
                // $requete=$connexion->prepare($sql);
                // $requete->execute([$numRole,$nomRole,$adresseRole]);
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