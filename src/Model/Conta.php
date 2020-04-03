<?php

namespace MimMarcelo\ContaContas\Model;

use MimMarcelo\ContaContas\Helper\{EntityManager, JSON, Validador};

/**
 * @Entity(repositoryClass="MimMarcelo\ContaContas\Repository\ContaRepository")
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
     * @Column(type="datetime")
     * @var type \DateTime
     */
    private $dataAplicacao;
    /**
     * @Column(type="datetime")
     * @var type \DateTime
     */
    private $dataUltimaAlteracao;

    /**
     * @ManyToOne(targetEntity="ClasseConta", inversedBy="contas", cascade={"remove", "persist"}, fetch="EAGER")
     * @var type ClasseConta
     */
    private $classe;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function getDataAplicacao(): \DateTime
    {
        return $this->dataAplicacao;
    }

    public function getClasse(): ClasseConta
    {
        return $this->classe;
    }

    public function setId(int $id): ?Conta
    {
        if (Conta::validarId($id)) {
            $this->id = $id;
            return $this;
        }
        return null;
    }

    public function setNome($nome): ?Conta
    {
        $this->nome = $nome;
        return $this;
    }

    public function setValor($valor): ?Conta
    {
        $this->valor = $valor;
        return $this;
    }

    public function setClasse($classe): ?Conta
    {
        if($classe instanceof ClasseConta){
            $this->classe = $classe;
            return $this;
        }
        if(Conta::validarId($classe)){
            $this->classe = ClasseConta::get($classe);
            return $this;
        }
        return null;
    }

    public function setDataAplicacao($dataAplicacao): ?Conta
    {
        $this->dataAplicacao = $dataAplicacao;
        return $this;
    }

    public static function getAll($dInicial, $dFinal): Periodo
    {
        $entityManager = EntityManager::getEntityManager();
        $repositorio = $entityManager->getRepository(Conta::class);

        return new Periodo($repositorio->getContasPorPeriodo($dInicial, $dFinal));
    }

    public static function get($id): ?Conta
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

    public static function salvar(array $params): ?Conta
    {
        extract($params);
        $entityManager = EntityManager::getEntityManager();
        $conta = new Conta();
        $conta->setNome($nome);
        $conta->setValor($valor);
        $conta->setClasse($classe);
        $conta->setDataAplicacao(new \DateTime($dataAplicacao));
        $conta->dataUltimaAlteracao = new \DateTime();

        if ($conta->setId($id)) {
            $entityManager->merge($conta);
        }
        else{
            $entityManager->persist($conta);
        }

        $entityManager->flush();

        return $conta;
    }

    public static function remover($id): ?Conta
    {
        $conta = Conta::get($id);
        if(is_null($conta)){
            return null;
        }

        $entityManager = EntityManager::getEntityManager();
        $entityManager->remove($conta);
        $entityManager->flush();

        return $conta;
    }
}
