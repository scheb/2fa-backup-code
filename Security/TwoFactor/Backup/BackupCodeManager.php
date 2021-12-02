<?php

declare(strict_types=1);

namespace Scheb\TwoFactorBundle\Security\TwoFactor\Backup;

use Scheb\TwoFactorBundle\Model\BackupCodeInterface;
use Scheb\TwoFactorBundle\Model\PersisterInterface;

/**
 * @final
 */
class BackupCodeManager implements BackupCodeManagerInterface
{
    public function __construct(private PersisterInterface $persister)
    {
    }

    public function isBackupCode($user, string $code): bool
    {
        if ($user instanceof BackupCodeInterface) {
            return $user->isBackupCode($code);
        }

        return false;
    }

    public function invalidateBackupCode($user, string $code): void
    {
        if ($user instanceof BackupCodeInterface) {
            $user->invalidateBackupCode($code);
            $this->persister->persist($user);
        }
    }
}
