<?php
namespace Heating\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="wp_data")
 */
class Measurement {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="float", nullable=true) 
     */
    protected $FailureTempFlow;
    
    public function setId($id) {
        $this->id = $id;
    }
    public function getId() {
        return $this->id;
    }
    
    public function setFailureTempFlow($FailureTempFlow) {
        $this->FailureTempFlow = $FailureTempFlow;
    }
    public function getFailureTempFlow() {
        return $this->FailureTempFlow;
    }
}
