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

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var type int
     */
    private $id;
    /**
     * @Column(type="string", length=100)
     * @var type string
     */
    private $nome;
    /**
     * @Column(type="decimal", precision=10, scale=2)
     * @var type double
     */
    private $valor;
    /**
     * @Column(type="boolean", options={"default" : false})
     * @var type bool
     */
    private $receita;
    /**
     * @Column(type="datetime", options={"default" : "2020/01/01 00:00:00"})
     * @var type \DateTime
     */
    private $dataAplicacao;
    /**
     * @Column(type="datetime", options={"default" : "2020/01/01 00:00:00"})
     * @var type \DateTime
     */
    private $dataUltimaAlteracao;

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

    public function setReceita($receita)
    {
        $this->receita = is_null($receita)?false:$receita;
        return $this;
    }

    public function setDataAplicacao($dataAplicacao)
    {
        $this->dataAplicacao = $dataAplicacao;
        return $this;
    }

    public static function getAll(): Periodo
    {
        $entityManager = EntityManager::getEntityManager();
        $repositorio = $entityManager->getRepository(Conta::class);

        return new Periodo($repositorio->findAll());
    }

    public static function getConta($id): ?Conta
    {
        if (!Conta::validarId($id)) {
            return null;
        }

        $entityManager = EntityManager::getEntityManager();
        $conta = $entityManager->find(Conta::class, $id);
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

        $entityManager = EntityManager::getEntityManager();
        $entityManager->remove($conta);
        $entityManager->flush();

        return $conta;
    }

    public static function salvar(array $params): ?Conta
    {
        extract($params);
        $entityManager = EntityManager::getEntityManager();
        $conta = new Conta();
        $conta->setNome($nome);
        $conta->setValor($valor);
        $conta->setReceita($receita);
        $conta->setDataAplicacao(new \DateTime($dataAplicacao));
        $conta->dataUltimaAlteracao = new \DateTime();

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
