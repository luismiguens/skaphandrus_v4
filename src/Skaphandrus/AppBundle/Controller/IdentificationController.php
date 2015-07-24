<?php

namespace Skaphandrus\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse as JsonResponse;

class IdentificationController extends Controller {

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
         **/
        $fos_user = $this->get('security.token_storage')->getToken()->getUser();
        //dump($fos_user);
        
        $modules = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkIdentificationModule')->findBy(array('isActive'=>true));

        //dump($modules);
        
        return $this->render('SkaphandrusAppBundle:Identification:modules.html.twig', array('modules' => $modules));
    }

    public function criteriasAction($slug) {

        $locale = $this->get('request')->getLocale();

        //module
        $module = $this->getDoctrine()->getRepository('SkaphandrusAppBundle:SkIdentificationModule')
                ->findBySlug($slug, $locale);

        return $this->render('SkaphandrusAppBundle:Identification:criterias.html.twig', array('module' => $module));
    }

    /*
     * Returns a list of Criterias
     */

    public function criteriasListJsonAction(Request $request) {
        $species = $request->query->get('species');
        if (!$species)
            $species = $request->request->get('species');
        $module_id = $request->query->get('module_id');
        if (!$module_id)
            $module_id = $request->request->get('module_id');

        // Já existem caracters selecionados
        if ($species) {
            // Critérios
            $criterias_pks = $this->getDoctrine()
                    ->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')
                    ->getCriteriaIDSFromSpeciesIDS($species, $module_id);
        } else {
            // Foi selecionado o módulo e ainda nao ha criterios selecionados
            $module_obj = $this->getDoctrine()
                    ->getRepository('SkaphandrusAppBundle:SkIdentificationModule')
                    ->findOneById($module_id);

            $criterias_pks = $this->getDoctrine()
                    ->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')
                    ->getCriteriaIDSFromModule($module_obj);
        }

        $criteria_objs = $this->getDoctrine()
                ->getRepository('SkaphandrusAppBundle:SkIdentificationCriteria')
                ->findById($criterias_pks, array('orderBy' => 'asc'));

        $output = array();
        foreach ($criteria_objs as $key => $criteria_obj) {
            $criteria = array();
            $criteria['id'] = $criteria_obj->getId();
            $criteria['name'] = $criteria_obj->translate()->getName();
            $criteria['order_by'] = $criteria_obj->getOrderBy();
            $criteria['is_cumulative'] = $criteria_obj->getIsCumulative();
            $characters = array();

            foreach ($criteria_obj->getCharacters() as $key => $character_obj) {

                $character = array();
                $character['id'] = $character_obj->getId();
                $character['name'] = $character_obj->translate()->getName();

                //100px 100px
//                $character['image_url'] = 'http://skaphandrus.com/thumbnails/small/characters/' . $character_obj->getImage();
                  $character['image_url'] = 'http://skaphandrus.com/media/cache/resolve/sk_widen_240/uploads/characters/' . $character_obj->getImage();
                
                $character['image_hash'] = $character_obj->getImage();

                $characters[] = $character;
            }
            $criteria['characters'] = $characters;
            $output[] = $criteria;
        }

        return new JsonResponse($output);
    }

    /*
     * Returns a list of Species
     */

    public function speciesListJsonAction(Request $request) {

        $character_ids = $request->query->get('characters');
        if (!$character_ids)
            $character_ids = $request->request->get('characters');
        $module_id = $request->query->get('module_id');
        if (!$module_id)
            $module_id = $request->request->get('module_id');

        $module_obj = $this->getDoctrine()
                ->getRepository("SkaphandrusAppBundle:SkIdentificationModule")
                ->findOneById($module_id);

        //especies com base nos characteres já selecionados
        if ($character_ids) {
            $characters = array();

            $em = $this->container->get('doctrine.orm.entity_manager');
            $qb = $em->createQueryBuilder();
            $qb->select('c');
            $qb->from('SkaphandrusAppBundle:SkIdentificationCharacter', 'c');
            $qb->where($qb->expr()->in('c.id', $character_ids));
            $character_objs = $qb->getQuery()->getResult();

            foreach ($character_objs as $key => $character_obj) {
                $characters[$character_obj->getCriteria()->getId()][] = $character_obj->getId();
            }

            $pks = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkSpecies")
                    ->getSpeciesIDSFromCharacterIDS($characters, $module_id);

            //especies com base no modulo selecionado
        } else {
            $pks = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkSpecies")
                    ->getSpeciesIDSFromModule($module_obj);
        }

        $species_list = array();

        //modulo
        if ($module_id):
            $module_obj = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkIdentificationModule")
                    ->findOneById($module_id);
            $image_url = 'characters/' . $module_obj->getImage();
        else:
            $image_url = 'http://skaphandrus.com/images/stuff/50-50/no-image-species.png';
        endif;

        foreach ($pks as $pk) {
            $species_obj = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkSpecies")
                    ->findOneById($pk);

            $especie = array();
            $especie['id'] = $species_obj->getId();
            $especie['name'] = $species_obj->getName();

            //por defeito
            $image_src = $image_url;

            //imagem do google
            $imageRef = $species_obj->getImageRef();

            if ($imageRef):
                $image_src = $imageRef->getImageSrc();
            endif;

            //ilustracao cientifica
            // foreach ($species_obj->getskEspecieIlustracaos() as $key => $skEspecieIlustracao) {
            //     $image_src = url_for2('sf_image_file', array('format' => 'default', 'filepath' => 'ilustrations/' . $skEspecieIlustracao->getImagem()), true);
            // }

            $especie['image_src'] = $image_src;

            //versoes antigas estão a ler o campo "image_url"
            $especie['image_url'] = $image_src;

            $species_list[] = $especie;
        }

        return new JsonResponse($species_list);
    }

    /*
     * Returns list of Modules organized by Master.
     */

    public function modulesListJsonAction() {
        $results = array();

        // Get all masters
        $masters = $this->getDoctrine()
                ->getRepository("SkaphandrusAppBundle:SkIdentificationMaster")
                ->findBy(array('isActive' => TRUE));

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
                    $module['googleplay_id'] = $module_object->getGoogleplayId();

                    /*
                      is_enabled = -1 = “No access”,
                      is_enabled = 0  = “Will be available soon! New groups are added frequently so stay tuned!”,
                      is_enabled = 1  = “Has access”)
                     */
                    $module['is_enabled'] = $module_object->getIsEnabled();

                    //100px 100px
                    //$module['image_url'] = 'http://skaphandrus.com/thumbnails/default/characters/' . $module_object->getImage() . '.jpg';
                    $module['image_url'] = 'http://skaphandrus.com/media/cache/resolve/sk_downscale_600_400/uploads/characters/' . $module_object->getImage() . '.jpg';


                    $modules[] = $module;
                }
            }

            $master['modules'] = $modules;
            $results[] = $master;
        }

        return new JsonResponse($results);
    }

    /*
     * Returns species information.
     */

    public function speciesInfoJsonAction(Request $request) {
        $species_id = $request->query->get('species_id');
        if (!$species_id)
            $species_id = $request->request->get('species_id');
        $module_id = $request->query->get('module_id');
        if (!$module_id)
            $module_id = $request->request->get('module_id');
        $species = array();

        $species_obj = $this->getDoctrine()
                ->getRepository("SkaphandrusAppBundle:SkSpecies")
                ->findOneById($species_id);

        //return new JsonResponse($species_obj);

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
            $photos = array();

            //ILUSTRACOES CIENTIFICAS
            // foreach ($skEspecie->getskEspecieIlustracaos() as $key => $skEspecieIlustracao) {
            //     $fotografia = array();
            //     $fotografia['id'] = $skEspecieIlustracao->getId();
            //     $image_src = url_for2('sf_image_file', array('format' => 'default', 'filepath' => 'ilustrations/' . $skEspecieIlustracao->getImagem()), true);
            //     $fotografia['image_src'] = $image_src;
            //     $fotografia['is_illustration'] = "true";
            //     $fotografias[] = $fotografia;
            // }
            //REFERENCIAS GOOGLE
            foreach ($species_obj->getImageRefs() as $imageRef_obj) {
                if ($imageRef_obj->getIsActive()) {
                    $photos[] = array(
                        'id' => $imageRef_obj->getId(),
                        'image_src' => $imageRef_obj->getImageSrc(),
                        'image_url' => $imageRef_obj->getImageUrl()
                    );
                }
            }
            $species['images'] = $photos;

            //CRITERIOS/CARACTERES
            //$species['criterias'] = $this->getCharactersIDSFromSpecies($species_obj->getId(), /*$module_id*/ 2, $this->container, $this->get('request')->getLocale());
            $species['criterias'] = $this->getDoctrine()
                    ->getRepository("SkaphandrusAppBundle:SkIdentificationCharacter")
                    ->getCharactersIDSFromSpecies($species_obj->getId(), $module_id, $this->get('request')->getLocale());
        }
        return new JsonResponse($species);
    }

    public function taxonListJsonAction(Request $request) {
        $module_id = $request->query->get('module_id');
        if (!$module_id)
            $module_id = $request->request->get('module_id');
        $module_obj = $this->getDoctrine()
                ->getRepository("SkaphandrusAppBundle:SkIdentificationModule")
                ->findOneById($module_id);

        $output = array();
        $classes = array();
        $orders = array();
        $families = array();
        $genuses = array();

        // Ir buscar os taxons de topo
        $classList = array();
        $orderList = array();
        $familyList = array();
        $genusList = array();
        foreach ($module_obj->getGroups() as $group_obj) {
            if ($group_obj->getIsParentModule()) {
                ${$group_obj->getTaxonName() . 'List'}[] = $group_obj->getTaxonValue();
            }
        }

        // classList no topo
        foreach ($classList as $key => $class_obj) {
            $class_obj = $value->getskClasse();

            $class = array();
            $class['id'] = $class_obj->getId();
            $class['name'] = $class_obj->getName();
            $class['type'] = 'class';

            $orders = array();
            foreach ($class_obj->getOrder() as $key => $order_obj) {

                $ordem = array();
                $ordem['id'] = $order_obj->getId();
                $ordem['name'] = $order_obj->getName();
                $ordem['type'] = 'order';

                $families = array();
                foreach ($order_obj->getFamily() as $key => $family_obj) {

                    $familia = array();
                    $familia['id'] = $family_obj->getId();
                    $familia['name'] = $family_obj->getName();
                    $familia['type'] = 'family';

                    $genuses = array();
                    foreach ($family_obj->getGenus() as $key => $genus_obj) {

                        $genero = array();
                        $genero['id'] = $genus_obj->getId();
                        $genero['name'] = $genus_obj->getName();
                        $genero['type'] = 'genus';

                        $species = array();
                        foreach ($genus_obj->getSpecies() as $key => $species_obj) {

                            $especie = array();
                            $especie['id'] = $species_obj->getId();
                            $especie['name'] = $species_obj->getName();
                            $especie['type'] = 'species';

                            $species[] = $especie;
                        }
                        $genero['children'] = $species;
                        $genuses[] = $genero;
                    }
                    $familia['children'] = $genuses;
                    $families[] = $familia;
                }
                $ordem['children'] = $families;
                $orders[] = $ordem;
            }
            $class['children'] = $orders;
            $output[] = $class;
        }

        // orderList no topo
        foreach ($orderList as $key => $value) {

            $order_obj = $value->getskOrdem();

            $ordem = array();
            $ordem['id'] = $order_obj->getId();
            $ordem['name'] = $order_obj->getName();
            $ordem['type'] = 'order';

            $families = array();
            foreach ($order_obj->getFamily() as $key => $family_obj) {
                $familia = array();
                $familia['id'] = $family_obj->getId();
                $familia['name'] = $family_obj->getName();
                $familia['type'] = 'family';

                $genuses = array();
                foreach ($family_obj->getGenus() as $key => $genus_obj) {

                    $genero = array();
                    $genero['id'] = $genus_obj->getId();
                    $genero['name'] = $genus_obj->getName();
                    $genero['type'] = 'genus';

                    $species = array();
                    foreach ($genus_obj->getSpecies() as $key => $species_obj) {

                        $especie = array();
                        $especie['id'] = $species_obj->getId();
                        $especie['name'] = $species_obj->getName();
                        $especie['type'] = 'species';

                        $species[] = $especie;
                    }
                    $genero['children'] = $species;
                    $genuses[] = $genero;
                }
                $familia['children'] = $genuses;
                $families[] = $familia;
            }
            $ordem['children'] = $families;
            $output[] = $ordem;
        }

        // familyList no topo
        foreach ($familyList as $key => $family_obj) {
            $familia = array();
            $familia['id'] = $family_obj->getId();
            $familia['name'] = $family_obj->getName();
            $familia['type'] = 'family';

            $genuses = array();
            foreach ($family_obj->getGenus() as $key => $genus_obj) {

                $genero = array();
                $genero['id'] = $genus_obj->getId();
                $genero['name'] = $genus_obj->getName();
                $genero['type'] = 'genus';

                $species = array();
                foreach ($genus_obj->getSpecies() as $key => $species_obj) {

                    $especie = array();
                    $especie['id'] = $species_obj->getId();
                    $especie['name'] = $species_obj->getName();
                    $especie['type'] = 'species';

                    $species[] = $especie;
                }
                $genero['children'] = $species;
                $genuses[] = $genero;
            }
            $familia['children'] = $genuses;
            $output[] = $familia;
        }


        //genusList no topo
        foreach ($genusList as $key => $genus_obj) {
            $genero = array();
            $genero['id'] = $genus_obj->getId();
            $genero['name'] = $genus_obj->getName();
            $genero['type'] = 'genus';

            $species = array();
            foreach ($genus_obj->getSpecies() as $key => $species_obj) {

                $especie = array();
                $especie['id'] = $species_obj->getId();
                $especie['name'] = $species_obj->getName();
                $especie['type'] = 'species';

                $species[] = $especie;
            }
            $genero['children'] = $species;
            $output[] = $genero;
        }

        return new JsonResponse($output);
    }

    // public function testsAction() {
    //     return $this->render('SkaphandrusAppBundle:Identification:test.html.twig');
    // }
}
