<?php

namespace App\Security\Voter;

use App\Entity\Duck;
use App\Entity\Quack;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class QuackVoter extends Voter
{
    const QUACK_EDIT = "quack_edit";
    const QUACK_DELETE = "quack_delete";

    protected function supports(string $attribute, $quack): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::QUACK_EDIT, self::QUACK_DELETE])
            && $quack instanceof \App\Entity\Quack;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        /**
         * @var Quack $quack
         */
       $quack = $subject;

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::QUACK_EDIT:
                // On vérifie si on peut éditer
                return $this->canEdit($quack, $user);
                break;
            case self::QUACK_DELETE:
                // on vérifie si on peut supprimer
                return $this->canDelete($quack, $user);
                break;
        }

        return false;
    }

    private function canEdit(Quack $quack, Duck $duck){
        return $duck->getId() === $quack->getDuck()->getId();
    }

    private function canDelete(Quack $quack, Duck $duck){

    }

}
