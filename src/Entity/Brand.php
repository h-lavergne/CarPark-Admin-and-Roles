<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BrandRepository")
 */
class Brand
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $wording;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CarModel", mappedBy="brand")
     */
    private $carModels;

    public function __construct()
    {
        $this->carModels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    /**
     * @return Collection|CarModel[]
     */
    public function getCarModels(): Collection
    {
        return $this->carModels;
    }

    public function addCarModel(CarModel $carModel): self
    {
        if (!$this->carModels->contains($carModel)) {
            $this->carModels[] = $carModel;
            $carModel->setBrand($this);
        }

        return $this;
    }

    public function removeCarModel(CarModel $carModel): self
    {
        if ($this->carModels->contains($carModel)) {
            $this->carModels->removeElement($carModel);
            // set the owning side to null (unless already changed)
            if ($carModel->getBrand() === $this) {
                $carModel->setBrand(null);
            }
        }

        return $this;
    }
}
