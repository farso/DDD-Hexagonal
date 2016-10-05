<?php
//1.0.2
namespace UicBundle\Domain\Entity\TipusCentre;

use UicBundle\Domain\Entity\TipusCentre\TipusCentreId;


/**
 * TipusCentre
 */
class TipusCentre  implements TipusCentreInterface
{
    /**
     * @var TipusCentreId
     */
    protected $id;

    /**
     * @var string
     */
    protected $descriCat;

    /**
     * @var string
     */
    protected $descriEsp;

    /**
     * @var string
     */
    protected $descriEng;


    public function __construct(TipusCentreId $id, $descriCat, $descriEsp, $descriEng)
    {
        $this->id = $id;
        $this->descriEsp = $descriEsp;
        $this->descriCat = $descriCat;
        $this->descriEng = $descriEng;
    }


    /**
     * Get id
     *
     * @return TipusCentreId
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get descriCat
     *
     * @return string
     */
    public function getDescriCat()
    {
        return $this->descriCat;
    }

    /**
     * Get descriEspOficial
     *
     * @return string
     */
    public function getDescriEsp()
    {
        return $this->descriEsp;
    }

    /**
     * Get descriEng
     *
     * @return string
     */
    public function getDescriEng()
    {
        return $this->descriEng;
    }



    public function update($descriCat, $descriEsp, $descriEng) {

        //@todo validació atributs d'entitat (que siguin enters, char(1), ...)
        $this->descriCat = $descriCat;
        $this->descriEsp = $descriEsp;        
        $this->descriEng = $descriEng;
    }

}

