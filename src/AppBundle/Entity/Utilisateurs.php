<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Utilisateurs
 *
 * @ORM\Table(name="utilisateurs")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UtilisateursRepository")
 */
class Utilisateurs
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
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;
    
    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type;
    
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide.",
     *     checkMX = true
     *  )
     */
    private $email;

    /**
     * @var int
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=true)
     * @Assert\Length(
     *      min = 5,
     *      max = 5,
     *     exactMessage = "Le code postal n'est pas valide."
     * )
     */
    private $codePostal;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=50, nullable=true)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=12, nullable=true)
     * @Assert\Regex(
     *     pattern="#^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$#",
     *     message="Le numéro de téléphone n'est pas valide."
     * )
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="ecole", type="string", length=255, nullable=true)
     */
    private $ecole;

    /**
     * @var string
     *
     * @ORM\Column(name="diplome", type="string", length=255, nullable=true)
     */
    private $diplome;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau_detude", type="string", length=255, nullable=true)
     */
    private $niveauDetude;
    
    /**
     * @var int
     *
     * @ORM\Column(name="offre", type="integer", nullable=true)
     */
    private $offre;

    /**
     * @var string
     * @ORM\Column(name="cv_url", type="string", length=255, nullable=true)
     */
    private $cv;

    /**
     * @var string
     * @ORM\Column(name="bulletins_url", type="string", length=255, nullable=true)
     */
    private $bulletins;

    /**
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Merci d'uploader un CV au format PDF"
     * )
     */
    public $cvTempFile;

    /**
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Merci d'uploader vos bulletins au format PDF"
     * )
     */
    public $bulletinsTempFile;


    public function getCVUploadDir()
    {
        return 'uploads/cv';
    }

    protected function getCVUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getCVUploadDir();
    }

    public function getCVWebPath()
    {
        return null === $this->cv ? null : $this->getCVUploadDir().'/'.$this->cv;
    }

    public function getCVAbsolutePath()
    {
        return null === $this->cv ? null : $this->getCVUploadRootDir().'/'.$this->cv;
    }


    public function getBulletinsUploadDir()
    {
        return 'uploads/bulletins';
    }

    protected function getBulletinsUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getBulletinsUploadDir();
    }

    public function getBulletinsWebPath()
    {
        return null === $this->bulletins ? null : $this->getBulletinsUploadDir().'/'.$this->cv;
    }

    public function getBulletinsAbsolutePath()
    {
        return null === $this->bulletins ? null : $this->getBulletinsUploadRootDir().'/'.$this->cv;
    }

    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if (null !== $this->cvTempFile) {
            // do whatever you want to generate a unique name
            $this->cv = uniqid().'.'.$this->cvTempFile->guessExtension();
        }
        if (null !== $this->bulletinsTempFile) {
            // do whatever you want to generate a unique name
            $this->bulletins = uniqid().'.'.$this->bulletinsTempFile->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist
     */
    public function upload()
    {
        if (null !== $this->cv) {
            $this->cvTempFile->move($this->getCVUploadRootDir(), $this->cv);
        }
        if (null !== $this->bulletins) {
            $this->bulletinsTempFile->move($this->getBulletinsUploadRootDir(), $this->bulletins);
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error

        //unlink($this->cvTempFile);
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        if ($file = $this->getCVAbsolutePath()) {
            unlink($file);
        }
        if ($file = $this->getBulletinsAbsolutePath()) {
            unlink($file);
        }
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
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateurs
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateurs
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Utilisateurs
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set codePostal
     *
     * @param integer $codePostal
     * @return Utilisateurs
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return integer 
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Utilisateurs
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Utilisateurs
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set ecole
     *
     * @param string $ecole
     * @return Utilisateurs
     */
    public function setEcole($ecole)
    {
        $this->ecole = $ecole;

        return $this;
    }

    /**
     * Get ecole
     *
     * @return string 
     */
    public function getEcole()
    {
        return $this->ecole;
    }

    /**
     * Set diplome
     *
     * @param string $diplome
     * @return Utilisateurs
     */
    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;

        return $this;
    }

    /**
     * Get diplome
     *
     * @return string 
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * Set niveauDetude
     *
     * @param string $niveauDetude
     * @return Utilisateurs
     */
    public function setNiveauDetude($niveauDetude)
    {
        $this->niveauDetude = $niveauDetude;

        return $this;
    }

    /**
     * Get niveauDetude
     *
     * @return string 
     */
    public function getNiveauDetude()
    {
        return $this->niveauDetude;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getOffre()
    {
        return $this->offre;
    }

    /**
     * @param int $offre
     */
    public function setOffre($offre)
    {
        $this->offre = $offre;
    }

    /**
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * @param string $cv
     */
    public function setCv($cv)
    {
        $this->cv = $cv;
    }

    /**
     * @return string
     */
    public function getBulletins()
    {
        return $this->bulletins;
    }

    /**
     * @param string $bulletins
     */
    public function setBulletins($bulletins)
    {
        $this->bulletins = $bulletins;
    }
}
