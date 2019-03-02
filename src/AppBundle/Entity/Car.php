<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CarRepository")
 * @ORM\Table(name="car")
 */

class Car {

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="make", type="string")
     */
    private $make;

    /**
     * @ORM\Column(name="model", type="string")
     */
    private $model;

    /**
     * @ORM\Column(name="produced_at", type="date")
     */
    private $producedAt;

    /**
     * @ORM\Column(name="engine_size", type="decimal")
     */
    private $engineSize;

    /**
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * Many Cars have Many Categories.
     * @ORM\ManyToMany(targetEntity="CarCategory", inversedBy="cars")
     * @ORM\JoinTable(name="cars_categories")
     */
    private $categories;

    public function __construct() {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set make
     *
     * @param string $make
     *
     * @return Car
     */
    public function setMake($make)
    {
        $this->make = $make;

        return $this;
    }

    /**
     * Get make
     *
     * @return string
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * Set model
     *
     * @param string $model
     *
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set producedAt
     *
     * @param \DateTime $producedAt
     *
     * @return Car
     */
    public function setProducedAt($producedAt)
    {
        $this->producedAt = $producedAt;

        return $this;
    }

    /**
     * Get producedAt
     *
     * @return \DateTime
     */
    public function getProducedAt()
    {
        return $this->producedAt;
    }

    /**
     * Set engineSize
     *
     * @param string $engineSize
     *
     * @return Car
     */
    public function setEngineSize($engineSize)
    {
        $this->engineSize = $engineSize;

        return $this;
    }

    /**
     * Get engineSize
     *
     * @return string
     */
    public function getEngineSize()
    {
        return $this->engineSize;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Car
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * Add category
     *
     * @param \AppBundle\Entity\CarCategory $category
     *
     * @return Car
     */
    public function addCategory(\AppBundle\Entity\CarCategory $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\CarCategory $category
     */
    public function removeCategory(\AppBundle\Entity\CarCategory $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Car
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
