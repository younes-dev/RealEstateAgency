<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class PropertySearch
 * @package App\Entity
 */
class PropertySearch
{

    /**
     * @var int/null
     * @Assert\Range(
     *      min = 100,
     *      max = 90000,
     *      notInRangeMessage = "The Price must be between {{ min }} € and {{ max }} € tall to Search",
     * )
     */
    private $maxPrice;

    /**
     * @var int/null
     */
    private $minSurface;

    /**
     * @var int/null
     */
    private $maxSurface;

    /**
     * @var ArrayCollection
     */
    private $options;

    /**
     * PropertySearch constructor.
     */
    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int $maxPrice
     * @return PropertySearch
     */
    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * @param int $minSurface
     * @return PropertySearch
     */
    public function setMinSurface(int $minSurface): self
    {
        $this->minSurface = $minSurface;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxSurface(): ?int
    {
        return $this->maxSurface;
    }

    /**
     * @param int $maxSurface
     * @return PropertySearch
     */
    public function setMaxSurface(int $maxSurface): self
    {
        $this->maxSurface = $maxSurface;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions(): ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }


}