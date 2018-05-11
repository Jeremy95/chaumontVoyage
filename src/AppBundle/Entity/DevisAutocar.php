<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * DevisAutocar
 *
 * @ORM\Table(name="devis_autocar")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DevisAutocarRepository")
 */
class DevisAutocar extends AbstractDevis
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="society", type="string", length=255)
     */
    private $society;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity", type="integer")
     */
    private $capacity;

    /**
     * @var array|null
     *
     * @ORM\Column(name="equipment", type="array", nullable=true)
     */
    private $equipment;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departDate", type="datetime")
     */
    private $departDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrivedDate", type="datetime")
     */
    private $arrivedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="locationTake", type="string", length=255)
     */
    private $locationTake;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=255)
     */
    private $destination;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departHour", type="datetime")
     */
    private $departHour;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrivedHour", type="datetime")
     */
    private $arrivedHour;

    /**
     * @var string
     *
     * @ORM\Column(name="documents", type="string", length=255)
     */
    private $documents;

    /**
     * @Assert\File(
     *      maxSize="1000k",
     *      mimeTypes = {"image/png", "image/jpeg", "image/gif"}
     * )
     */
    public $files;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set society.
     *
     * @param string $society
     *
     * @return DevisAutocar
     */
    public function setSociety($society)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society.
     *
     * @return string
     */
    public function getSociety()
    {
        return $this->society;
    }

    /**
     * Set capacity.
     *
     * @param int $capacity
     *
     * @return DevisAutocar
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity.
     *
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set equipment.
     *
     * @param array|null $equipment
     *
     * @return DevisAutocar
     */
    public function setEquipment($equipment = null)
    {
        $this->equipment = $equipment;

        return $this;
    }

    /**
     * Get equipment.
     *
     * @return array|null
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * Set departDate.
     *
     * @param \DateTime $departDate
     *
     * @return DevisAutocar
     */
    public function setDepartDate($departDate)
    {
        $this->departDate = $departDate;

        return $this;
    }

    /**
     * Get departDate.
     *
     * @return \DateTime
     */
    public function getDepartDate()
    {
        return $this->departDate;
    }

    /**
     * Set arrivedDate.
     *
     * @param \DateTime $arrivedDate
     *
     * @return DevisAutocar
     */
    public function setArrivedDate($arrivedDate)
    {
        $this->arrivedDate = $arrivedDate;

        return $this;
    }

    /**
     * Get arrivedDate.
     *
     * @return \DateTime
     */
    public function getArrivedDate()
    {
        return $this->arrivedDate;
    }

    /**
     * Set locationTake.
     *
     * @param string $locationTake
     *
     * @return DevisAutocar
     */
    public function setLocationTake($locationTake)
    {
        $this->locationTake = $locationTake;

        return $this;
    }

    /**
     * Get locationTake.
     *
     * @return string
     */
    public function getLocationTake()
    {
        return $this->locationTake;
    }

    /**
     * Set destination.
     *
     * @param string $destination
     *
     * @return DevisAutocar
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination.
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set departHour.
     *
     * @param \DateTime $departHour
     *
     * @return DevisAutocar
     */
    public function setDepartHour($departHour)
    {
        $this->departHour = $departHour;

        return $this;
    }

    /**
     * Get departHour.
     *
     * @return \DateTime
     */
    public function getDepartHour()
    {
        return $this->departHour;
    }

    /**
     * Set arrivedHour.
     *
     * @param \DateTime $arrivedHour
     *
     * @return DevisAutocar
     */
    public function setArrivedHour($arrivedHour)
    {
        $this->arrivedHour = $arrivedHour;

        return $this;
    }

    /**
     * Get arrivedHour.
     *
     * @return \DateTime
     */
    public function getArrivedHour()
    {
        return $this->arrivedHour;
    }

    /**
     * Set documents.
     *
     * @param string $documents
     *
     * @return DevisAutocar
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;

        return $this;
    }

    /**
     * Get documents.
     *
     * @return string
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Upload documents.
     */
    public function uploadDocuments() {
        if (null === $this->files) {
            return;
        }

        $this->documents = sha1(uniqid(mt_rand(), true)) . '.' . $this->files->guessExtension();
        $this->files->move($this->getUploadRootDirAvatar(), $this->documents);

        unset($this->files);
    }
}
