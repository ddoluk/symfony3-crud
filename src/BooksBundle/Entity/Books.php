<?php

namespace BooksBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="books")
 */
class Books
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="5",max="64")
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min="5",max="64")
     */
    private $book_name;

    /**
     * @ORM\Column(type="decimal", scale=2)
     *
     * @Assert\NotBlank()
     * @Assert\Type(type="decimal")
     */
    private $price;

    /**
     * @ORM\Column(type="date")
     */
    private $published;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Books
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set bookName
     *
     * @param string $bookName
     *
     * @return Books
     */
    public function setBookName($bookName)
    {
        $this->book_name = $bookName;

        return $this;
    }

    /**
     * Get bookName
     *
     * @return string
     */
    public function getBookName()
    {
        return $this->book_name;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Books
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set published
     *
     * @param \DateTime $published
     *
     * @return Books
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return \DateTime
     */
    public function getPublished()
    {
        return $this->published;
    }
}
