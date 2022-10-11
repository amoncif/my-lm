<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?bool $agreedToTerms = null;

    #[ORM\Column(length: 255)]
    private ?string $paymentType = null;

    #[ORM\ManyToOne(inversedBy: 'payments')]
    #[ORM\JoinTable(name: "customer_order")]
    #[ORM\JoinColumn(name: 'order_number' , referencedColumnName:'order_number' )]
    #[ORM\JoinColumn(name: 'customer_number' , referencedColumnName:'customer_number' )]
    private ?CustomerOrder $customerOrder = null;

    #[ORM\OneToMany(mappedBy: 'payment', targetEntity: PaymentStatus::class)]
    private Collection $paymentStatuses;

    public function __construct()
    {
        $this->paymentStatuses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function isAgreedToTerms(): ?bool
    {
        return $this->agreedToTerms;
    }

    public function setAgreedToTerms(bool $agreedToTerms): self
    {
        $this->agreedToTerms = $agreedToTerms;

        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    public function setPaymentType(string $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getCustomerOrder(): ?CustomerOrder
    {
        return $this->customerOrder;
    }

    public function setCustomerOrder(?CustomerOrder $customerOrder): self
    {
        $this->customerOrder = $customerOrder;

        return $this;
    }

    /**
     * @return Collection<int, PaymentStatus>
     */
    public function getPaymentStatuses(): Collection
    {
        return $this->paymentStatuses;
    }

    public function addPaymentStatus(PaymentStatus $paymentStatus): self
    {
        if (!$this->paymentStatuses->contains($paymentStatus)) {
            $this->paymentStatuses->add($paymentStatus);
            $paymentStatus->setPayment($this);
        }

        return $this;
    }

    public function removePaymentStatus(PaymentStatus $paymentStatus): self
    {
        if ($this->paymentStatuses->removeElement($paymentStatus)) {
            // set the owning side to null (unless already changed)
            if ($paymentStatus->getPayment() === $this) {
                $paymentStatus->setPayment(null);
            }
        }

        return $this;
    }
}
