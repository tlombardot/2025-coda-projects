<?php

namespace App\Entity;

use App\Entity\Impl\BaseEntity;
use App\Repository\WalletRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: WalletRepository::class)]
class Wallet extends BaseEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::GUID, unique: true)]
    private ?string $uuid = null;

    #[ORM\Column(options: ['default' => 0])]
    private ?int $totalAmount = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: Types::JSON, options: ['default' => '[]'])]
    private array $paymentsDue = [];

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTime $settledAt = null;

    public function __construct()
    {
        $this->uuid = Uuid::v4()->toRfc4122();
        $this->paymentsDue = [];
        $this->totalAmount = 0;
        $this->createdDate = new \DateTime();
        $this->isDeleted = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): static
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getTotalAmount(): ?int
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(int $totalAmount): static
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getPaymentsDue(): array
    {
        return $this->paymentsDue;
    }

    public function setPaymentsDue(array $paymentsDue): static
    {
        $this->paymentsDue = $paymentsDue;

        return $this;
    }

    public function getSettledAt(): ?\DateTime
    {
        return $this->settledAt;
    }

    public function setSettledAt(?\DateTime $settledAt): static
    {
        $this->settledAt = $settledAt;

        return $this;
    }
    
}
