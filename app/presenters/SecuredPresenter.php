<?php

namespace App\Presenters;


class SecuredPresenter extends BasePresenter {

    public function startup() {
        parent::startup();

        $user = $this->getUser();
        if (!$user->isLoggedIn()) {
            if ($user->getLogoutReason() === \Nette\Security\User::INACTIVITY) {
                $this->flashMessage('Byli jste odhlášeni z bezpečnostních důvodů.', 'warning');
            }
            $backlink = $this->storeRequest();
            $this->redirect(':Admin:Sign:in', array('backlink' => $backlink));
        }
    }

    public function actionLogout() {
        $user = $this->getUser();
        $user->logout($clearIdentity = true);
        $this->flashMessage('Odhlásili jste se.', 'information');
        $this->redirect('Sign:in');
    }

}