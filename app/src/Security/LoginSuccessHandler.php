<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    public function __construct(private UrlGeneratorInterface $urlGenerator) {}

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): RedirectResponse
    {
        $roles = $token->getRoleNames();

        /** @var User $currentUser */
        $currentUser = $token->getUser();

        $isDriverChecked = $request->request->has('_chauffeur');
        $isPassengerChecked = $request->request->has('_passager');

        if ($isDriverChecked) {

            if ($currentUser->getVehicles()->count() > 0) {
                return new RedirectResponse(
                    $this->urlGenerator->generate('app_clients_personal_space')
                );
            }

            return new RedirectResponse(
                $this->urlGenerator->generate('app_clients_record_vehicle')
            );
        }

        if ($isPassengerChecked) {
            return new RedirectResponse(
                $this->urlGenerator->generate('app_clients_carpools')
            );
        }

        return new RedirectResponse(
            $this->urlGenerator->generate('app_clients_home')
        );
    }
}
