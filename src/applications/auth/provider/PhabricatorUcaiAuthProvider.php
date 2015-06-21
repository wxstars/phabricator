<?php

final class PhabricatorUcaiAuthProvider
  extends PhabricatorOAuth2AuthProvider {

  public function getProviderName() {
    return pht('Ucai');
  }

  protected function getProviderConfigurationHelp() {
    $uri = PhabricatorEnv::getProductionURI('/');
    $callback_uri = PhabricatorEnv::getURI($this->getLoginURI());

    return pht(
      "To configure Ucai OAuth, create a new Ucai Application here:".
      "\n\n".
      "https://github.com/settings/applications/new".
      "\n\n".
      "You should use these settings in your application:".
      "\n\n".
      "  - **URL:** Set this to your full domain with protocol. For this ".
      "    Phabricator install, the correct value is: `%s`\n".
      "  - **Callback URL**: Set this to: `%s`\n".
      "\n\n".
      "Once you've created an application, copy the **Client ID** and ".
      "**Client Secret** into the fields above.",
      $uri,
      $callback_uri);
  }

  protected function newOAuthAdapter() {
    return new PhutilUcaiAuthAdapter();
  }

  protected function getLoginIcon() {
    return 'Ucai';
  }

  public function getLoginURI() {
    // TODO: Clean this up. See PhabricatorAuthOldOAuthRedirectController.
    return '/oauth/ucai/login/';
  }

}
