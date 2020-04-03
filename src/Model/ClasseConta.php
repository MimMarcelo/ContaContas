<?php

namespace MimMarcelo\ContaContas\Model;

use MimMarcelo\ContaContas\Helper\{EntityManager, JSON, Validador};

/**
 * @Entity
 * @Table(name="classes_conta")
 */
class ClasseConta
{
    use JSON;
    use Validador;

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var type int
     */
    private $id;
    /**
     * @Column(type="string", length=4)
     * @var type string
     */
    public $sigla;
    /**
     * @Column(type="string", length=60)
     * @var type string
     */
    private $nome;
    /**
     * @Column(type="integer")
     * @var type int
     */
    private $tipo;
    /**
     * @Column(type="datetime")
     * @var type \DateTime
     */
    private $dataUltimaAlteracao;

    public function __toString()
    {
        return $this->sigla;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSigla(): string
    {
        return $this->sigla;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getTipo(): string
    {
        switch ($this->tipo) {
            case 1:
                return "C";
                break;
            case 0:
                return "N";
                break;

            default:
                return "D";
                break;
        }
    }

    public function setId(int $id): ?ClasseConta
    {
        if (ClasseConta::validarId($id)) {
            $this->id = $id;
            return $this;
        }
        return null;
    }

    public function setSigla(string $sigla): ?ClasseConta
    {
        $this->sigla = $sigla;
        return $this;
    }

    public function setNome(string $nome): ?ClasseConta
    {
        $this->nome = $nome;
        return $this;
    }

    public function setTipo($tipo): ?ClasseConta
    {
        $this->tipo = $tipo;
        return $this;
    }

    public static function getAll(): array
    {
        $entityManager = EntityManager::getEntityManager();
        $repositorio = $entityManager->getRepository(ClasseConta::class);

        return $repositorio->findAll();
    }

    public static function get($id): ?ClasseConta
    {
        if (!ClasseConta::validarId($id)) {
            return null;
        }

        $entityManager = EntityManager::getEntityManager();
        $classe = $entityManager->find(ClasseConta::class, $id);
        if(is_null($classe)){
            return null;
        }

        return $classe;
    }

    public static function salvar(array $params): ?ClasseConta
    {
        extract($params);
        $entityManager = EntityManager::getEntityManager();

        $classe = new ClasseConta();
        $classe->setSigla($sigla);
        $classe->setNome($nome);
        $classe->setTipo($tipo);
        $classe->dataUltimaAlteracao = new \DateTime();

        if ($classe->setId($id)) {
            $entityManager->merge($classe);
        }
        else{
            $entityManager->persist($classe);
        }

        $entityManager->flush();

        return $classe;
    }

    public static function remover($id): ?ClasseConta
    {
        $classe = ClasseConta::get($id);
        if(is_null($classe)){
            return null;
        }

        $entityManager = EntityManager::getEntityManager();
        $entityManager->remove($classe);
        $entityManager->flush();

        return $classe;
    }
}

 ?>
