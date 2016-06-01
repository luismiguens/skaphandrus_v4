<?php

namespace Skaphandrus\AppBundle\Controller;

use Skaphandrus\AppBundle\Entity\SkAddress;
use Skaphandrus\AppBundle\Entity\SkBusiness;
use Skaphandrus\AppBundle\Entity\SkBusinessFosUser;
use Skaphandrus\AppBundle\Entity\FosUser;
use Skaphandrus\AppBundle\Entity\SkContact;
use Skaphandrus\AppBundle\Form\SkBusinessFosUserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * SkBusiness controller.
 *
 */
class SkBusinessFosUserController extends Controller {

    public function sendRegistrationEmail(SkBusinessFosUser $businessFosUser, SkBusiness $business) {
        $message = \Swift_Message::newInstance()
                ->setSubject("Thanks for registering " . $businessFosUser->getBusinessName())
                ->setFrom('noreply-registration@skaphandrus.com', 'Skaphandrus')
                ->setTo($businessFosUser->getEmail())
                ->setBcc('partnerships@skaphandrus.com')
                ->setBody(
                $this->renderView(
                        'SkaphandrusAppBundle:SkBusinessFosUser:registrationBusinessFosUser.html.twig', array(
                    'businessFosUser' => $businessFosUser,
                    'business' => $business,
                )), 'text/html'
                )
        ;

        $this->get('mailer')->send($message);
    }

    public function regionsAction(Request $request) {
        $country_id = $request->get('country_id');

        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository('SkaphandrusAppBundle:SkRegion')->findBy(array('country' => $country_id));

        $array = array();
        foreach ($regions as $key => $region):
            $array[$key]['id'] = $region->getId();
            $array[$key]['name'] = $region->getName();
        endforeach;

        return new JsonResponse($array);
    }

    public function locationsAction(Request $request) {
        $region_id = $request->get('region_id');

        $em = $this->getDoctrine()->getManager();
        $locations = $em->getRepository('SkaphandrusAppBundle:SkLocation')->findBy(array('region' => $region_id));

        $array = array();
        foreach ($locations as $key => $location):
            $array[$key]['id'] = $location->getId();
            $array[$key]['name'] = $location->getName();
        endforeach;

        return new JsonResponse($array);
    }

    /**
     * Creates a new SkBusiness entity.
     *
     */
    public function createAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $entity = new SkBusinessFosUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $businessFosUser = $form->getData();
            $business = new SkBusiness();
            $user = new FosUser();

            //
            //criar utilizar
            //
            //to use in username
            $date = date_create();
            //username = timestamp
            $username = date_timestamp_get($date);

            //user settings
            $settings = new \Skaphandrus\AppBundle\Entity\SkSettings();
            $settings->setFosUser($user);
            $emailNotificationTime = $this->getDoctrine()->getRepository("SkaphandrusAppBundle:SkEmailNotificationTime")->findOneById(1);
            $settings->setEmailNotificationTime($emailNotificationTime);
            $user->setSettings($settings);
            $em->persist($settings);

            //set encoded password
            $factory = $this->get('security.encoder_factory');
            $encoder = $factory->getEncoder($user);
            $password = $encoder->encodePassword($businessFosUser->getPassword(), $user->getSalt());
            $user->setPassword($password);

            //firstname and lastname
            $name = explode(" ", $businessFosUser->getName());

            $firstName = $name[0];
            $middleName = NULL;
            $lastName = NULL;
            //se preencher tres nomes
            if (array_key_exists(2, $name)) {
                $middleName = $name[1];
                $lastName = $name[2];

                //se preencher dois nomes     
            } elseif (array_key_exists(1, $name)) {
                $lastName = $name[1];
            }

            $personal = new \Skaphandrus\AppBundle\Entity\SkPersonal();
            $personal->setFirstname($firstName);
            $personal->setMiddlename($middleName);
            $personal->setLastname($lastName);
            $personal->setHonorific("Scuba Diver");
            $personal->setFosUser($user);
            $user->setPersonal($personal);
            $em->persist($personal);

            //user username and email
            $user->setUsername($username);
            $user->setUsernameCanonical($username);
            $user->setEmail($businessFosUser->getEmail());
            $user->setEmailCanonical($businessFosUser->getEmail());
            $user->setEnabled(true);
            $user->setLocked(false);
            $user->setExpired(false);
            $user->setCredentialsExpired(false);
            $em->persist($user);

            //
            //criar empresa
            //
            $business->setName($businessFosUser->getBusinessName());

            $contact = new SkContact();
            $contact->setEmail($businessFosUser->getBusinessEmail());
            $business->setContact($contact);
            $em->persist($contact);

            $address = new SkAddress();
            $address->setLocation($businessFosUser->getLocation());
            $business->setAddress($address);
            $em->persist($address);

            //
            //associar empresa ao utilizador
            //
            $business->addAdmin($user);

            $em->persist($business);
            $em->flush();

            //enviar email para utilizador com dados de user e da empresa (colocar partnerships@skaphandrus.com em cc)
            $this->sendRegistrationEmail($entity, $business);

            //
            //autenticar utilizador
            //
            $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($user, $user->getPassword(), 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));

            //encaminha para a edição total da empresa
            return $this->redirect($this->generateUrl('business_admin_edit', array('id' => $business->getId())));
        }

        return $this->render('SkaphandrusAppBundle:SkBusinessFosUser:newBusinessFosUser.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a SkBusiness entity.
     *
     * @param SkBusiness $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(SkBusinessFosUser $entity) {
        $form = $this->createForm(new SkBusinessFosUserType(), $entity, array(
            'action' => $this->generateUrl('business_fos_user_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SkBusiness entity.
     *
     */
    public function newAction() {
        $entity = new SkBusinessFosUser();
        $form = $this->createCreateForm($entity);

        return $this->render('SkaphandrusAppBundle:SkBusinessFosUser:newBusinessFosUser.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

}
