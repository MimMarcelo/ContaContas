<?php

namespace MimMarcelo\ContaContas\Model;

use \MimMarcelo\ContaContas\Helper\{JSON, EntityManager, Validador};

/**
 * @Entity
 * @Table(name="contas")
 */
class Conta
{
    use JSON;
    use Validador;
    use EntityManager;

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var type int
     */
    private $id;
    /**
     * @Column(type="string")
     * @var type string
     */
    private $nome;
    /**
     * @Column(type="decimal", precision=10, scale=2)
     * @var type double
     */
    private $valor;

    function __construct($nome = "", $valor = 0, $id = 0)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->valor = $valor;
    }

    public function __get(string $atributo)
    {
        return $this->$atributo;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    public static function getAll(): array
    {
        $entityManager = Conta::getEntityManager();
        $repositorio = $entityManager->getRepository(Conta::class);

        return $repositorio->findAll();
    }

    public static function getConta($id): ?Conta
    {
        if (!Conta::validarId($id)) {
            return null;
        }

        $entityManager = Conta::getEntityManager();
        $repositorio = $entityManager->getRepository(Conta::class);
        $conta = $repositorio->findOneBy(['id' => $id]);
        if(is_null($conta)){
            return null;
        }

        return $conta;
    }

    public static function remover($id): ?Conta
    {
        $conta = Conta::getConta($id);
        if(is_null($conta)){
            return null;
        }

        $entityManager = Conta::getEntityManager();
        $referencia = $entityManager->getReference(Conta::class, $id);
        
        $entityManager->remove($referencia);
        $entityManager->flush();

        return $conta;
    }

    public static function salvar($id, $nome, $valor): ?Conta
    {
        $entityManager = Conta::getEntityManager();
        $conta = new Conta();
        $conta->setNome($nome);
        $conta->setValor($valor);

        if (Conta::validarId($id)) {
            $conta->setId($id);
            $entityManager->merge($conta);
        }
        else{
            $entityManager->persist($conta);
        }

        $entityManager->flush();

        return $conta;
    }
}
