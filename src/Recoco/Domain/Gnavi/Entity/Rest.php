<?php
namespace Recoco\Domain\Gnavi\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

use CrEOF\Spatial\PHP\Types\Geometry\Point;

/**
 * @ORM\Entity
 * @ORM\Table(name="Rest", indexes={
 * @ORM\Index(columns={"latlng"}, flags={"SPATIAL"})
 * })
 */
class Rest {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(name="gnavi_id", type="string", length=255, unique=true)
     *
     * @Assert\NotBlank()
     */
    private $gnaviId;
    /**
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $name;
    /**
     * @ORM\Column(name="name_kana", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $nameKana;
    /**
     * @ORM\Column(name="tel", type="string", length=20)
     *
     */
    private $tel;
    /**
     * @ORM\Column(name="address", type="string", length=255)
     *
     */
    private $address;

    /**
    * @var Point 座標
    * @ORM\Column(name="latlng", type="geometry")
    */
    private $latlng;

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
     * Set gnaviId
     *
     * @param string $gnaviId
     *
     * @return Rest
     */
    public function setGnaviId($gnaviId)
    {
        $this->gnaviId = $gnaviId;

        return $this;
    }

    /**
     * Get gnaviId
     *
     * @return string
     */
    public function getGnaviId()
    {
        return $this->gnaviId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Rest
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set nameKana
     *
     * @param string $nameKana
     *
     * @return Rest
     */
    public function setNameKana($nameKana)
    {
        $this->nameKana = $nameKana;

        return $this;
    }

    /**
     * Get nameKana
     *
     * @return string
     */
    public function getNameKana()
    {
        return $this->nameKana;
    }

    /**
     * Set tel
     *
     * @param string $tel
     *
     * @return Rest
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Rest
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set latlng
     *
     * @param geometry $latlng
     *
     * @return Rest
     */
    public function setLatlng(Point $latlng)
    {
        $this->latlng = $latlng;

        return $this;
    }

    /**
     * Get latlng
     *
     * @return geometry
     */
    public function getLatlng()
    {
        return $this->latlng;
    }
}
