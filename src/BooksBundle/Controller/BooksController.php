<?php

namespace BooksBundle\Controller;

use BooksBundle\Entity\Books;
use BooksBundle\Form\TypeBook;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BooksController extends Controller
{
    /**
     * @Route("/", name="books_list")
     */
    public function indexAction()
    {

        return $this->render('BooksBundle:Books:index.html.twig', array(
            'books' => $this->getDoctrine()->getRepository('BooksBundle:Books')->findAll()
        ));
    }

    /**
     * @Route("/new", name="books_new")
     */
    public function newAction()
    {
        $book = new Books();

        $form = $this->createCreateForm($book);

        return $this->render('BooksBundle:Books:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/show", name="books_show")
     *
     */
    public function showAction($id)
    {
        return $this->render('BooksBundle:Books:show.html.twig', array(
            'book' => $this->getDoctrine()->getRepository('BooksBundle:Books')->find($id),
        ));
    }

    /**
     * @Route("/create", name="books_create")
     *
     * @Method(methods={"POST"})
     *
     */
    public function createAction(Request $request)
    {
        $book = new Books();

        $form = $this->createCreateForm($book);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            $this->addFlash('notice', 'Book was added');

            return $this->redirectToRoute('books_show', array('id' => $book->getId()));
        }

        $this->addFlash('notice', 'Something went wrong!');

        return $this->render('BooksBundle:Books:new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/edit", name="books_edit")
     *
     */
    public function editAction($id)
    {
        $book = $this->getDoctrine()->getRepository('BooksBundle:Books')->find($id);

        $form = $this->createEditForm($book);

        return $this->render('BooksBundle:Books:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/update", name="books_update")
     *
     * @Method(methods={"PUT","POST"})
     *
     */
    public function updateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $book = $em->getRepository('BooksBundle:Books')->find($id);

        $form = $this->createEditForm($book);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->flush();

            $this->addFlash('notice', 'Book was updated');

            return $this->redirectToRoute('books_show', array('id' => $book->getId()));
        }

        $this->addFlash('notice', 'Something went wrong');

        return $this->render('BooksBundle:Books:show.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/delete", name="books_delete")
     *
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository('BooksBundle:Books')->find($id);

        $em->remove($book);
        $em->flush();

        return $this->redirectToRoute('books_list');

    }

    private function createCreateForm(Books $book)
    {
        $form = $this->createForm(TypeBook::class, $book, array(
            'action' => $this->generateUrl('books_create'),
            'method' => 'POST',
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Create new Book'));

        return $form;
    }

    private function createEditForm($book)
    {
        $form = $this->createForm(TypeBook::class, $book, array(
            'action' => $this->generateUrl('books_update', array('id' => $book->getId())),
            'method' => 'PUT'
        ));

        $form->add('submit', SubmitType::class, array('label' => 'Update Book'));

        return $form;
    }
}