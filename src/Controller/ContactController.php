<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $formContact = $this->createForm(ContactFormType::class, $contact);
        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()){

            $contact->setSendAt(new \DateTime());
            $entityManager->persist($contact);
            $entityManager->flush();


            $message = nl2br($contact->getMessage());


            $email = (new Email())
            ->from($contact->getMail())
            ->to('contact@jjtech.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($contact->getSubject())
            // ->text('Sending emails is fun again!')
            ->html('<h3> ' . $contact->getFirstname() . ' ' . $contact->getLastname() . '</h3>
            <p>' . $message . '</p>');

            $mailer->send($email);

            $this->addFlash('success', 'Votre demande de contact a bien été pris en compte,
             nous reviendrons vers vous dans les plus bref délais !');
            $this->redirectToRoute('app_contact');

        }


        return $this->render('contact/contact.html.twig', [
            'formContact' => $formContact,
        ]);
    }
}
