<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;

class IdentificationController extends Controller {

    /**
     * 
     * @return type
     */
    public function modulesAction() {
        /**
         * 
         * REGRAS DOS MODULOS
         * 
         * LABEL (NOT AUTHENTICATED)
         * 1) (FREE) = FREE
         * 2) (CREATED_AT < 1 MES) = FREE X MORE DAYS
         * 3) OTHER = X POINTS
         * 
         * BOTAO (NOT AUTHENTICATED) =====
         * 1) (FREE) = EXPLORE
         * 2) (CREATED_AT < 1 MES) = LOGIN
         * 3) (OTHER) = LOGIN
         * 
         * LABEL (AUTHENTICATED)         
         * 1) (FREE) = FREE
         * 2) (CREATED_AT < 1 MES) = FREE X MORE DAYS
         * 3) UTILIZADOR COMPROU OU TROCOU POR PONTOS = X POINTS
         *        
         * BOTAO (AUTHENTICATED) =====
         * 1) (FREE) = EXPLORE
         * 2) (CREATED_AT < 1 MES) = EXPLORE
         * 3) (UTILIZADOR COMPROU OU TROCOU POR PONTOS) = EXPLORE
         * 4) (OTHER) = APPLY POINTS
         * 
         * */
        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
        //dump($fos_user);

        $modules = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkIdentificationModule')->findBy(array('isActive' => true));

        return $this->render('SkaphandrusAppBundle:Identification:modules.html.twig', array(
                    'modules' => $modules
        ));
    }

    /**
     * 
     * @param type $slug
     * @return type
     */
    public function criteriasAction($slug) {

        $locale = $this->get('request')->getLocale();
        $loggedUser = $this->getUser();

        //module
        $module = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkIdentificationModule')
                ->findBySlug($slug, $locale);

//        dump($module->isOwnerModule($loggedUser));

        $now = new \DateTime();
        $diff = date_diff($now, $module->getCreatedAt());
//        dump($diff);
        //se o modulo nao é free
        if ($module->getIsFree() == false) {
            //se o user esta logado
            if (true === $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY', $loggedUser)) {
                //tem mais de 30 dias
                if ($diff->days > 30) {
                    //se o modulo lhe pertence
                    if ($module->isOwnerModule($loggedUser)) {
                        return $this->render('SkaphandrusAppBundle:Identification:criterias.html.twig', array(
                                    'module' => $module
                        ));
                        //se modulo nao pertence ao user
                    } else {
                        return $this->redirect($this->generateUrl('module_admin_edit'));
                    }
                    //tem menos de 30 dias
                } else {
                    return $this->render('SkaphandrusAppBundle:Identification:criterias.html.twig', array(
                                'module' => $module
                    ));
                }
                //se nao tiver logado
            } else {
                return $this->redirect($this->generateUrl('fos_user_security_login'));
            }
            //se for free
        } else {
            return $this->render('SkaphandrusAppBundle:Identification:criterias.html.twig', array(
                        'module' => $module
            ));
        }
    }

    /**
     * Returns a list of Criterias
     * @param Request $request
     * @return JsonResponse 
     */
    public function criteriasListJsonAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();

        $character_obj = new \Skaphandrus\AppBundle\Entity\SkIdentificationCharacter();

        $species = $request->query->get('species');
        if (!$species):
            $species = $request->request->get('species');
        endif;

        $module_id = $request->query->get('module_id');
        if (!$module_id):
            $module_id = $request->request->get('module_id');
        endif;

        $view_name = "sk_identification_criteria_matrix_" . $module_id;

        // Já existem caracters selecionados
        if ($species) {
            // Critérios
            $sql = "SELECT distinct(" . $view_name . ".criteria_id) as id 
                    FROM " . $view_name . "               
                    WHERE " . $view_name . ".species_id in (" . implode(", ", $species) . ")
                    ORDER by id asc";
        } else {
            // Foi selecionado o módulo e ainda nao ha criterios selecionados
            $sql = "SELECT distinct(" . $view_name . ".criteria_id) as id 
                    FROM " . $view_name . "               
                    ORDER by id asc";
        }

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();

        foreach ($values as $key => $value) {
            $results_array[] = $value['id'];
        }

        //dump($sql);
        //dump($values);

        $criteria_objs = $this->getDoctrine()
                ->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')
                ->findById($results_array, array('orderBy' => 'asc'));

        //dump($criteria_objs);

        $output = array();
        foreach ($criteria_objs as $key => $criteria_obj) {
            $criteria = array();
            $criteria['id'] = $criteria_obj->getId();
            $criteria['name'] = $criteria_obj->translate()->getName();
            $criteria['order_by'] = $criteria_obj->getOrderBy();
            $criteria['selection_type'] = ($criteria_obj->getSelectionType() == 1 ? "normal" : "slider");

            $criteria['is_cumulative'] = $criteria_obj->getIsCumulative();
            $characters = array();

            foreach ($criteria_obj->getCharacters() as $key => $character_obj) {

                $character = array();
                $character['id'] = $character_obj->getId();
                $character['name'] = $character_obj->translate()->getName();

                //100px 100px
//                $character['image_url'] = 'http://skaphandrus.com/thumbnails/small/characters/' . $character_obj->getImage();
                //$character['image_url'] = 'http://skaphandrus.com/media/cache/sk_widen_240/uploads/characters/' . $character_obj->getImage();

                $character['image_url'] = $this->get('liip_imagine.cache.manager')->getBrowserPath($character_obj->getWebPath(), 'sk_widen_240');
                $character['image_hash'] = $character_obj->getImage();
                $characters[] = $character;
            }
            $criteria['characters'] = $characters;
            $output[] = $criteria;
        }
        //dump($output);
        return new JsonResponse($output);
    }

    /**
     * Returns a list of Species
     * @param Request $request
     * @return JsonResponse 
     */
    public function speciesListJsonAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $connection = $em->getConnection();

        $character_ids = $request->query->get('characters');
        if (!$character_ids):
            $character_ids = $request->request->get('characters');
        endif;

        $module_id = $request->query->get('module_id');
        if (!$module_id):
            $module_id = $request->request->get('module_id');
        endif;

        $view_name = "sk_identification_criteria_matrix_" . $module_id;

        $sql = "SELECT (matrix.species_id) as id, 
	sk_species_scientific_name.name as name, 
	sk_species_illustration.image as image_illustration,
	image_photos.image as image_photo,
        image_google.image_src as image_google
        FROM (select distinct(species_id) as species_id from " . $view_name . ") matrix               
        LEFT JOIN sk_species_scientific_name on matrix.species_id = sk_species_scientific_name.species_id
        LEFT JOIN ( select species_id, image_url, image_src, max(is_primary) 
                FROM sk_species_image_ref group by species_id ) image_google on image_google.species_id = matrix.species_id
        LEFT JOIN ( select sk_photo_species_validation.species_id, image, max(rating) 
                FROM sk_photo_species_validation JOIN sk_photo on sk_photo.id = sk_photo_species_validation.photo_id GROUP by species_id ) image_photos on image_photos.species_id = matrix.species_id
        LEFT JOIN sk_species_illustration on matrix.species_id = sk_species_illustration.species_id";


        //especies com base nos characteres já selecionados
        if ($character_ids) {
            foreach ($character_ids as $key => $character_id) {

                $character_obj = $this->getDoctrine()
                        ->getRepository("SkaphandrusAppBundle:SkIdentificationCharacter")
                        ->findOneById($character_id);

                $characters[$character_obj->getCriteria()->getId()][] = $character_obj->getId();
            }

            $pks = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkSpecies")
                    ->getSpeciesIDSFromCharacterIDS($characters, $module_id);

            $sql = $sql . " WHERE matrix.species_id in (" . implode(", ", $pks) . ")
                    ORDER by name asc";

            //especies com base no modulo selecionado
        } else {

            $sql = $sql . " ORDER by name asc";
        }

        //echo $sql;

        $statement = $connection->prepare($sql);
        $statement->execute();
        $values = $statement->fetchAll();

        $speciesJson = array();

        foreach ($values as $sp) {
            $species = array();
            $species['id'] = $sp['id'];
            $species['name'] = $sp['name'];

            if ($sp['image_illustration'] != NULL):
                $image_src = "http://skaphandrus.com/uploads/ilustrations/" . $sp['image_illustration'];
                $species['image_src'] = $image_src;
                $species['image_url'] = $image_src;

            elseif ($sp['image_photo'] != NULL):
                $species['image_src'] = $this->get('liip_imagine.cache.manager')->getBrowserPath('/uploads/fotografias/' . $sp['image_photo'], 'sk_downscale_600_400');
                $species['image_url'] = $this->get('liip_imagine.cache.manager')->getBrowserPath('/uploads/fotografias/' . $sp['image_photo'], 'sk_downscale_600_400');

            elseif ($sp['image_google'] != NULL):
                $species['image_src'] = $sp['image_google'];
                $species['image_url'] = $sp['image_google'];
            else:

                $module_obj = $this->getDoctrine()
                        ->getRepository("SkaphandrusAppBundle:SkIdentificationModule")
                        ->findOneById($module_id);
                $species['image_src'] = $this->get('liip_imagine.cache.manager')->getBrowserPath($module_obj->getWebPath(), 'sk_downscale_600_400');
                $species['image_url'] = $this->get('liip_imagine.cache.manager')->getBrowserPath($module_obj->getWebPath(), 'sk_downscale_600_400');

            endif;

            $speciesJson[] = $species;
        }

//        foreach ($values as $sp) {
//            $species = array();
//            $species['id'] = $sp['id'];
//            $species['name'] = $sp['name'];
//            $species['image_url'] = "";
//
//            $species_obj = $em->getRepository("SkaphandrusAppBundle:SkSpecies")->find($sp['id']);
//
//            //ILUSTRACOES CIENTIFICAS (ir buscar ilustração)
//            foreach ($species_obj->getIllustrations() as $key => $illustration) {
//                
//                $image_src = "http://skaphandrus.com/uploads/ilustrations/".$illustration->getImage();
//                $species['image_src'] = $image_src;
//                $species['image_url'] = $image_src;
//                $species['image_type'] = "skaphandrus";
//                $species['is_illustration'] = "true";
//                $species['photographer'] = 'skaphandrus.com';
//                $species['license'] = "© All rights reserved";
//            }
//
//
//            //FOTOGRAFIAS (se não existirem ilustrações)
//            if (count($species_obj->getIllustrations())<1 ):
//                $photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
//                        ->getPhotosForIdentification($sp['id'], $module_id, 1);
//
//                //se existirem fotografias SKAPHANDRUS ou GOOGLE
//                if (count($photos) > 0):
//
//                    //fotografias SKAPHANDRUS
//                    if ($photos[0]['image_type'] == "skaphandrus"):
//                        $skPhoto = $this->getDoctrine()
//                                ->getRepository("SkaphandrusAppBundle:SkPhoto")
//                                ->findOneById($photos[0]['id']);
//                        $species['image_src'] = $this->get('liip_imagine.cache.manager')->getBrowserPath($skPhoto->getWebPath(), 'sk_downscale_600_400');
//                        $species['image_url'] = $this->get('liip_imagine.cache.manager')->getBrowserPath($skPhoto->getWebPath(), 'sk_downscale_600_400');
//                    
//                    //fotografias GOOGLE
//                    elseif ($photos[0]['image_type'] == "google"):
//                        $species['image_src'] = $photos[0]['image_src'];
//                        $species['image_url'] = $photos[0]['image_src'];
//                    endif;
//
//                //ILUSTRACAO DO MODULO
//                else:
//                    $module_obj = $this->getDoctrine()
//                            ->getRepository("SkaphandrusAppBundle:SkIdentificationModule")
//                            ->findOneById($module_id);
//                    $species['image_src'] = $this->get('liip_imagine.cache.manager')->getBrowserPath($module_obj->getWebPath(), 'sk_downscale_600_400');
//                    $species['image_url'] = $this->get('liip_imagine.cache.manager')->getBrowserPath($module_obj->getWebPath(), 'sk_downscale_600_400');
//                endif;
//
//            endif;
//
//            $speciesJson[] = $species;
//        }


        return new JsonResponse($speciesJson);
    }

    /**
     * Returns list of Modules organized by Master.
     * @return JsonResponse
     */
    public function modulesListJsonAction(Request $request) {
        $results = array();
        $module_object = new \Skaphandrus\AppBundle\Entity\SkIdentificationModule();

        $user_id = $request->query->get('user_id');
        if (!$user_id):
            $user_id = $request->request->get('user_id');
        endif;

        $app_id = $request->query->get('app_id');
        if (!$app_id):
            $app_id = $request->request->get('app_id');
        endif;

        //se não tiver app_id é a app OCEAN LIFE ID
        if (!$app_id):
            $app_id = 1;
        endif;

        //ocean life id = Get all masters
        if ($app_id == 1):
            $masters = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkIdentificationMaster")
                    ->findBy(array('isActive' => TRUE));

        //turtles = master id=2 (reptilia)
        elseif ($app_id == 2) :
            $masters = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkIdentificationMaster")
                    ->findBy(array('isActive' => TRUE, 'id' => 2));

        //nudibranches = master id=5 (slugs)
        elseif ($app_id == 3) :
            $masters = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkIdentificationMaster")
                    ->findBy(array('isActive' => TRUE, 'id' => 5));

        //fishes = master id=3 (peixes-osseos)
        elseif ($app_id == 4) :
            $masters = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkIdentificationMaster")
                    ->findBy(array('isActive' => TRUE, 'id' => 3));

        //sharks and rays = master id=4 (sharks and rays)
        elseif ($app_id == 5) :
            $masters = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkIdentificationMaster")
                    ->findBy(array('isActive' => TRUE, 'id' => 4));
        endif;

        // Iterate over all masters
        foreach ($masters as $master_object) {
            $master = array();
            $master['id'] = $master_object->getId();
            $master['name'] = $master_object->translate()->getName();
            $modules = array();

            // Iterate over the master's active modules
            foreach ($master_object->getModules() as $module_object) {
                if ($module_object->getIsActive()) {
                    $module = array();
                    $module['id'] = $module_object->getId();
                    $module['name'] = $module_object->translate()->getName();
                    $module['appstore_id'] = $module_object->getAppstoreId();
                    $module['points'] = $module_object->getPoints();
                    $module['googleplay_id'] = $module_object->getGoogleplayId();


                    //is_free = 0 (“necessita de autenticação”)
                    //is_free = 1 (“não necessita de autenticação”)
                    $module['is_free'] = $module_object->getIsFree() ? "1" : "0";


                    //O campo “is_enabled” define se o utilizador tem o módulo desbloqueado no servidor.
                    //is_enabled = 0 (“Não tem acesso”)
                    //is_enabled = 1  (“Tem acesso”)
                    if ($user_id) {
                        $module['is_enabled'] = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkIdentificationModule")
                                ->isModuleInAcquisitionsFromUser($user_id, $module_object->getId());
                    } else {
                        //se nao tem user, é a versão antiga então deixamos utilizar o modulo
                        $module['is_enabled'] = "1";
                    }

                    //O campo “is_active” define de o modulo está pronto ou em desenvolvimento pelos biólogos.
                    //is_active = 0 = “Will be available soon! New groups are added frequently so stay tuned!”,
                    //is_active = 1 = ok
                    $module['is_active'] = $module_object->getIsActive() ? "1" : "0";

                    $workers = array();

                    // Iterate over the workers
                    foreach ($module_object->getWorkers() as $fos_user) {
                        //$worker = new \Skaphandrus\AppBundle\Entity\FosUser();

                        $worker = array();
                        $worker['id'] = $fos_user->getId();
                        $worker['name'] = $fos_user->getName();
                        $worker['image'] = $this->get('liip_imagine.cache.manager')->getBrowserPath($fos_user->getSettings()->getWebPath(), 'sk_widen_240');
                        $worker['profile_url'] = 'http://skaphandrus.com' . $this->generateUrl('user', array('id' => $fos_user->getId()));
                        $worker['worker_type'] = $fos_user->getPersonal()->getHonorific();

                        $workers[] = $worker;
                    }

                    $module['workers'] = $workers;

                    /*
                      is_enabled = -1 = “No access”,
                      is_enabled = 0  = “Will be available soon! New groups are added frequently so stay tuned!”,
                      is_enabled = 1  = “Has access”)
                     */
                    //$module['is_enabled'] = $module_object->getIsEnabled();
                    //100px 100px
                    //$module['image_url'] = 'http://skaphandrus.com/thumbnails/default/characters/' . $module_object->getImage() . '.jpg';
                    //$module['image_url'] = 'http://skaphandrus.com/media/cache/sk_downscale_600_400/uploads/characters/' . $module_object->getImage();

                    $module['image_url'] = $this->get('liip_imagine.cache.manager')->getBrowserPath($module_object->getWebPath(), 'sk_downscale_600_400');

                    $modules[] = $module;
                }
            }

            $master['modules'] = $modules;
            $results[] = $master;
        }

        header('Access-Control-Allow-Origin: *');

        //echo json_encode($output);

        return new JsonResponse($results);
    }

    /**
     * Returns species information.
     * @param Request $request
     * @return JsonResponse
     */
    public function speciesInfoJsonAction(Request $request) {
        $species_id = $request->query->get('species_id');
        if (!$species_id):
            $species_id = $request->request->get('species_id');
        endif;

        $module_id = $request->query->get('module_id');
        if (!$module_id):
            $module_id = $request->request->get('module_id');
        endif;

        $species = array();

        $species_obj = $this->getDoctrine()
                ->getRepository("SkaphandrusAppBundle:SkSpecies")
                ->findOneById($species_id);

        //return new JsonResponse($species_obj);

        $photos_arr = array();

        if ($species_obj) {
            $species['id'] = $species_obj->getId();
            $species['name'] = $species_obj->getName();

            $locales = array();
            $permitted_locales = array('pt', 'en', 'fr', 'es', 'de', 'it', 'ru', 'zh');
            $vernaculars = array();
            foreach ($species_obj->getSpeciesVernaculars() as $vernacular_obj) {
                if (!in_array($vernacular_obj->getLocale(), $locales) && in_array($vernacular_obj->getLocale(), $permitted_locales)) {
                    $locales[] = $vernacular_obj->getLocale();

                    $vernaculars[] = array(
                        'culture' => $vernacular_obj->getLocale(),
                        'name' => $vernacular_obj->getVernacular()->getName(),
                    );
                }
            }
            $species['common_names'] = $vernaculars;

            // Taxonomic Structure -> accordion
            $species['class'] = $species_obj->getGenus()->getFamily()->getOrder()->getClass()->getName();
            $species['order'] = $species_obj->getGenus()->getFamily()->getOrder()->getName();
            $species['family'] = $species_obj->getGenus()->getFamily()->getName();
            $species['genus'] = $species_obj->getGenus()->getName();

            // Description -> accordion
            $species['description'] = $species_obj->translate()->getDescription();

            // Danger -> ex: venenoso, traumatogenico, electrogenico
            // $species['threat_to_humans'] = $skEspecie->getStringDanger();
            $species['threat_to_humans'] = '';

            //BEHAVIOR -> curioso, indiferente, escondido
            //$species['behaviour_to_humans'] = $skEspecie->getStringBehaviour();
            $species['behaviour_to_humans'] = '';

            //MAX LENGHT (valor está na BD em centimetros)
            //conversão para metros
            // $species['max_lenght'] = number_format($skEspecie->getLenght() / 100, 2) . ' (' . $skEspecie->getskSpeciesLenghtType() . ')';
            $species['max_lenght'] = '';

            //HOW TO FIND 
            $species['how_to_find'] = $species_obj->translate()->getHowToFind();

            //FOTOGRAFIAS

            $limit = 3;


            /* OLD OK CODE */
//            
//            
//            $sk_photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
//                    ->getSkPhotosForIdentification($species_id, $limit);
//
//            //IMAGENS SKAPHANDRUS
//            foreach ($sk_photos as $photo) {
//                $skPhoto = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPhoto')->find($photo['id']);
//                $image_src = $this->get('liip_imagine.cache.manager')->getBrowserPath($skPhoto->getWebPath(), 'sk_downscale_600_400');
//
//                $licence = $skPhoto->getCreative();
//                if ($licence == null):
//                    $licence = "© All rights reserved";
//                else:
//                    $licence = $skPhoto->getCreative()->getName();
//                endif;
//
//                $photos[] = array(
//                    'id' => $skPhoto->getId(),
//                    'image_src' => $image_src,
//                    'image_type' => "skaphandrus",
//                    'photographer' => $skPhoto->getFosUser()->getName(),
//                    'license' => $licence
//                );
//            }
//
//
//            //IMAGENS GOOGLE
//            if (count($sk_photos) < $limit) {
//
//                $i = 1;
//                foreach ($species_obj->getImageRefs() as $imageRef_obj) {
//                    if ($imageRef_obj->getIsActive()) {
//
//                        $licence = $imageRef_obj->getLicense();
//                        if ($licence == "" || $licence == NULL):
//                            $licence = "Images may be subject to copyright.";
//                        else:
//                            $licence = $imageRef_obj->getLicense();
//                        endif;
//
//                        $photos[] = array(
//                            'id' => $imageRef_obj->getId(),
//                            'image_src' => $imageRef_obj->getImageSrc(),
//                            'image_url' => $imageRef_obj->getImageUrl(),
//                            'image_type' => "google",
//                            'photographer' => $imageRef_obj->getPhotographer(),
//                            'license' => $licence
//                                //Milton já está a receber photographer
//                        );
//                    }
//                    if ($i++ == $limit)
//                        break;
//                }
//            }
            //ILUSTRACOES CIENTIFICAS (ir buscar ilustração)
            foreach ($species_obj->getIllustrations() as $key => $illustration) {

                $image_src = "http://skaphandrus.com/uploads/ilustrations/" . $illustration->getImage();
                $photos_arr[] = array(
                    'id' => $illustration->getId(),
                    'image_src' => $image_src,
                    'image_url' => $image_src,
                    'image_type' => "skaphandrus",
                    //'is_illustration' => "true", está a dar erro?!?!?!
                    'photographer' => 'skaphandrus.com',
                    'license' => "© All rights reserved"
                );
            }


            //FOTOGRAFIAS (se não existirem ilustrações)
            if (count($photos_arr) <= $limit):
                $photos = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkSpecies')
                        ->getPhotosForIdentification($species_obj->getId(), $module_id, 3);

                //se existirem fotografias SKAPHANDRUS ou GOOGLE
                if (count($photos) > 0):
                    foreach ($photos as $key => $photo) {

                        //fotografias SKAPHANDRUS
                        if ($photo['image_type'] == "skaphandrus"):
                            $skPhoto = $this->getDoctrine()
                                    ->getRepository("SkaphandrusAppBundle:SkPhoto")
                                    ->findOneById($photo['id']);

                            $image_src = $this->get('liip_imagine.cache.manager')->getBrowserPath($skPhoto->getWebPath(), 'sk_downscale_600_400');

                            $licence = "© All rights reserved";
                            $photos_arr[] = array(
                                'id' => $skPhoto->getId(),
                                'image_src' => $image_src,
                                'image_url' => $image_src,
                                'image_type' => "skaphandrus",
                                'photographer' => $skPhoto->getFosUser()->getName(),
                                'license' => $licence
                            );

                        //fotografias GOOGLE
                        elseif ($photo['image_type'] == "google"):

                            $photos_arr[] = array(
                                'id' => $photo['id'],
                                'image_src' => $photo['image_src'],
                                'image_url' => $photo['image_url'],
                                'image_type' => "google",
                                'photographer' => $photo['photographer'],
                                'license' => $photo['license']
                            );

                        endif;
                    }

                //ILUSTRACAO DO MODULO
                else:
                    $module_obj = $this->getDoctrine()
                            ->getRepository("SkaphandrusAppBundle:SkIdentificationModule")
                            ->findOneById($module_id);

                    $image_src = $this->get('liip_imagine.cache.manager')->getBrowserPath($module_obj->getWebPath(), 'sk_downscale_600_400');
                    $photos_arr[] = array(
                        'id' => $module_obj->getId(),
                        'image_src' => $image_src,
                        'is_illustration' => "true",
                        'photographer' => 'skaphandrus.com',
                        'license' => "© All rights reserved"
                    );

                endif;

            endif;

            //dump ($photos_arr);

            $species['images'] = $photos_arr;

            //CRITERIOS/CARACTERES
            //$species['criterias'] = $this->getCharactersIDSFromSpecies($species_obj->getId(), /*$module_id*/ 2, $this->container, $this->get('request')->getLocale());
            $species['criterias'] = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkIdentificationCharacter")
                    ->getCharactersIDSFromSpecies($species_obj->getId(), $module_id, $this->get('request')->getLocale());

            $species['criterias'] = array();
        }
        header('Access-Control-Allow-Origin: *');

        return new JsonResponse($species);
    }

    /**
     * Returns user information.
     * @param Request $request
     * @return JsonResponse
     */
    public function userInfoJsonAction(Request $request) {

        //$fos_user = new \Skaphandrus\AppBundle\Entity\FosUser();

        $user_id = $request->query->get('user_id');
        if (!$user_id):
            $user_id = $request->request->get('user_id');
        endif;

        $fos_user = $this->getDoctrine()
                ->getRepository("SkaphandrusAppBundle:FosUser")
                ->findOneById($user_id);

        if ($fos_user) {
            $user['id'] = $fos_user->getId();
            $user['name'] = $fos_user->getName();
            $user['honorific'] = $fos_user->getPersonal()->getHonorific();
            $user['image'] = $this->get('liip_imagine.cache.manager')->getBrowserPath($fos_user->getSettings()->getWebPath(), 'sk_widen_240');
            $user['profile_url'] = 'http://skaphandrus.com' . $this->generateUrl('user', array('id' => $fos_user->getId()));

            //actualizar pontos do utilizador
            $arr = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPoints')->generatePointsFromUser($fos_user);
            //ir buscar pontos do utilizador
            $entities = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkPoints')->findBy(array('fosUser' => $fos_user->getId()));

            $points_item = new \Skaphandrus\AppBundle\Entity\SkPoints();

            foreach ($entities as $points_item) {
                $points[] = array(
                    'id' => $points_item->getPointsType()->getId(),
                    'type' => $this->get('translator')->trans($points_item->getPointsType()->getName()),
                    'points' => $points_item->getPoints()
                );
            }
            $user['points'] = $points;
        }



        header('Access-Control-Allow-Origin: *');

        return new JsonResponse($user);
    }

    /**
     * Return taxons list 
     * @param Request $request
     * @return JsonResponse
     */
    public function taxonListJsonAction(Request $request) {
        $module_id = $request->query->get('module_id');
        if (!$module_id):
            $module_id = $request->request->get('module_id');
        endif;

        $module_obj = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkIdentificationModule")
                ->findOneById($module_id);

        $output = array();

        return new JsonResponse($output);
    }

    public function testsAction() {
        return $this->render('SkaphandrusAppBundle:Identification:test.html.twig');
    }

    /**
     * Return authentication 
     * @param Request $request
     * @return JsonResponse
     */
    //http://stackoverflow.com/questions/10422251/manual-authentication-check-symfony-2

    public function loginJsonAction(Request $request) {

        $response = array();
        $em = $this->get('doctrine')->getEntityManager();

        $email = $request->query->get('email');
        if (!$email):
            $email = $request->request->get('email');
        endif;

        $password = $request->query->get('password');
        if (!$password):
            $password = $request->request->get('password');
        endif;

        $facebook_uid = $request->query->get('facebook_uid');
        if (!$facebook_uid):
            $facebook_uid = $request->request->get('facebook_uid');
        endif;


        //autenticação por email
        if ($email):

            $query = $em->createQuery("SELECT u "
                    . "FROM SkaphandrusAppBundle:FosUser u "
                    . "WHERE u.email = :email");
            $query->setParameter('email', $email);
            $user = $query->getOneOrNullResult();

            if ($user) {
                // Get the encoder for the users password
                $encoder_service = $this->get('security.encoder_factory');
                $encoder = $encoder_service->getEncoder($user);

                // Note the difference
                if ($encoder->isPasswordValid($user->getPassword(), $password, $user->getSalt())) {
                    // Get profile list
                    $response["result"] = "1";
                    $response["message"] = "Success";
                    $response["user_id"] = $user->getId();
                } else {
                    // Password bad
                    $response["result"] = "2";
                    $response["message"] = "Incorrect Password";
                }
            } else {
                // Username bad
                $response["result"] = "3";
                $response["message"] = "The Email does not exist";
            }
        //autenticação por facebook
        else:

            $query = $em->createQuery("SELECT u "
                    . "FROM SkaphandrusAppBundle:FosUser u "
                    . "JOIN SkaphandrusAppBundle:SkSettings s WITH s.fosUser = u.id "
                    . "WHERE s.facebookUid = :facebook_uid");
            $query->setParameter('facebook_uid', $facebook_uid);
            $user = $query->getOneOrNullResult();

            if ($user) {
                // Get profile list
                $response["result"] = "1";
                $response["message"] = "Success";
                $response["user_id"] = $user->getId();
            } else {
                // Username bad
                $response["result"] = "4";
                $response["message"] = "Facebook Account does not exist";
            }

        endif;

        header('Access-Control-Allow-Origin: *');

        return new JsonResponse($response);
    }

    //http://stackoverflow.com/questions/6157733/create-login-user-from-a-mobile-device-using-symfony2-and-fosuserbundle
    public function registerJsonAction() {

        $em = $this->get('doctrine')->getEntityManager();
        $response = array();

        //to use in username and password
        $date = date_create();
        //username = timestamp
        $username = date_timestamp_get($date);
        $password = date_timestamp_get($date);


        $user = new \Skaphandrus\AppBundle\Entity\FosUser();

        $request = $this->getRequest();

        $first_name = $request->query->get('first_name');
        if (!$first_name):
            $first_name = $request->request->get('first_name');
        endif;

        $last_name = $request->query->get('last_name');
        if (!$last_name):
            $last_name = $request->request->get('last_name');
        endif;

        $email = $request->query->get('email');
        if (!$email):
            $email = $request->request->get('email');
        endif;

        $password = $request->query->get('password');
        if (!$password):
            $password = $request->request->get('password');
        endif;

        $facebook_uid = $request->query->get('facebook_uid');
        if (!$facebook_uid):
            $facebook_uid = $request->request->get('facebook_uid');
        endif;

        /*         * *********************************************************************
         * VALIDATIONS START
         */
        //verify if username exists
//        $query = $em->createQuery("SELECT u FROM SkaphandrusAppBundle:FosUser u WHERE u.username = :username");
//        $query->setParameter('username', $username);
//        $user = $query->getOneOrNullResult();
//        //username already exists
//        if ($user) {
//            $response["result"] = "2";
//            $response["message"] = "Username already exists";
//            return new JsonResponse($response);
//        }
//        
        //NOTA IMPORTANTE, A ALTERAR NA RELEASE 2.0.1 
        //A ORDEM DESTA VALIDACAO TEM DE SER TROCADA PARA SE IDENTIFICAR QUANDO O FACEBOOK ID JA EXISTE.
        //verify if email is in use
        $query = $em->createQuery("SELECT u FROM SkaphandrusAppBundle:FosUser u WHERE u.email = :email");
        $query->setParameter('email', $email);
        $user = $query->getOneOrNullResult();
        //email already exists
        if ($user) {
            $response["result"] = "3";
            $response["message"] = "Email already exists";
            return new JsonResponse($response);
        }

        //verify if facebook_uid is in use
        $query = $em->createQuery("SELECT u "
                . "FROM SkaphandrusAppBundle:FosUser u "
                . "JOIN SkaphandrusAppBundle:SkSettings s WITH s.fosUser = u.id "
                . "WHERE s.facebookUid = :facebook_uid");
        $query->setParameter('facebook_uid', $facebook_uid);
        $user = $query->getOneOrNullResult();
        //facebook account already exists
        if ($user) {
            $response["result"] = "4";
            $response["message"] = "Facebook account already exists";
            return new JsonResponse($response);
        }

        /**
         * VALIDATIONS END
         * ********************************************************************* */
        $user = new \Skaphandrus\AppBundle\Entity\FosUser();

        //se o registo for com os dados do facebook
        if ($facebook_uid) {
            $settings = new \Skaphandrus\AppBundle\Entity\SkSettings();
            $settings->setFosUser($user);

            $emailNotificationTime = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkEmailNotificationTime")->findOneById(1);
            $settings->setEmailNotificationTime($emailNotificationTime);
            $settings->setFacebookUid($facebook_uid);
            $user->setSettings($settings);
            $em->persist($settings);
        }

        //set encoded password
        $factory = $this->get('security.encoder_factory');
        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($password);

        //firstname and lastname
        $personal = new \Skaphandrus\AppBundle\Entity\SkPersonal();
        $personal->setFirstname($first_name);
        $personal->setLastname($last_name);
        $personal->setHonorific("Scuba Diver");
        $personal->setFosUser($user);
        $user->setPersonal($personal);
        $em->persist($personal);

        $user->setUsername($username);
        $user->setUsernameCanonical($username);
        $user->setEmail($email);
        $user->setEmailCanonical($email);
        $user->setEnabled(true);
        $user->setLocked(false);
        $user->setExpired(false);

        $user->setCredentialsExpired(false);

        $em->persist($user);
        $em->flush();
        /* $response = new Response(json_encode(array('user' => $tes)));
          $response->headers->set('Content-Type', 'application/json');
          return $response; */

        // envia email apos registo de utilizador atraves da app
        $message = \Swift_Message::newInstance()
                ->setSubject("Ocean Life ID: Welcome " . $user->getPersonal()->getFirstname() . ' ' . $user->getPersonal()->getLastname())
                ->setFrom('noreply-registration@skaphandrus.com', 'Skaphandrus')
                ->setTo($user->getEmail())
                ->setBcc('noreply@skaphandrus.com')
                ->setBody($this->renderView('SkaphandrusAppBundle:FOSUserEmail:register_app.html.twig', array(
                    'username' => $user->getPersonal()->getFirstname() . ' ' . $user->getPersonal()->getLastname())
                ), 'text/html');

        $this->get('mailer')->send($message);

        $response["result"] = "1";
        $response["user_id"] = $user->getId();
        $response["message"] = "Successfully registered";

        header('Access-Control-Allow-Origin: *');

        return new JsonResponse($response);
    }

}
